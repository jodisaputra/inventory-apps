@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <!-- registration form -->
    <form action="{{ route('register') }}" method="POST" class="sign__form">
        @csrf
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <div class="sign__group">
            <input id="name" type="text" class="sign__input @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
            @error('name')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="email" type="text" class="sign__input @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
            @error('email')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror"
                name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="password-confirm" type="password" class="sign__input" name="password_confirmation"
                placeholder="Confirm Password" required autocomplete="new-password">
        </div>

        <button class="sign__btn" type="submit">Sign up</button>

        <span class="sign__text">Already have an account? <a href="{{ route('login') }}">Sign in!</a></span>
    </form>
    <!-- end registration form -->
@endsection
