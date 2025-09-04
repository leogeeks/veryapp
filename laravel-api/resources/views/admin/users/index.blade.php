@extends('layouts.admin')

@section('content')
  <div class="d-flex align-items-center justify-content-between mt-3 mb-3">
    <h2>Users</h2>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Provider</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role ?? ($user->is_admin ? 'admin' : 'user') }}</td>
          <td>{{ $user->provider ? $user->provider . ' #' . $user->provider_id : '-' }}</td>
          <td>
            @if($user->role !== 'super_admin')
              @if($user->role === 'admin')
                <form action="/admin/users/{{ $user->id }}/remove-admin" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-sm btn-warning" type="submit">Remove Admin</button>
                </form>
              @else
                <form action="/admin/users/{{ $user->id }}/make-admin" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-sm btn-primary" type="submit">Make Admin</button>
                </form>
              @endif
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
@endsection

