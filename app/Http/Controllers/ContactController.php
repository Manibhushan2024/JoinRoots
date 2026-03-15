<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string',
        ]);

        Contact::create($data);

        // Send email via Resend
        $html = "<h3>New Contact Query</h3>
                 <p><strong>Name:</strong> {$data['name']}</p>
                 <p><strong>Email:</strong> {$data['email']}</p>
                 <p><strong>Phone:</strong> " . ($data['phone'] ?? 'N/A') . "</p>
                 <p><strong>Message:</strong><br/>" . nl2br(htmlspecialchars($data['message'])) . "</p>";

        Http::withToken(env('RESEND_API_KEY'))->post('https://api.resend.com/emails', [
            'from' => 'onboarding@resend.dev', // Default testing domain
            'to' => env('ADMIN_EMAIL', 'manibhushank437@gmail.com'),
            'subject' => 'New Contact Form Submission - Connect Roots',
            'html' => $html
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will contact you soon!');
    }
}
