<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-user')->except(['profile', 'profileUpdate']);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $users = User::paginate(15);
        return view('backend.users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('backend.users.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $userData = $request->except(['role']);
        $user = User::create($userData);
        $user->assignRole($request->role);
        flash('User created successfully!')->success();
        return redirect()->route('users.index');

    }


    public function show(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('backend.users.show', compact('user', 'roles'));
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('backend.users.edit', compact('user', 'roles'));
    }


    public function update(UserUpdateRequest $request, User $user)
    {
        $userData = $request->except(['role']);
        $user->update($userData);
        $user->syncRoles($request->role);
        flash('User updated successfully!')->success();
        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id || $user->id == 1) {
            flash('You can not delete logged in user!')->warning();
            return back();
        }
        $user->delete();
        flash('User deleted successfully!')->info();
        return redirect()->route('users.index');
    }


    public function profile(User $user)
    {
        return view('backend.users.profile', compact('user'));
    }

    public function profileUpdate(UserUpdateRequest $request, User $user)
    {
        $userData = $request->except(['password']);
        if ($request->password && $request->password !== '') {
            $userData['password'] = parse_url($request->profile_photo, PHP_URL_PATH);
        }
        $user->update($userData);
        flash('Profile updated successfully!')->success();
        return redirect()->route('users.index');
    }
}
