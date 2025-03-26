@extends('layouts.user')

@section('title', 'Dashboard')

@section('page_title', 'User Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Welcome to Your Dashboard</h3>
                </div>
                <div class="card-body">
                    <h5>Hello, {{ auth()->user()->name }}!</h5>
                    <p class="lead">
                        Welcome to your user dashboard. From here, you can manage your account and access various features.
                    </p>

                    <div class="row mt-4">
                        @if (!auth()->user()->hasStore())
                            <div class="col-md-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Create</h3>
                                        <p>Open a New Store</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <a href="{{ route('stores.create') }}" class="small-box-footer">
                                        Get Started <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>Manage</h3>
                                        <p>Your Store: {{ auth()->user()->store->name }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <a href="{{ route('stores.show', auth()->user()->store) }}" class="small-box-footer">
                                        Visit Store <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Profile</h3>
                                    <p>Update Your Account</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Edit Profile <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
