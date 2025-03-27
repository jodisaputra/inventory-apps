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
                <form action="{{ route('roles.update', $role) }}" method="POST" id="editRoleForm">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                            <label>Create New Permissions</label>
                            <small class="form-text text-muted mb-2">
                                Add new permissions to the system. These will be assigned to this role.
                            </small>

                            <div id="custom-permissions-container">
                                <div class="input-group mb-2 custom-permission-row">
                                    <input type="text" class="form-control permission-input" name="new_permissions[]"
                                        placeholder="Enter permission name (e.g. manage menu)">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-permission">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-success" id="add-permission">
                                <i class="fas fa-plus"></i> Add Another Permission
                            </button>
                        </div>

                        <div class="form-group mt-4">
                            <label>Role Permissions</label>
                            <p class="text-muted small">Manage permissions for this role. You can edit permission names
                                directly.</p>

                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="permission-search"
                                        placeholder="Search permissions...">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>
                            </div>

                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped permission-table">
                                    <thead>
                                        <tr>
                                            <th>Permission Name</th>
                                            <th style="width: 100px;">Assign</th>
                                            <th style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr class="permission-row" data-name="{{ $permission->name }}">
                                                <td>
                                                    <div class="permission-display">
                                                        <span class="permission-text">{{ $permission->name }}</span>
                                                        <button type="button"
                                                            class="btn btn-xs btn-info ml-2 edit-permission-btn"
                                                            data-id="{{ $permission->id }}"
                                                            data-name="{{ $permission->name }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="permission-edit" style="display: none;">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control form-control-sm permission-edit-input"
                                                                value="{{ $permission->name }}"
                                                                name="edit_permissions[{{ $permission->id }}][name]">
                                                            <input type="hidden"
                                                                name="edit_permissions[{{ $permission->id }}][id]"
                                                                value="{{ $permission->id }}">
                                                            <div class="input-group-append">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-success save-permission-btn"
                                                                    data-id="{{ $permission->id }}">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary cancel-edit-btn">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-xs btn-danger delete-permission-btn"
                                                        data-id="{{ $permission->id }}" title="Delete Permission"
                                                        {{ $permission->roles->count() > 1 ? 'disabled' : '' }}>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <!-- Delete Permission Modal -->
    <div class="modal fade" id="delete-permission-modal" tabindex="-1" role="dialog"
        aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePermissionModalLabel">Delete Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this permission? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-permission">Delete
                        Permission</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add new permission field
            document.getElementById('add-permission').addEventListener('click', function() {
                const container = document.getElementById('custom-permissions-container');
                const newRow = document.createElement('div');
                newRow.className = 'input-group mb-2 custom-permission-row';
                newRow.innerHTML = `
                <input type="text" class="form-control permission-input" name="new_permissions[]"
                    placeholder="Enter permission name (e.g. manage menu)">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-permission">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                container.appendChild(newRow);
            });

            // Remove permission field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-permission') || e.target.closest(
                        '.remove-permission')) {
                    const button = e.target.classList.contains('remove-permission') ? e.target : e.target
                        .closest('.remove-permission');
                    const row = button.closest('.custom-permission-row');

                    // Make sure we have at least one row
                    const allRows = document.querySelectorAll('.custom-permission-row');
                    if (allRows.length > 1) {
                        row.remove();
                    } else {
                        // Just clear the input if it's the last one
                        row.querySelector('input').value = '';
                    }
                }
            });

            // Form submission - filter out empty permission fields
            document.getElementById('editRoleForm').addEventListener('submit', function(e) {
                const permInputs = document.querySelectorAll('.permission-input');
                permInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        input.disabled = true; // Disable empty inputs so they don't get submitted
                    }
                });
            });

            // Permission search functionality
            const searchInput = document.getElementById('permission-search');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.permission-row');

                    rows.forEach(row => {
                        const permissionName = row.getAttribute('data-name').toLowerCase();
                        if (permissionName.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Edit permission functionality
            document.querySelectorAll('.edit-permission-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('tr');
                    row.querySelector('.permission-display').style.display = 'none';
                    row.querySelector('.permission-edit').style.display = 'block';
                });
            });

            // Cancel edit
            document.querySelectorAll('.cancel-edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('tr');
                    row.querySelector('.permission-edit').style.display = 'none';
                    row.querySelector('.permission-display').style.display = 'block';

                    // Reset the input value to original
                    const permissionName = row.querySelector('.permission-text').textContent;
                    row.querySelector('.permission-edit-input').value = permissionName;
                });
            });

            // Save edited permission name
            document.querySelectorAll('.save-permission-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const permissionId = this.getAttribute('data-id');
                    const newPermissionName = row.querySelector('.permission-edit-input').value
                        .trim();

                    if (!newPermissionName) {
                        alert('Permission name cannot be empty');
                        return;
                    }

                    // Update the display text
                    row.querySelector('.permission-text').textContent = newPermissionName;

                    // Update the data-name attribute for search
                    row.setAttribute('data-name', newPermissionName);

                    // Hide edit mode
                    row.querySelector('.permission-edit').style.display = 'none';
                    row.querySelector('.permission-display').style.display = 'block';

                    // Update the edit button data-name
                    row.querySelector('.edit-permission-btn').setAttribute('data-name',
                        newPermissionName);
                });
            });

            // Delete permission modal handling
            let permissionToDelete = null;

            // Handle clicking delete button
            document.querySelectorAll('.delete-permission-btn').forEach(button => {
                if (button.disabled) return;

                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    permissionToDelete = this.getAttribute('data-id');
                    $('#delete-permission-modal').modal('show');
                });
            });

            // Handle confirm delete in modal
            document.getElementById('confirm-delete-permission').addEventListener('click', function() {
                if (!permissionToDelete) return;

                // Send AJAX request to delete permission
                fetch('{{ route('delete.permission') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            permission_id: permissionToDelete
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#delete-permission-modal').modal('hide');

                        if (data.success) {
                            // Remove the row from the table
                            const row = document.querySelector(
                                `.delete-permission-btn[data-id="${permissionToDelete}"]`).closest(
                                'tr');
                            if (row) {
                                row.remove();
                            }

                            // Show success message
                            alert(data.message);
                        } else {
                            // Show error message
                            alert(data.message);
                        }

                        permissionToDelete = null;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting permission');
                        $('#delete-permission-modal').modal('hide');
                        permissionToDelete = null;
                    });
            });
        });
    </script>
@endpush
