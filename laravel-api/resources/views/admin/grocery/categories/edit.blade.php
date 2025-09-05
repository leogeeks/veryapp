@extends('layouts.admin')

@section('admin_content')
  <div class="bg-white rounded-xl shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Edit Category #{{ $category->id }}</h2>
    </div>
    <div class="p-6">
      <form method="POST" action="/admin/grocery/categories/{{ $category->id }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input name="title" value="{{ old('title', $category->title) }}" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#f04848] focus:outline-none" required>
            @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
          </div>
        </div>
        <div class="mt-6 flex items-center gap-3">
          <button class="px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow-sm hover:bg-red-600">Save</button>
          <a href="/admin/grocery/categories" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300">Cancel</a>
        </div>
      </form>
    </div>
  </div>
@endsection

