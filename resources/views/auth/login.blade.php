@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <!-- login form -->
    <form action="{{ route('login') }}" method="POST" class="sign__form">
        @csrf
        <a href="{{ url('/') }}" class="sign__logo">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}">
        </a>

        <div class="sign__group">
            <input id="email" type="text" class="sign__input @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="sign__group">
            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror"
                name="password" placeholder="Password" required autocomplete="current-password">
            @error('password')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="sign__group sign__group--checkbox">
            <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember Me</label>
        </div>

        <button class="sign__btn" type="submit">Sign in</button>

        @if (Route::has('register'))
            <span class="sign__text">Don't have an account? <a href="{{ route('register') }}">Sign up!</a></span>
        @endif

        @if (Route::has('password.request'))
            <span class="sign__text"><a href="{{ route('password.request') }}">Forgot password?</a></span>
        @endif
    </form>
    <!-- end login form -->
@endsection
