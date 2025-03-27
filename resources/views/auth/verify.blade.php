@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
    <!-- verify email form -->
    <div class="sign__form">
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <h4 class="sign__title">{{ __('Verify Your Email Address') }}</h4>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="sign__text">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>

        <p class="sign__text">
            {{ __('If you did not receive the email') }},
        </p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="sign__btn">{{ __('Request another') }}</button>
        </form>
    </div>
    <!-- end verify email form -->
@endsection
