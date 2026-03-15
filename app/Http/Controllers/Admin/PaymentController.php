<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user', 'appointment.service', 'appointment.doctor')
            ->latest()
            ->paginate(20);

        $totalRevenue    = Payment::where('status', 'successful')->sum('amount');
        $totalPending    = Payment::where('status', 'pending')->count();
        $totalSuccessful = Payment::where('status', 'successful')->count();
        $totalFailed     = Payment::where('status', 'failed')->count();

        return view('admin.payments.index', compact(
            'payments', 'totalRevenue', 'totalPending', 'totalSuccessful', 'totalFailed'
        ));
    }

    public function show(Payment $payment)
    {
        $payment->load('user', 'appointment.service', 'appointment.doctor');
        return view('admin.payments.show', compact('payment'));
    }
}
