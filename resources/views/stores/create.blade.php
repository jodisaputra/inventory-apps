@extends(auth()->user()->hasRole('admin') ? 'layouts.admin' : 'layouts.user')

@section('title', 'Create Store')

@section('page_title', 'Create Your Store')

@section('breadcrumb')
    @if (auth()->user()->hasRole('admin'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Create Store</li>
    @endif
@endsection

@section('content')
    @if (auth()->user()->hasRole('admin'))
        <!-- Admin version of the form -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Store Information</h3>
            </div>
            <!-- form start -->
            <form action="{{ route('stores.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Store Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="Enter store name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Additional store details can be added later.
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create Store</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    @else
        <!-- User version of the form (dark theme) -->
        <div class="edit-store-form">
            <h3 class="form-title">Store Information</h3>

            <form action="{{ route('stores.store') }}" method="POST">
                @csrf
                <div class="form-content">
                    <div class="form-group">
                        <label for="name" class="form-label">Store Name</label>
                        <input type="text" class="form-input @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="Enter store name" required>
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#2f80ed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>You'll be able to add more details to your store later.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Create Store</button>
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>

        <style>
            .edit-store-form {
                background-color: #1a2436;
                border-radius: 8px;
                padding: 25px;
                max-width: 500px;
                margin: 0 auto;
            }

            .form-title {
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 25px;
                color: #fff;
            }

            .form-content {
                margin-bottom: 30px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                margin-bottom: 10px;
                color: #fff;
            }

            .form-input {
                width: 100%;
                background-color: #151f30;
                border: 1px solid #1a2436;
                border-radius: 4px;
                padding: 12px 15px;
                color: #fff;
                font-size: 15px;
            }

            .form-input:focus {
                border-color: #2f80ed;
                outline: none;
            }

            .form-input.is-invalid {
                border-color: #eb5757;
            }

            .form-info {
                display: flex;
                align-items: flex-start;
                margin-top: 20px;
                padding: 15px;
                background-color: rgba(47, 128, 237, 0.1);
                border-left: 4px solid #2f80ed;
                border-radius: 0 4px 4px 0;
            }

            .form-info svg {
                margin-right: 10px;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .form-info span {
                color: #d1d1d1;
            }

            .error-message {
                display: block;
                margin-top: 10px;
                color: #eb5757;
            }

            .form-actions {
                display: flex;
                align-items: center;
                margin-top: 30px;
            }

            .btn-primary {
                background-color: #2f80ed;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                font-size: 14px;
                cursor: pointer;
                margin-right: 15px;
            }

            .btn-primary:hover {
                opacity: 0.9;
            }

            .btn-cancel {
                color: #fff;
                background-color: transparent;
                border: none;
                padding: 10px 20px;
                font-size: 14px;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-cancel:hover {
                text-decoration: none;
                color: #fff;
                opacity: 0.8;
            }
        </style>
    @endif
@endsection
