<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => 'admin', 'is_admin' => true]);
        return redirect()->back()->with('status', 'User is now admin');
    }

    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'super_admin') {
            return redirect()->back()->with('error', 'Cannot change super admin');
        }
        $user->update(['role' => 'user', 'is_admin' => false]);
        return redirect()->back()->with('status', 'Admin role removed');
    }
}
