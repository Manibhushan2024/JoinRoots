<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Service;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\BlogPost;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAppointments = Appointment::count();
        $totalContacts     = Contact::count();
        $totalServices     = Service::count();
        $totalUsers        = User::count();
        $totalDoctors      = Doctor::count();
        $totalReviews      = Review::count();
        $totalPosts        = BlogPost::count();
        $totalRevenue      = Payment::where('status', 'successful')->sum('amount');

        $recentAppointments = Appointment::with('user', 'service', 'doctor')->latest()->take(5)->get();
        $recentContacts     = Contact::latest()->take(5)->get();

        // ── Daily schedule panels ────────────────────────
        $todayAppointments    = Appointment::with('user', 'service', 'doctor')
            ->whereDate('start_datetime', Carbon::today())
            ->orderBy('start_datetime')
            ->get();

        $tomorrowAppointments = Appointment::with('user', 'service', 'doctor')
            ->whereDate('start_datetime', Carbon::tomorrow())
            ->orderBy('start_datetime')
            ->get();

        // ── Upcoming (next 7 days, excluding today) ──────
        $upcomingAppointments = Appointment::with('user', 'service', 'doctor')
            ->whereBetween('start_datetime', [Carbon::tomorrow(), Carbon::today()->addDays(7)->endOfDay()])
            ->orderBy('start_datetime')
            ->get();

        // ── Founder quotes (Deepali Sahani) ─────────────
        $founderQuotes = [
            [
                'quote'   => 'Every child has a voice inside them. Our job is simply to help them find it.',
                'context' => 'On the purpose of speech therapy',
            ],
            [
                'quote'   => 'Early intervention is not a choice — it is the most important gift a parent can give. Don\'t wait. Act now.',
                'context' => 'On why timing matters',
            ],
            [
                'quote'   => 'A child who struggles with speech is not broken. They are simply wired differently, and different is beautiful.',
                'context' => 'On seeing children beyond their diagnosis',
            ],
            [
                'quote'   => 'We don\'t just train children — we train families. Because the real therapy happens at home, in love and patience.',
                'context' => 'On parent involvement',
            ],
            [
                'quote'   => 'Progress in therapy is never linear. Celebrate every small win — because for that child, it is everything.',
                'context' => 'On celebrating milestones',
            ],
        ];
        // Show a different quote each day
        $todayQuote = $founderQuotes[Carbon::today()->dayOfYear % count($founderQuotes)];

        return view('admin.dashboard', compact(
            'totalAppointments', 'totalContacts', 'totalServices', 'totalUsers',
            'totalDoctors', 'totalReviews', 'totalPosts', 'totalRevenue',
            'recentAppointments', 'recentContacts',
            'todayAppointments', 'tomorrowAppointments', 'upcomingAppointments',
            'todayQuote'
        ));
    }
}
