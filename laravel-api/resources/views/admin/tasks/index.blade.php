@extends('layouts.admin')

@section('admin_content')
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Tasks</h2>
      <a href="/admin/tasks/create" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-primary text-white text-sm font-semibold shadow-sm hover:bg-primaryDark">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5a.75.75 0 0 1 .75.75v6h6a.75.75 0 0 1 0 1.5h-6v6a.75.75 0 0 1-1.5 0v-6h-6a.75.75 0 0 1 0-1.5h6v-6A.75.75 0 0 1 12 4.5Z"/></svg>
        Add New
      </a>
    </div>
    <div class="px-6 py-4">
      <form method="GET" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search tasks..." class="w-full md:w-64 h-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none" />
      </form>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">ID</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Title</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">User</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Category</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Priority</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Status</th>
              <th class="px-4 py-3 text-right font-bold text-xs tracking-wider uppercase text-gray-600">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            @foreach($tasks as $task)
            <tr class="hover:bg-gray-50">
          <td class="px-4 py-3">{{ $task->id }}</td>
          <td class="px-4 py-3">{{ $task->title }}</td>
          <td class="px-4 py-3">{{ $task->user?->name }}</td>
          <td class="px-4 py-3">{{ $task->category }}</td>
          <td class="px-4 py-3">{{ $task->priority }}</td>
          <td class="px-4 py-3">{!! $task->is_completed ? '<span class="text-green-600">Completed</span>' : '<span class="text-gray-600">Open</span>' !!}</td>
          <td class="px-4 py-3 text-right">
            <a href="/admin/tasks/{{ $task->id }}/edit" class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary text-white rounded-md hover:bg-red-600 mr-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M16.862 3.487a1.5 1.5 0 0 1 2.121 0l1.53 1.53a1.5 1.5 0 0 1 0 2.12l-9.9 9.9a1.5 1.5 0 0 1-.53.35l-4.24 1.41a.75.75 0 0 1-.948-.948l1.41-4.24a1.5 1.5 0 0 1 .35-.53l9.9-9.9Z"/></svg>
              Edit
            </a>
            @if(!$task->is_completed)
            <form action="/admin/tasks/{{ $task->id }}/complete" method="POST" class="inline">
              @csrf
              <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-500 text-white rounded-md hover:bg-green-600" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M9 12.75 11.25 15l3.75-4.5"/><path d="M21 6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75Z"/></svg>
                Complete
              </button>
            </form>
            @endif
            <form action="/admin/tasks/{{ $task->id }}" method="POST" class="inline" onsubmit="return confirm('Delete task?')">
              @csrf
              @method('DELETE')
              <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M9 3.75h6a.75.75 0 0 1 .75.75V6h3a.75.75 0 0 1 0 1.5h-.71l-1.1 12.02A2.25 2.25 0 0 1 14.69 21H9.31a2.25 2.25 0 0 1-2.25-2.48L5.96 7.5H5.25A.75.75 0 0 1 5.25 6h3V4.5a.75.75 0 0 1 .75-.75Z"/></svg>
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
    <div class="mt-4">{{ $tasks->withQueryString()->links() }}</div>
    </div>
  </div>
@endsection

