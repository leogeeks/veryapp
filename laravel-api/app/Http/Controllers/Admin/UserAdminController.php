<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($q = $request->get('q')) {
            $query->where(function ($q2) use ($q) {
                $q2->where('name', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%");
            });
        }
        $users = $query->orderByDesc('id')->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect('/admin/users')->with('status', 'User created');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect('/admin/users/'.$user->id.'/edit')->with('status', 'Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('status', 'Deleted');
    }
}
