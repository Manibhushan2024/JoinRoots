<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Auth\OtpPasswordResetController;
use App\Http\Controllers\PublicBlogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // We'll update welcome.blade.php to dynamically load from DB in a later step
    $services = \App\Models\Service::all();
    $doctors = \App\Models\Doctor::orderBy('display_order')->get();
    $reviews = \App\Models\Review::where('is_approved', true)->orderBy('display_order')->get();
    $blogs = \App\Models\BlogPost::where('is_published', true)->latest('published_at')->take(3)->get();
    return view('welcome', compact('services', 'doctors', 'reviews', 'blogs'));
});

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Blog
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [PublicBlogController::class, 'show'])->name('blog.show');

// Public appointment booking (for new patients)
Route::get('/book-appointment', [AppointmentController::class, 'createPublic'])->name('appointments.create.public');
Route::post('/book-appointment', [AppointmentController::class, 'storePublic'])->name('appointments.store.public');
Route::get('/api/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('api.available-slots');

// Admin appointment management (for existing patients) - REPLACES your individual appointment routes
Route::resource('appointments', AppointmentController::class);

// Patient Routes
Route::resource('patients', PatientController::class);

Auth::routes(['reset' => false]);

// OTP Password Reset Routes
Route::get('password/otp', [OtpPasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('password/otp/send', [OtpPasswordResetController::class, 'sendOtp'])->name('password.otp.send');
Route::get('password/otp/verify', [OtpPasswordResetController::class, 'showVerifyForm'])->name('password.otp.verify');
Route::post('password/otp/verify', [OtpPasswordResetController::class, 'verifyOtp'])->name('password.otp.verify.submit');
Route::post('password/otp/reset', [OtpPasswordResetController::class, 'resetPassword'])->name('password.otp.reset.submit');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/payment/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/store', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', AdminServiceController::class);
    Route::resource('appointments', AdminAppointmentController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::resource('doctors', AdminDoctorController::class);
    Route::resource('reviews', AdminReviewController::class);
    Route::post('reviews/{review}/approve', [AdminReviewController::class, 'toggleApprove'])->name('reviews.approve');
    Route::resource('blog', AdminBlogController::class);
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'show']);
});