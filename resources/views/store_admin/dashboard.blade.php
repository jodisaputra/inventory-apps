@extends('layouts.user')

@section('title', 'Store Dashboard')

@section('page_title', 'Store Dashboard')

@section('content')
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

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h5><i class="icon fas fa-info"></i> Store Management</h5>
                                <p>This is your store management dashboard. From here, you can manage your store details,
                                    products, orders, and more.</p>
                                <p>In a fully implemented system, you would have access to:
                                <ul>
                                    <li>Product management</li>
                                    <li>Order processing</li>
                                    <li>Customer management</li>
                                    <li>Sales reports</li>
                                    <li>Inventory tracking</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
