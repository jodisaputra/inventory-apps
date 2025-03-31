@extends(auth()->user()->hasRole('admin') ? 'layouts.admin' : 'layouts.user')

@section('title', 'Store Details')

@section('page_title', 'Store Details')

@section('breadcrumb')
    @if (auth()->user()->hasRole('admin'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Store</li>
    @endif
@endsection

@section('content')
    @if (auth()->user()->hasRole('admin'))
        <!-- Admin version -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $store->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('stores.edit', $store) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Store Name:</strong> {{ $store->name }}</p>
                                <p><strong>Status:</strong>
                                    <span class="badge badge-{{ $store->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($store->status) }}
                                    </span>
                                </p>
                                <p><strong>Created At:</strong> {{ $store->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> Store Owner Information</h5>
                                    <p><strong>Owner:</strong> {{ $store->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $store->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- User version (dark theme) -->
        <div class="store-details">
            <div class="store-details__header">
                <h2 class="store-details__title">{{ $store->name }}</h2>
                <a href="{{ route('stores.edit', $store) }}" class="store-details__edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                    Edit
                </a>
            </div>

            <div class="store-details__content">
                <div class="store-details__grid">
                    <div class="store-details__main">
                        <div class="detail-item">
                            <div class="detail-label">Store Name:</div>
                            <div class="detail-value">{{ $store->name }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Status:</div>
                            <div class="detail-value">
                                <span
                                    class="status-badge status-badge--{{ $store->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($store->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Created At:</div>
                            <div class="detail-value">{{ $store->created_at->format('F d, Y') }}</div>
                        </div>
                    </div>

                    <div class="store-details__owner">
                        <div class="owner-info">
                            <div class="owner-info__header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="#2f80ed" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <h3>Store Owner Information</h3>
                            </div>

                            <div class="owner-info__content">
                                <div class="detail-item">
                                    <div class="detail-label">Owner:</div>
                                    <div class="detail-value">{{ $store->user->name }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Email:</div>
                                    <div class="detail-value">{{ $store->user->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .store-details {
                background-color: #151f30;
                border-radius: 8px;
                overflow: hidden;
                margin-bottom: 30px;
            }

            .store-details__header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 25px;
                border-bottom: 1px solid #222b41;
            }

            .store-details__title {
                font-size: 20px;
                font-weight: 500;
                margin: 0;
                color: #fff;
            }

            .store-details__edit {
                display: inline-flex;
                align-items: center;
                background-color: #2f80ed;
                color: white;
                border: none;
                border-radius: 4px;
                padding: 8px 15px;
                font-size: 14px;
                text-decoration: none;
            }

            .store-details__edit svg {
                margin-right: 8px;
            }

            .store-details__edit:hover {
                opacity: 0.9;
                color: white;
                text-decoration: none;
            }

            .store-details__content {
                padding: 25px;
            }

            .store-details__grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }

            .detail-item {
                margin-bottom: 15px;
                display: flex;
                align-items: baseline;
            }

            .detail-label {
                font-weight: 600;
                width: 120px;
                color: #d1d1d1;
            }

            .detail-value {
                color: #fff;
                flex: 1;
            }

            .status-badge {
                display: inline-block;
                padding: 4px 10px;
                border-radius: 50px;
                font-size: 12px;
                font-weight: 600;
            }

            .status-badge--success {
                background-color: rgba(39, 174, 96, 0.15);
                color: #27ae60;
            }

            .status-badge--danger {
                background-color: rgba(231, 76, 60, 0.15);
                color: #e74c3c;
            }

            .owner-info {
                background-color: rgba(47, 128, 237, 0.1);
                border-radius: 8px;
                border-left: 4px solid #2f80ed;
                overflow: hidden;
            }

            .owner-info__header {
                display: flex;
                align-items: center;
                padding: 15px 20px;
                border-bottom: 1px solid rgba(47, 128, 237, 0.2);
            }

            .owner-info__header svg {
                margin-right: 10px;
            }

            .owner-info__header h3 {
                font-size: 16px;
                font-weight: 500;
                margin: 0;
                color: #fff;
            }

            .owner-info__content {
                padding: 15px 20px;
            }

            .owner-info__content .detail-item:last-child {
                margin-bottom: 0;
            }

            @media (max-width: 768px) {
                .store-details__grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endif
@endsection
