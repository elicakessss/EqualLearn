<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all()->unique('name')->values(); // Ensure unique roles by name
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::find($request->role_id);
        
        // Remove existing roles and assign new one
        $user->roles()->detach();
        $user->roles()->attach($role);
        
        return redirect()->route('admin.users.index')
            ->with('success', "User role updated to {$role->name} successfully.");
    }
}
