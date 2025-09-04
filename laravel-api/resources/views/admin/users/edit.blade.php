@extends('admin.layout')

@section('admin_content')
  <h2>Edit User #{{ $user->id }}</h2>
  <div class="card">
    <div class="card-body">
      <form method="POST" action="#">
        @csrf
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input class="form-control" value="{{ $user->name }}" disabled>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input class="form-control" value="{{ $user->email }}" disabled>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <input class="form-control" value="{{ $user->role }}" disabled>
        </div>
        <a href="/admin/users" class="btn btn-secondary">Back</a>
      </form>
    </div>
  </div>
@endsection

