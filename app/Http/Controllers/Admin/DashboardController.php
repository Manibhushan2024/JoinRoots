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

class DashboardController extends Controller
{
    public function index()
    {
        $totalAppointments = Appointment::count();
        $totalContacts = Contact::count();
        $totalServices = Service::count();
        $totalUsers = User::count();
        $totalDoctors = Doctor::count();
        $totalReviews = Review::count();
        $totalPosts = BlogPost::count();
        $totalRevenue = Payment::where('status', 'successful')->sum('amount');
        
        $recentAppointments = Appointment::with('user', 'service')->latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAppointments', 'totalContacts', 'totalServices', 'totalUsers',
            'totalDoctors', 'totalReviews', 'totalPosts', 'totalRevenue',
            'recentAppointments', 'recentContacts'
        ));
    }
}
