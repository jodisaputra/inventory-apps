@extends(auth()->user()->hasRole('admin') ? 'layouts.admin' : 'layouts.user')

@section('title', 'Store Details')

@section('page_title', 'Store Details')

@section('breadcrumb')
    <li class="breadcrumb-item active">Store</li>
@endsection

@section('content')
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
@endsection
