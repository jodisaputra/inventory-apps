@extends('layouts.user')

@section('title', 'Dashboard')

@section('page_title', 'User Dashboard')

@section('breadcrumb')
    <li class="breadcrumb__item breadcrumb__item--active">Dashboard</li>
@endsection

@section('content')
    <!-- welcome section -->
    <div class="mb-5">
        <h2 class="mb-4">Welcome to Your Dashboard</h2>
        <p class="text-muted">Welcome to your user dashboard. From here, you can manage your account and access various
            features.</p>
    </div>

    <!-- action cards -->
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <h3 class="card__title">
                    <svg class="card__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M20.91 8.84L8.56 2.23a1.93 1.93 0 0 0-1.81 0L3.1 4.13a2.12 2.12 0 0 0-.05 3.69l12.22 6.93a2 2 0 0 0 1.94 0L21 12.51a2.12 2.12 0 0 0-.09-3.67z">
                        </path>
                        <path d="M3.09 8.84v7.58a2 2 0 0 0 1 1.74l3.81 2.27a2 2 0 0 0 2 0l3.56-2.14"></path>
                        <path d="M15 8v12.16l3.81 2.26a2 2 0 0 0 2-.06l3-1.73a2.12 2.12 0 0 0 1.1-1.86V8.82"></path>
                    </svg>
                    @if (!auth()->user()->hasStore())
                        Create Store
                    @else
                        Manage Store
                    @endif
                </h3>
                <div class="card__content">
                    @if (!auth()->user()->hasStore())
                        <p>Start selling your products by opening a new store</p>
                    @else
                        <p>Your Store: <strong>{{ auth()->user()->store->name }}</strong></p>
                    @endif
                </div>
                @if (!auth()->user()->hasStore())
                    <a href="{{ route('stores.create') }}" class="card__button">Get Started</a>
                @else
                    <a href="{{ route('stores.show', auth()->user()->store) }}" class="card__button">Visit Store</a>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <h3 class="card__title">
                    <svg class="card__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Profile
                </h3>
                <div class="card__content">
                    <p>Update your account settings and personal information</p>
                </div>
                <a href="#" class="card__button">Edit Profile</a>
            </div>
        </div>
    </div>

    <!-- stats cards -->
    <div class="row" style="margin-top: 50px;">
        <div class="col-6 col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-card__content">
                    <span class="stats-card__title">Orders</span>
                    <span class="stats-card__value">0</span>
                </div>
                <div class="stats-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-card__content">
                    <span class="stats-card__title">Products</span>
                    <span class="stats-card__value">0</span>
                </div>
                <div class="stats-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-card__content">
                    <span class="stats-card__title">Customers</span>
                    <span class="stats-card__value">0</span>
                </div>
                <div class="stats-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-card__content">
                    <span class="stats-card__title">Revenue</span>
                    <span class="stats-card__value">$0.00</span>
                </div>
                <div class="stats-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
