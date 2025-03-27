@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
    <!-- confirm password form -->
    <form action="{{ route('password.confirm') }}" method="POST" class="sign__form">
        @csrf
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <p class="sign__text">{{ __('Please confirm your password before continuing.') }}</p>

        <div class="sign__group">
            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror" name="password"
                placeholder="{{ __('Password') }}" required autocomplete="current-password">
            @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="sign__btn" type="submit">{{ __('Confirm Password') }}</button>

        @if (Route::has('password.request'))
            <span class="sign__text">
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </span>
        @endif
    </form>
    <!-- end confirm password form -->
@endsection
