@extends('layouts.admin')

@section('title', 'User Details')

@section('page_title', 'User Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User: {{ $user->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @if ($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>User Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Registered</th>
                                    <td>{{ $user->created_at->format('F d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $user->updated_at->format('F d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Roles and Permissions</h5>
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Roles</h6>
                                </div>
                                <div class="card-body">
                                    @forelse($user->roles as $role)
                                        <a href="{{ route('roles.show', $role) }}"
                                            class="badge badge-primary p-2 mr-1 mb-1">
                                            {{ ucfirst($role->name) }}
                                        </a>
                                    @empty
                                        <p class="text-muted">No roles assigned.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Permissions (via Roles)</h6>
                                </div>
                                <div class="card-body">
                                    @forelse($user->getAllPermissions()->groupBy(function($permission) {
                                            return explode(' ', $permission->name)[0];
                                        }) as $group => $items)
                                        <div class="mb-2">
                                            <strong>{{ ucfirst($group) }}:</strong>
                                            <div>
                                                @foreach ($items as $permission)
                                                    <span class="badge badge-info p-2 mr-1 mb-1">
                                                        {{ ucfirst(str_replace($group . ' ', '', $permission->name)) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No permissions assigned.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($user->store)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Store Information</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 30%">Store Name</th>
                                                        <td>{{ $user->store->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $user->store->status == 'active' ? 'success' : 'danger' }}">
                                                                {{ ucfirst($user->store->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created</th>
                                                        <td>{{ $user->store->created_at->format('F d, Y') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('stores.show', $user->store) }}" class="btn btn-info">
                                                    <i class="fas fa-store mr-1"></i> View Store Details
                                                </a>
                                                <a href="{{ route('stores.edit', $user->store) }}"
                                                    class="btn btn-primary ml-2">
                                                    <i class="fas fa-edit mr-1"></i> Edit Store
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
