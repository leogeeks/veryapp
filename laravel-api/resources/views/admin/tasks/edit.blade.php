@extends('layouts.admin')

@section('admin_content')
  <div class="bg-white rounded-xl shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Edit Task #{{ $task->id }}</h2>
    </div>
    <div class="p-6">
      <form method="POST" action="/admin/tasks/{{ $task->id }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">User</label>
        <select name="user_id" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach($users as $u)
          <option value="{{ $u->id }}" @selected(old('user_id', $task->user_id)==$u->id)>{{ $u->name }}</option>
          @endforeach
        </select>
        @error('user_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input name="title" value="{{ old('title', $task->title) }}" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none" required>
        @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Category</label>
        <select name="category" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach(['Work','Family','Personal','Other'] as $c)
          <option value="{{ $c }}" @selected(old('category', $task->category)==$c)>{{ $c }}</option>
          @endforeach
        </select>
        @error('category')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Priority</label>
        <select name="priority" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach(['High','Medium','Low'] as $p)
          <option value="{{ $p }}" @selected(old('priority', $task->priority)==$p)>{{ $p }}</option>
          @endforeach
        </select>
        @error('priority')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none" rows="4">{{ old('description', $task->description) }}</textarea>
        @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Due Date</label>
        <input type="datetime-local" name="due_date" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d\TH:i')) }}" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
        @error('due_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="inline-flex items-center mt-7">
          <input type="checkbox" name="is_completed" value="1" @checked(old('is_completed', $task->is_completed)) class="rounded border-gray-300 text-primary focus:ring-primary">
          <span class="ml-2 text-sm text-gray-700">Completed</span>
        </label>
        @error('is_completed')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
        </div>
        <div class="mt-6 flex items-center gap-3">
          <button class="px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow-sm hover:bg-primaryDark">Save</button>
          <a href="/admin/tasks" class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50">Cancel</a>
        </div>
      </form>
    </div>
  </div>
@endsection

