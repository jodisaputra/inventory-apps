@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <!-- forgot password form -->
    <form action="{{ route('password.email') }}" method="POST" class="sign__form">
        @csrf
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <p class="sign__text">You forgot your password? Here you can easily retrieve a new password.</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="sign__group">
            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="sign__btn" type="submit">{{ __('Send Password Reset Link') }}</button>

        <p class="sign__text mt-3 mb-1">
            <a href="{{ route('login') }}">Back to login</a>
        </p>
    </form>
    <!-- end forgot password form -->
@endsection
