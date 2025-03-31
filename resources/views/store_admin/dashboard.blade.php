@extends(auth()->user()->hasRole('admin') ? 'layouts.admin' : 'layouts.user')

@section('title', 'Store Dashboard')

@section('page_title', 'Store Dashboard')

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
                        <h3 class="card-title">Store Overview: {{ $store->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('stores.edit', $store) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit Store
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-store"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Store Status</span>
                                        <span class="info-box-number">{{ ucfirst($store->status) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Orders</span>
                                        <span class="info-box-number">0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-tag"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Products</span>
                                        <span class="info-box-number">0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-chart-pie"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Revenue</span>
                                        <span class="info-box-number">$0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- User version (dark theme) -->
        <div class="store-dashboard">
            <div class="store-dashboard__header">
                <div class="store-title">Store Overview: {{ $store->name }}</div>
                <div class="store-edit">
                    <a href="{{ route('stores.edit', $store) }}" class="edit-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="edit-icon">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                        Edit Store
                    </a>
                </div>
            </div>

            <div class="store-stats">
                <div class="stat-box">
                    <div class="stat-label">Store Status</div>
                    <div class="stat-value">{{ ucfirst($store->status) }}</div>
                    <div class="stat-icon stat-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-label">Orders</div>
                    <div class="stat-value">0</div>
                    <div class="stat-icon stat-icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-label">Products</div>
                    <div class="stat-value">0</div>
                    <div class="stat-icon stat-icon-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-label">Revenue</div>
                    <div class="stat-value">$0.00</div>
                    <div class="stat-icon stat-icon-red">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .store-dashboard {
                background-color: #151f30;
                border-radius: 8px;
                padding: 25px;
                margin-bottom: 30px;
            }

            .store-dashboard__header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 30px;
            }

            .store-title {
                font-size: 20px;
                font-weight: 500;
                color: #fff;
                margin-bottom: 20px;
            }

            .edit-button {
                display: inline-flex;
                align-items: center;
                background-color: #2f80ed;
                color: white;
                border: none;
                border-radius: 4px;
                padding: 8px 15px;
                cursor: pointer;
                font-size: 14px;
                text-decoration: none;
            }

            .edit-button:hover {
                opacity: 0.9;
                color: white;
                text-decoration: none;
            }

            .edit-icon {
                margin-right: 8px;
            }

            .store-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .stat-box {
                background-color: #1a2436;
                border-radius: 8px;
                padding: 20px;
                position: relative;
                min-height: 120px;
                display: flex;
                flex-direction: column;
            }

            .stat-label {
                color: #6c757d;
                font-size: 14px;
                margin-bottom: 30px;
            }

            .stat-value {
                font-size: 28px;
                font-weight: 600;
                color: white;
            }

            .stat-icon {
                position: absolute;
                bottom: 20px;
                right: 20px;
            }

            .stat-icon-blue {
                color: #2f80ed;
            }

            .stat-icon-green {
                color: #27ae60;
            }

            .stat-icon-orange {
                color: #f39c12;
            }

            .stat-icon-red {
                color: #e74c3c;
            }

            @media (max-width: 992px) {
                .store-stats {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .store-stats {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endif
@endsection
