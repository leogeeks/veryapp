@extends('admin.layout')

@section('admin_content')
  <h2 class="text-xl font-semibold mb-4">Edit User #{{ $user->id }}</h2>
  <form method="POST" action="/admin/users/{{ $user->id }}">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full rounded border-gray-300" required>
        @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded border-gray-300" required>
        @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">New Password (optional)</label>
        <input type="password" name="password" class="mt-1 w-full rounded border-gray-300">
        @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Role</label>
        <select name="role" class="mt-1 w-full rounded border-gray-300">
          <option value="user" @selected(old('role', $user->role)==='user')>User</option>
          <option value="admin" @selected(old('role', $user->role)==='admin')>Admin</option>
          <option value="super_admin" @selected(old('role', $user->role)==='super_admin')>Super Admin</option>
        </select>
        @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
    <div class="mt-6">
      <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
      <a href="/admin/users" class="ml-2 text-gray-700 hover:underline">Cancel</a>
    </div>
  </form>
  <form method="POST" action="/admin/users/{{ $user->id }}" class="mt-6" onsubmit="return confirm('Delete user?')">
    @csrf
    @method('DELETE')
    <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete User</button>
  </form>
@endsection

