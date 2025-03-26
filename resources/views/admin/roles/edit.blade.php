@extends('layouts.admin')

@section('title', 'Edit Role')

@section('page_title', 'Edit Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Role: {{ $role->name }}</h3>
                </div>
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $role->name) }}" placeholder="Enter role name" required
                                {{ in_array($role->name, ['admin', 'store_admin', 'user']) ? 'readonly' : '' }}>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @if (in_array($role->name, ['admin', 'store_admin', 'user']))
                                <small class="text-muted">Core system roles cannot be renamed.</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Permissions</label>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="row mt-2">
                                @foreach ($permissions->groupBy(function ($permission) {
            return explode(' ', $permission->name)[0];
        }) as $group => $items)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">{{ ucfirst($group) }}</h5>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($items as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="permission_{{ $permission->id }}">
                                                            {{ ucfirst(str_replace($group . ' ', '', $permission->name)) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
