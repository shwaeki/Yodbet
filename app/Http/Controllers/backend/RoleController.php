<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-role');
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:update-role', ['only' => ['edit','update']]);
        $this->middleware('permission:destroy-role', ['only' => ['destroy']]);
    }


    public function index()
    {
        $roles = Role::paginate(setting('record_per_page', 15));
        return view('backend.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::pluck('name', 'id');
        return view('backend.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        flash('Role created successfully!')->success();
        return redirect()->route('roles.index');
    }


    public function show(Role $role)
    {
        return back();
    }


    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name', 'id');
        return view('backend.roles.edit', compact('permissions', 'role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id.'|max:255',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        flash('Role updated successfully!')->success();
        return redirect()->route('roles.index');
    }


    public function destroy(Role $role)
    {
        if ($role->id ==1 || $role->name == 'super-admin') {
            flash('Super admin role can not be deleted!')->warning();
            return back();
        }

        $role->delete();
        flash('Role deleted successfully!')->info();
        return redirect()->route('roles.index');
    }
}
