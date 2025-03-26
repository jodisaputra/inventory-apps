@extends('layouts.user')

@section('title', 'Welcome')

@section('page_title', 'Welcome to ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Get Started with {{ config('app.name') }}</h3>
                </div>
                <div class="card-body">
                    <h5 class="text-center mb-4">Welcome {{ auth()->user()->name }}!</h5>
                    <p class="lead text-center">Would you like to create a store?</p>

                    <form method="POST" action="{{ route('welcome.decision') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="create_store" value="1"
                                    class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-store mr-2"></i> Yes, Create a Store
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="create_store" value="0"
                                    class="btn btn-secondary btn-lg btn-block">
                                    <i class="fas fa-times mr-2"></i> No, Skip for Now
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-4">
                        <p class="text-center text-muted">
                            <small>You can always create a store later from your dashboard.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
