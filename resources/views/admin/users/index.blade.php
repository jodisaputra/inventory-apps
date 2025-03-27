@extends('layouts.admin')

@section('title', 'Manage Users')

@section('page_title', 'User Management')

@section('breadcrumb')
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Users</h3>
                    <div class="card-tools">
                        @can('create users')
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create New User
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Permissions</th>
                                <th>Store</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge badge-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-secondary" data-toggle="modal"
                                            data-target="#permissionsModal-{{ $user->id }}">
                                            View Permissions
                                        </button>

                                        <!-- Permissions Modal -->
                                        <div class="modal fade" id="permissionsModal-{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="permissionsModalLabel-{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="permissionsModalLabel-{{ $user->id }}">Permissions for
                                                            {{ $user->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Inherited from Roles:</h6>
                                                        <div class="row">
                                                            @foreach ($user->getAllPermissions()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[0];
        }) as $group => $permissions)
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="card">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">{{ ucfirst($group) }}</h6>
                                                                        </div>
                                                                        <div class="card-body p-2">
                                                                            <ul class="list-unstyled mb-0">
                                                                                @foreach ($permissions as $permission)
                                                                                    <li>
                                                                                        <i
                                                                                            class="fas fa-check text-success"></i>
                                                                                        {{ ucfirst(str_replace($group . ' ', '', $permission->name)) }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->store)
                                            <span class="badge badge-success">{{ $user->store->name }}</span>
                                        @else
                                            <span class="badge badge-secondary">No Store</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
