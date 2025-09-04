@extends('layouts.admin')

@section('admin_content')
  <h2 class="text-xl font-semibold mb-4">Create User</h2>
  <form method="POST" action="/admin/users">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" required>
        @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" required>
        @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" class="mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" required>
        @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Role</label>
        <select name="role" class="mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
          <option value="user">User</option>
          <option value="admin">Admin</option>
          <option value="super_admin">Super Admin</option>
        </select>
        @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
    <div class="mt-6">
      <button class="px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-primaryDark">Create</button>
      <a href="/admin/users" class="ml-2 text-gray-700 hover:underline">Cancel</a>
    </div>
  </form>
@endsection

