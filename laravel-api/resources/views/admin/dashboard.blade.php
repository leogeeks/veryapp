@extends('admin.layout')

@section('admin_content')
  <div>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-1">Overview of your application.</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
      <div class="rounded-xl border border-gray-200 bg-white p-5">
        <div class="text-gray-500 text-sm">Total Users</div>
        <div class="mt-2 text-2xl font-semibold">{{ \App\Models\User::count() }}</div>
      </div>
      <div class="rounded-xl border border-gray-200 bg-white p-5">
        <div class="text-gray-500 text-sm">Admins</div>
        <div class="mt-2 text-2xl font-semibold">{{ \App\Models\User::whereIn('role', ['admin','super_admin'])->count() }}</div>
      </div>
      <div class="rounded-xl border border-gray-200 bg-white p-5">
        <div class="text-gray-500 text-sm">Super Admins</div>
        <div class="mt-2 text-2xl font-semibold">{{ \App\Models\User::where('role', 'super_admin')->count() }}</div>
      </div>
    </div>
  </div>
@endsection

