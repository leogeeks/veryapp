@extends('admin.layout')

@section('admin_content')
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Tasks</h2>
    <a href="/admin/tasks/create" class="inline-flex items-center px-3 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-primaryDark">Create Task</a>
  </div>
  <form method="GET" class="mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search tasks..." class="w-full md:w-64 rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
  </form>
  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left font-medium text-gray-700">ID</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Title</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">User</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Category</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Priority</th>
          <th class="px-4 py-3 text-left font-medium text-gray-700">Status</th>
          <th class="px-4 py-3 text-right font-medium text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @foreach($tasks as $task)
        <tr>
          <td class="px-4 py-3">{{ $task->id }}</td>
          <td class="px-4 py-3">{{ $task->title }}</td>
          <td class="px-4 py-3">{{ $task->user?->name }}</td>
          <td class="px-4 py-3">{{ $task->category }}</td>
          <td class="px-4 py-3">{{ $task->priority }}</td>
          <td class="px-4 py-3">{!! $task->is_completed ? '<span class="text-green-600">Completed</span>' : '<span class="text-gray-600">Open</span>' !!}</td>
          <td class="px-4 py-3 text-right">
            <a href="/admin/tasks/{{ $task->id }}/edit" class="text-primary hover:underline mr-3">Edit</a>
            @if(!$task->is_completed)
            <form action="/admin/tasks/{{ $task->id }}/complete" method="POST" class="inline">
              @csrf
              <button class="text-primary hover:underline" type="submit">Mark Complete</button>
            </form>
            @endif
            <form action="/admin/tasks/{{ $task->id }}" method="POST" class="inline" onsubmit="return confirm('Delete task?')">
              @csrf
              @method('DELETE')
              <button class="text-red-600 hover:underline ml-2" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $tasks->withQueryString()->links() }}</div>
@endsection

