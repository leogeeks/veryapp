@extends('layouts.admin')

@section('admin_content')
  <h2 class="text-xl font-semibold mb-4">Create Task</h2>
  <form method="POST" action="/admin/tasks">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">User</label>
        <select name="user_id" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach($users as $u)
          <option value="{{ $u->id }}" @selected(old('user_id')==$u->id)>{{ $u->name }}</option>
          @endforeach
        </select>
        @error('user_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input name="title" value="{{ old('title') }}" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none" required>
        @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Category</label>
        <select name="category" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach(['Work','Family','Personal','Other'] as $c)
          <option value="{{ $c }}" @selected(old('category')==$c)>{{ $c }}</option>
          @endforeach
        </select>
        @error('category')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Priority</label>
        <select name="priority" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
          @foreach(['High','Medium','Low'] as $p)
          <option value="{{ $p }}" @selected(old('priority')==$p)>{{ $p }}</option>
          @endforeach
        </select>
        @error('priority')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none" rows="4">{{ old('description') }}</textarea>
        @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Due Date</label>
        <input type="datetime-local" name="due_date" value="{{ old('due_date') }}" class="w-full h-12 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#f04848] focus:outline-none">
        @error('due_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
    <div class="mt-6">
      <button class="px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-primaryDark">Create</button>
      <a href="/admin/tasks" class="ml-2 text-gray-700 hover:underline">Cancel</a>
    </div>
  </form>
@endsection

