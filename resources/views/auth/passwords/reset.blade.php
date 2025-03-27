@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <!-- reset password form -->
    <form action="{{ route('password.update') }}" method="POST" class="sign__form">
        @csrf
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <p class="sign__text">You are only one step away from your new password</p>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="sign__group">
            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror"
                name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="password-confirm" type="password" class="sign__input" name="password_confirmation"
                placeholder="Confirm Password" required autocomplete="new-password">
        </div>

        <button class="sign__btn" type="submit">{{ __('Reset Password') }}</button>

        <p class="sign__text">
            <a href="{{ route('login') }}">Back to login</a>
        </p>
    </form>
    <!-- end reset password form -->
@endsection
