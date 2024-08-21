<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {   
        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {   
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {   
        // validate
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required'
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Assign permissions to the role
        $role->syncPermissions($request->permissions);

        if (!$role) {
            return back()->with('error', 'Role could not be created.');
        }

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'permissions' => 'required'
        ]);

        // Update the role
        $role->update(['name' => $request->name]);

        // Assign permissions to the role
        $role->syncPermissions($request->permissions);

        if (!$role) {
            return back()->with('error', 'Role could not be updated.');
        }

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    

    
}
