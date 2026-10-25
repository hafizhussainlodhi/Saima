<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $availablePermissions = User::PERMISSIONS;
        return view('admin.users.index', compact('users', 'availablePermissions'));
    }

    public function create()
    {
        $availablePermissions = User::PERMISSIONS;
        return view('admin.users.create', compact('availablePermissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'    => ['required', 'string', 'min:6'],
            'role'        => ['required', 'string', 'in:admin,editor,manager,staff'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
            'is_active'   => ['nullable'],
        ]);

        $permissions = $request->input('permissions', []);
        if ($data['role'] === 'admin' && empty($permissions)) {
            $permissions = array_keys(User::PERMISSIONS);
        }

        User::create([
            'name'        => $data['name'],
            'email'       => strtolower(trim($data['email'])),
            'password'    => Hash::make($data['password']),
            'role'        => $data['role'],
            'permissions' => $permissions,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')->with('success', "User '{$data['name']}' created successfully with assigned permissions.");
    }

    public function edit(User $user)
    {
        $availablePermissions = User::PERMISSIONS;
        return view('admin.users.edit', compact('user', 'availablePermissions'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'    => ['nullable', 'string', 'min:6'],
            'role'        => ['required', 'string', 'in:admin,editor,manager,staff'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
            'is_active'   => ['nullable'],
        ]);

        $user->name = $data['name'];
        $user->email = strtolower(trim($data['email']));
        $user->role = $data['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        $permissions = $request->input('permissions', []);
        if ($data['role'] === 'admin' && empty($permissions)) {
            $permissions = array_keys(User::PERMISSIONS);
        }
        $user->permissions = $permissions;
        $user->is_active = $request->boolean('is_active', true);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User '{$user->name}' updated successfully.");
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if (User::count() <= 1) {
            return back()->with('error', 'Cannot delete the only remaining admin user.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User '{$name}' has been deleted.");
    }
}
