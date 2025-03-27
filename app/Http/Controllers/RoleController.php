<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Pre-process the new permissions array to remove empty values
            $newPermissions = [];
            if ($request->has('new_permissions') && is_array($request->new_permissions)) {
                foreach ($request->new_permissions as $perm) {
                    if (!empty(trim($perm))) {
                        $newPermissions[] = trim($perm);
                    }
                }
            }

            // Replace the original new_permissions with the filtered array
            $request->merge(['new_permissions' => $newPermissions]);

            // Log incoming request data
            info("Role creation request data:", $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
                'new_permissions' => 'nullable|array',
                'new_permissions.*' => 'nullable|string|max:255',
            ]);

            info("Validation passed");

            // Create the role
            $role = Role::create(['name' => $request->name]);
            info("Role created with ID: " . $role->id);

            // Initialize collection to hold all permissions
            $allPermissions = collect();

            // Get existing Permission objects by their IDs if provided
            if ($request->has('permissions') && is_array($request->permissions)) {
                $existingPermissions = Permission::whereIn('id', $request->permissions)->get();
                $allPermissions = $allPermissions->merge($existingPermissions);
                info("Added " . $existingPermissions->count() . " existing permissions");
            }

            // Handle new custom permissions if provided
            if ($request->has('new_permissions') && is_array($request->new_permissions) && count($request->new_permissions) > 0) {
                $newPermissionsCount = 0;
                foreach ($request->new_permissions as $permName) {
                    // Skip empty permission names (extra check)
                    if (empty(trim($permName))) {
                        continue;
                    }

                    // Use the permission name directly without role prefix
                    $permissionName = trim($permName);
                    info("Processing new permission: " . $permissionName);

                    // Check if permission already exists
                    $permission = Permission::where('name', $permissionName)->first();
                    if (!$permission) {
                        $permission = Permission::create(['name' => $permissionName]);
                        info("Created new permission with ID: " . $permission->id);
                    } else {
                        info("Using existing permission with ID: " . $permission->id);
                    }

                    $allPermissions->push($permission);
                    $newPermissionsCount++;
                }
                info("Added " . $newPermissionsCount . " new permissions");
            }

            // Sync all permissions (existing and newly created)
            if ($allPermissions->count() > 0) {
                info("Syncing " . $allPermissions->count() . " permissions to role");
                $role->syncPermissions($allPermissions);
            } else {
                info("No permissions to sync");
            }

            info("Role creation completed successfully");

            return redirect()->route('roles.index')
                ->with('status', 'Role created successfully!');
        } catch (\Exception $e) {
            info("Role creation failed: " . $e->getMessage());
            info("Stack trace: " . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {
            // Pre-process the new permissions array to remove empty values
            $newPermissions = [];
            if ($request->has('new_permissions') && is_array($request->new_permissions)) {
                foreach ($request->new_permissions as $perm) {
                    if (!empty(trim($perm))) {
                        $newPermissions[] = trim($perm);
                    }
                }
            }

            // Replace the original new_permissions with the filtered array
            $request->merge(['new_permissions' => $newPermissions]);

            // Log incoming request data
            info("Role update request data:", $request->all());

            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
                'new_permissions' => 'nullable|array',
                'new_permissions.*' => 'nullable|string|max:255',
                'edit_permissions' => 'nullable|array',
                'edit_permissions.*.id' => 'exists:permissions,id',
                'edit_permissions.*.name' => 'string|max:255',
            ]);

            info("Validation passed");

            $oldName = $role->name;
            $newName = $request->name;

            // Initialize collection to hold all permissions
            $allPermissions = collect();

            // Get existing Permission objects by their IDs if provided
            if ($request->has('permissions') && is_array($request->permissions)) {
                $existingPermissions = Permission::whereIn('id', $request->permissions)->get();
                $allPermissions = $allPermissions->merge($existingPermissions);
                info("Added " . $existingPermissions->count() . " existing permissions");
            }

            // Update role name if it's not a core role
            if (!in_array($role->name, ['admin', 'store_admin', 'user'])) {
                $role->name = $newName;
                $role->save();
                info("Updated role name from '{$oldName}' to '{$newName}'");
            }

            // Handle edited permissions if provided
            if ($request->has('edit_permissions') && is_array($request->edit_permissions)) {
                foreach ($request->edit_permissions as $editedPerm) {
                    if (isset($editedPerm['id']) && isset($editedPerm['name']) && !empty(trim($editedPerm['name']))) {
                        $permission = Permission::find($editedPerm['id']);
                        if ($permission) {
                            $permission->name = trim($editedPerm['name']);
                            $permission->save();
                            info("Updated permission ID {$permission->id} name to '{$permission->name}'");
                        }
                    }
                }
            }

            // Handle new custom permissions if provided
            if ($request->has('new_permissions') && is_array($request->new_permissions) && count($request->new_permissions) > 0) {
                $newPermissionsCount = 0;
                foreach ($request->new_permissions as $permName) {
                    // Skip empty permission names (extra check)
                    if (empty(trim($permName))) {
                        continue;
                    }

                    // Use the permission name directly without role prefix
                    $permissionName = trim($permName);
                    info("Processing new permission: " . $permissionName);

                    // Check if permission already exists
                    $permission = Permission::where('name', $permissionName)->first();
                    if (!$permission) {
                        $permission = Permission::create(['name' => $permissionName]);
                        info("Created new permission with ID: " . $permission->id);
                    } else {
                        info("Using existing permission with ID: " . $permission->id);
                    }

                    $allPermissions->push($permission);
                    $newPermissionsCount++;
                }
                info("Added " . $newPermissionsCount . " new permissions");
            }

            // Sync all permissions (existing and newly created)
            info("Syncing " . $allPermissions->count() . " permissions to role");
            $role->syncPermissions($allPermissions);
            info("Role update completed successfully");

            return redirect()->route('roles.index')
                ->with('status', 'Role updated successfully!');
        } catch (\Exception $e) {
            info("Role update failed: " . $e->getMessage());
            info("Stack trace: " . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            // Prevent deleting the core roles
            if (in_array($role->name, ['admin', 'store_admin', 'user'])) {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete core system roles!');
            }

            // Get role-specific permissions that only this role uses
            $rolePermissions = $role->permissions;
            $permissionsToCheck = [];

            foreach ($rolePermissions as $permission) {
                if ($permission->roles->count() === 1) {
                    // This permission is only used by this role
                    $permissionsToCheck[] = $permission->id;
                }
            }

            // Delete the role first
            $role->delete();
            info("Role deleted successfully");

            // Now delete the permissions that were only used by this role
            if (!empty($permissionsToCheck)) {
                $unusedPermissions = Permission::whereIn('id', $permissionsToCheck)->get();
                foreach ($unusedPermissions as $permission) {
                    // Double-check it's no longer used (in case of race conditions)
                    if ($permission->roles->count() === 0) {
                        $permission->delete();
                        info("Deleted unused permission: " . $permission->name);
                    }
                }
            }

            return redirect()->route('roles.index')
                ->with('status', 'Role and unused permissions deleted successfully!');
        } catch (\Exception $e) {
            info("Role deletion failed: " . $e->getMessage());

            return redirect()->route('roles.index')
                ->with('error', 'An error occurred while deleting the role: ' . $e->getMessage());
        }
    }

    /**
     * Ajax endpoint to delete a permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePermission(Request $request)
    {
        try {
            $permissionId = $request->input('permission_id');
            $permission = Permission::findOrFail($permissionId);

            // Check if permission is used by roles
            if ($permission->roles->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'This permission is used by ' . $permission->roles->count() . ' role(s) and cannot be deleted.'
                ]);
            }

            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully'
            ]);
        } catch (\Exception $e) {
            info("Ajax permission deletion failed: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting permission: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Ajax endpoint to update a permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request)
    {
        try {
            $permissionId = $request->input('permission_id');
            $permissionName = $request->input('permission_name');

            if (empty(trim($permissionName))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission name cannot be empty'
                ]);
            }

            $permission = Permission::findOrFail($permissionId);

            // Check if the name is already used by another permission
            $duplicate = Permission::where('name', trim($permissionName))
                ->where('id', '!=', $permissionId)
                ->first();

            if ($duplicate) {
                return response()->json([
                    'success' => false,
                    'message' => 'A permission with this name already exists'
                ]);
            }

            $permission->name = trim($permissionName);
            $permission->save();

            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully'
            ]);
        } catch (\Exception $e) {
            info("Ajax permission update failed: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating permission: ' . $e->getMessage()
            ]);
        }
    }
}
