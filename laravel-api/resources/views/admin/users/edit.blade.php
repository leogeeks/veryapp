@extends('layouts.admin')

@section('admin_content')
  <div class="bg-white rounded-xl shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Edit User #{{ $user->id }}</h2>
    </div>
    <div class="p-6">
      <form method="POST" action="/admin/users/{{ $user->id }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
            <input name="name" value="{{ old('name', $user->name) }}" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#f04848] focus:outline-none" required>
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#f04848] focus:outline-none" required>
            @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">New Password (optional)</label>
            <input type="password" name="password" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#f04848] focus:outline-none">
            @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#f04848] focus:outline-none">
              <option value="user" @selected(old('role', $user->role)==='user')>User</option>
              <option value="admin" @selected(old('role', $user->role)==='admin')>Admin</option>
              <option value="super_admin" @selected(old('role', $user->role)==='super_admin')>Super Admin</option>
            </select>
            @error('role')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
          </div>
        </div>
        <div class="mt-6 flex items-center gap-3">
          <button class="px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow-sm hover:bg-primaryDark">Save</button>
          <a href="/admin/users" class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50">Cancel</a>
        </div>
      </form>
      <form method="POST" action="/admin/users/{{ $user->id }}" class="mt-6" onsubmit="return confirm('Delete user?')">
        @csrf
        @method('DELETE')
        <button class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold shadow-sm hover:bg-red-700">Delete User</button>
      </form>
    </div>
  </div>
@endsection

