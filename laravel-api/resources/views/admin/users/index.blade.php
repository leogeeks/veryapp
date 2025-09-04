@extends('admin.layout')

@section('admin_content')
  <div class="flex items-center justify-between mt-2 mb-4">
    <h2 class="text-xl font-semibold">Users</h2>
    <a href="/admin/users/create" class="inline-flex items-center px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">Create User</a>
  </div>
  <form method="GET" class="mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search users..." class="w-full md:w-64 rounded border-gray-300" />
  </form>
  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left font-medium text-gray-700">ID</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Name</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Email</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Role</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Provider</th>
          <th class="px-4 py-3 text-right font-medium text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @foreach($users as $user)
        <tr>
          <td class="px-4 py-3">{{ $user->id }}</td>
          <td class="px-4 py-3">{{ $user->name }}</td>
          <td class="px-4 py-3">{{ $user->email }}</td>
          <td class="px-4 py-3">{{ $user->role ?? ($user->is_admin ? 'admin' : 'user') }}</td>
          <td class="px-4 py-3">{{ $user->provider ? $user->provider . ' #' . $user->provider_id : '-' }}</td>
          <td class="px-4 py-3 text-right">
            <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-600 hover:underline mr-3">Edit</a>
            @if($user->role !== 'super_admin')
              @if($user->role === 'admin')
                <form action="/admin/users/{{ $user->id }}/remove-admin" method="POST" class="inline">
                  @csrf
                  <button class="text-amber-600 hover:underline" type="submit">Remove Admin</button>
                </form>
              @else
                <form action="/admin/users/{{ $user->id }}/make-admin" method="POST" class="inline">
                  @csrf
                  <button class="text-blue-600 hover:underline" type="submit">Make Admin</button>
                </form>
              @endif
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $users->withQueryString()->links() }}</div>
@endsection

