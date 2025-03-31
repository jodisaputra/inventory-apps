@extends('layouts.user')

@section('title', 'Welcome')

@section('page_title', 'Welcome to ' . config('app.name'))

@section('content')
    <div class="welcome-container">
        <div class="welcome-card">
            <h2 class="welcome-title">Get Started with {{ config('app.name') }}</h2>

            <div class="welcome-content">
                <h3 class="welcome-greeting">Welcome {{ auth()->user()->name }}!</h3>
                <p class="welcome-question">Would you like to create a store?</p>

                <form method="POST" action="{{ route('welcome.decision') }}" class="welcome-form">
                    @csrf
                    <div class="welcome-actions">
                        <button type="submit" name="create_store" value="1" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="btn-icon">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            Yes, Create a Store
                        </button>

                        <button type="submit" name="create_store" value="0" class="btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="btn-icon">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            No, Skip for Now
                        </button>
                    </div>
                </form>

                <div class="welcome-footer">
                    <p>You can always create a store later from your dashboard.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .welcome-card {
            background-color: #151f30;
            border-radius: 8px;
            width: 100%;
            overflow: hidden;
        }

        .welcome-title {
            font-size: 20px;
            padding: 20px 25px;
            margin: 0;
            border-bottom: 1px solid #222b41;
            font-weight: 500;
        }

        .welcome-content {
            padding: 25px;
        }

        .welcome-greeting {
            font-size: 18px;
            font-weight: 400;
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .welcome-question {
            font-size: 16px;
            text-align: center;
            margin-bottom: 30px;
            color: #d1d1d1;
        }

        .welcome-form {
            margin-bottom: 30px;
        }

        .welcome-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            border-radius: 4px;
            border: none;
            font-size: 15px;
            cursor: pointer;
            min-width: 200px;
        }

        .btn-primary {
            background-color: #2f80ed;
            color: white;
        }

        .btn-secondary {
            background-color: #1a2436;
            color: white;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: 0.9;
        }

        .btn-icon {
            margin-right: 10px;
        }

        .welcome-footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

        @media (max-width: 576px) {
            .welcome-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
            }
        }
    </style>
@endsection
