@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            {{-- Profile Header --}}
            <div class="card shadow border-0 mb-4 overflow-hidden">

                <div class="bg-primary text-white p-4">
                    <div class="d-flex align-items-center gap-3">

                        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 80px; height: 80px; font-size: 2rem;">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <div>
                            <h3 class="mb-1 fw-bold">{{ Auth::user()->name }}</h3>

                            <p class="mb-0 opacity-75">
                                {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                            </p>

                            <small>{{ Auth::user()->email }}</small>
                        </div>

                    </div>
                </div>

                <div class="card-body py-4">
                    <div class="row text-center">

                        <div class="col-md-4 mb-3 mb-md-0">
                            <h5 class="text-primary fw-bold">Role</h5>
                            <p class="mb-0 text-muted">
                                {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <h5 class="text-primary fw-bold">Engineer Name</h5>
                            <p class="mb-0 text-muted">
                                {{ Auth::user()->engineer_name ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="col-md-4">
                            <h5 class="text-primary fw-bold">Account Status</h5>
                            <span class="badge bg-success px-3 py-2">Active</span>
                        </div>

                    </div>
                </div>

            </div>


            {{-- Update Profile Information --}}
            <div class="card shadow border-0 mb-4">

                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Profile Information
                    </h5>
                </div>

                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </div>


            {{-- Update Password --}}
            <div class="card shadow border-0 mb-4">

                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-shield-lock-fill me-2"></i>
                        Update Password
                    </h5>
                </div>

                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>

            </div>


            {{-- Delete Account --}}
            <div class="card shadow border-0 border-danger">

                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Danger Zone
                    </h5>
                </div>

                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>

    </div>

</div>

@endsection