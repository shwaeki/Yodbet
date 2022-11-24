<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-permission');
        $this->middleware('permission:create-permission', ['only' => ['create','store']]);
        $this->middleware('permission:update-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:destroy-permission', ['only' => ['destroy']]);
    }


    public function index()
    {
        $permissions = Permission::paginate(setting('record_per_page', 15));
        return view('backend.permissions.index', compact('permissions'));
    }


    public function create()
    {
        return view('backend.permissions.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        activity('permission')->causedBy(Auth::user())->log('created');
        foreach (explode(',',$request->name) as  $perm) {
            $permission = Permission::create(['name' => $perm]);
            $permission->assignRole('super-admin');
        }
        flash('Permission created successfully!')->success();
        return redirect()->route('permissions.index');
    }

}
