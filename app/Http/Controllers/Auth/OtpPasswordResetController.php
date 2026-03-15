<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OtpPasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.passwords.otp-request');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);
        
        PasswordOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        );

        // Send via Resend
        try {
            $html = "
            <div style='font-family:Arial,sans-serif;max-width:500px;margin:20px auto;padding:24px;border:1px solid #eee;border-radius:12px;'>
                <h2 style='color:#2d6a4f;margin-top:0;'>Verify Your Email</h2>
                <p style='color:#374151;'>Use the following One-Time Password (OTP) to reset your Connect Roots account password. This code is valid for 10 minutes.</p>
                <div style='background:#f9fafb;padding:16px;text-align:center;border-radius:8px;margin:24px 0;'>
                    <span style='font-size:32px;font-weight:800;letter-spacing:4px;color:#1b4332;'>{$otp}</span>
                </div>
                <p style='font-size:12px;color:#9ca3af;margin:0;'>If you didn't request this, please ignore this email.</p>
            </div>";

            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('RESEND_API_KEY'),
                'Content-Type' => 'application/json'
            ])->post('https://api.resend.com/emails', [
                'from'    => 'Connect Roots <onboarding@resend.dev>',
                'to'      => [$request->email],
                'subject' => "🔑 Your Password Reset OTP: {$otp}",
                'html'    => $html,
            ]);

        } catch (\Exception $e) {
            Log::error('OTP Email Failed: ' . $e->getMessage());
        }

        return redirect()->route('password.otp.verify', ['email' => $request->email])
            ->with('success', 'A 6-digit OTP has been sent to your email.');
    }

    public function showVerifyForm(Request $request)
    {
        $email = $request->email;
        return view('auth.passwords.otp-verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|string|size:6'
        ]);

        $entry = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$entry) {
            return back()->withErrors(['otp' => 'The OTP is invalid or has expired.']);
        }

        return view('auth.passwords.otp-reset', ['email' => $request->email, 'otp' => $request->otp]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Final verification of OTP
        $entry = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$entry) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete OTP
        $entry->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully. You can now login.');
    }
}
