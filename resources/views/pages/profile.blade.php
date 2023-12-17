@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="http://localhost:8001/img/avatar/avatar-1.png"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <h4 class="text-primary">
                                    {{ auth()->user()->name }}
                                </h4>
                            </div>
                            <div class="author-box-job">{{ auth()->user()->phone }}</div>
                            <div class="author-box-description">
                                {{ auth()->user()->bio }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <form method="post" action="{{ route('user-profile-information.update') }}"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                                value="{{ auth()->user()->name }}">
                                            @error('name', 'updateProfileInformation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                                value="{{ auth()->user()->email }}">
                                            @error('email', 'updateProfileInformation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Phone</label>
                                            <input type="tel" name="phone"
                                                class="form-control @error('phone', 'updateProfileInformation') is-invalid @enderror"
                                                value="{{ auth()->user()->phone }}">
                                            @error('phone', 'updateProfileInformation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bio</label>
                                            <textarea class="form-control summernote-simple" name="bio">{{ auth()->user()->bio }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <form method="post" action="{{ route('user-password.update') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Password</h4>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Current Password</label>
                                            <input type="password"
                                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                                name="current_password">
                                            @error('current_password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>New Password</label>
                                            <input type="password"
                                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                                name="password">
                                            @error('password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Password Confirmation</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
