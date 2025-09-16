<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\BusinessException;

class UserController extends Controller
{
    public function index()
    {
        try {
            return $this->successResponse(User::paginate(15));
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to fetch users');
        }
    }

    public function show(User $user)
    {
        return $this->successResponse($user);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            return $this->successResponse($user, 'Created', 201);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to create user');
        }
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $user->update($data);
            return $this->successResponse($user);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to update user');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return $this->successResponse(null, 'Deleted');
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to delete user');
        }
    }
}

