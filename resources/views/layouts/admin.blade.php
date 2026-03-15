@extends('layouts.app')

@push('styles')
    <style>
        .admin-sidebar {
            background: linear-gradient(180deg, #1A4331 0%, #0F291E 100%);
            min-height: calc(100vh - 70px); /* Adjust based on your navbar height */
        }
        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 12px 20px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #28a745;
        }
        .admin-wrapper {
            background-color: #f8f9fa;
            min-height: calc(100vh - 70px);
        }
        .admin-content {
            padding: 2rem;
        }
        .admin-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        .admin-card-stat:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 admin-sidebar py-4 position-sticky top-0 h-100">
            <div class="text-center mb-4 text-white">
                <h5 class="fw-bold mb-0">Admin Panel</h5>
                <small class="text-white-50">JoinRoots</small>
            </div>
            
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mt-3 mb-1">
                    <small class="text-white-50 px-3 text-uppercase fw-bold" style="font-size: 0.75rem;">Core Management</small>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i> Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar"></i> Payments & Invoices
                    </a>
                </li>
                
                <li class="nav-item mt-3 mb-1">
                    <small class="text-white-50 px-3 text-uppercase fw-bold" style="font-size: 0.75rem;">Website Content</small>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="fas fa-hands-helping"></i> Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                        <i class="fas fa-user-md"></i> Doctors/Team
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <i class="fas fa-star"></i> Client Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <i class="fas fa-blog"></i> Blog Posts
                    </a>
                </li>
                
                <li class="nav-item mt-3 mb-1">
                    <small class="text-white-50 px-3 text-uppercase fw-bold" style="font-size: 0.75rem;">Communications</small>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i> Contact Inquiries
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 admin-wrapper">
            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@endsection
