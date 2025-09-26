@extends('layouts.admin')

@section('admin_content')
  <div class="card overflow-hidden">
    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Users</h2>
      <a href="/admin/users/create" class="btn-primary">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5a.75.75 0 0 1 .75.75v6h6a.75.75 0 0 1 0 1.5h-6v6a.75.75 0 0 1-1.5 0v-6h-6a.75.75 0 0 1 0-1.5h6v-6A.75.75 0 0 1 12 4.5Z"/></svg>
        Add New
      </a>
    </div>
    <div class="px-6 py-4">
      <form method="GET" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search users..." class="input md:w-64" />
      </form>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="table-header">
            <tr>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase">ID</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase">Name</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase">Email</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase">Role</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase">Provider</th>
              <th class="px-4 py-3 text-right font-bold text-xs tracking-wider uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 even:bg-[#f9f9f9]">
              <td class="px-4 py-3">{{ $user->id }}</td>
              <td class="px-4 py-3">{{ $user->name }}</td>
              <td class="px-4 py-3">{{ $user->email }}</td>
              <td class="px-4 py-3">{{ $user->role ?? ($user->is_admin ? 'admin' : 'user') }}</td>
              <td class="px-4 py-3">{{ $user->provider ? $user->provider . ' #' . $user->provider_id : '-' }}</td>
              <td class="px-4 py-3 text-right">
                <a href="/admin/users/{{ $user->id }}/edit" class="btn-primary mr-2 px-3 py-1.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M16.862 3.487a1.5 1.5 0 0 1 2.121 0l1.53 1.53a1.5 1.5 0 0 1 0 2.12l-9.9 9.9a1.5 1.5 0 0 1-.53.35l-4.24 1.41a.75.75 0 0 1-.948-.948l1.41-4.24a1.5 1.5 0 0 1 .35-.53l9.9-9.9Z"/></svg>
                  Edit
                </a>
                <a href="/admin/users/{{ $user->id }}/edit" class="btn-secondary mr-2 px-3 py-1.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm9.75-3a3 3 0 100 6 3 3 0 000-6Z"/></svg>
                  View
                </a>
                @if($user->role !== 'super_admin')
                  @if($user->role === 'admin')
                    <form action="/admin/users/{{ $user->id }}/remove-admin" method="POST" class="inline">
                      @csrf
                      <button class="btn-muted px-3 py-1.5" type="submit">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3.75h6a.75.75 0 0 1 .75.75V6h3a.75.75 0 0 1 0 1.5h-.71l-1.1 12.02A2.25 2.25 0 0 1 14.69 21H9.31a2.25 2.25 0 0 1-2.25-2.48L5.96 7.5H5.25A.75.75 0 0 1 5.25 6h3V4.5a.75.75 0 0 1 .75-.75Z"/></svg>
                        Remove Admin
                      </button>
                    </form>
                  @else
                    <form action="/admin/users/{{ $user->id }}/make-admin" method="POST" class="inline">
                      @csrf
                      <button class="btn-muted px-3 py-1.5" type="submit">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3.75h6a.75.75 0 0 1 .75.75V6h3a.75.75 0 0 1 0 1.5h-.71l-1.1 12.02A2.25 2.25 0 0 1 14.69 21H9.31a2.25 2.25 0 0 1-2.25-2.48L5.96 7.5H5.25A.75.75 0 0 1 5.25 6h3V4.5a.75.75 0 0 1 .75-.75Z"/></svg>
                        Make Admin
                      </button>
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
    </div>
  </div>
@endsection

