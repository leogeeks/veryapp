@extends('layouts.admin')

@section('admin_content')
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-900">Items</h2>
      <a href="/admin/grocery/items/create" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-red-600">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5a.75.75 0 0 1 .75.75v6h6a.75.75 0 0 1 0 1.5h-6v6a.75.75 0 0 1-1.5 0v-6h-6a.75.75 0 0 1 0-1.5h6v-6A.75.75 0 0 1 12 4.5Z"/></svg>
        Add New
      </a>
    </div>
    <div class="px-6 py-4">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">ID</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Image</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Title</th>
              <th class="px-4 py-3 text-left font-bold text-xs tracking-wider uppercase text-gray-600">Category</th>
              <th class="px-4 py-3 text-right font-bold text-xs tracking-wider uppercase text-gray-600">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            @foreach($items as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-3">{{ $item->id }}</td>
              <td class="px-4 py-3">
                @if($item->image)
                  <img src="/storage/items/{{ $item->image }}" alt="{{ $item->title }}" class="w-12 h-12 object-cover rounded-md border" />
                @else
                  <span class="text-gray-500">—</span>
                @endif
              </td>
              <td class="px-4 py-3">{{ $item->title }}</td>
              <td class="px-4 py-3">{{ $item->category?->title }}</td>
              <td class="px-4 py-3 text-right">
                <a href="/admin/grocery/items/{{ $item->id }}/edit" class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary text-white rounded-md hover:bg-red-600 mr-2">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M16.862 3.487a1.5 1.5 0 0 1 2.121 0l1.53 1.53a1.5 1.5 0 0 1 0 2.12l-9.9 9.9a1.5 1.5 0 0 1-.53.35l-4.24 1.41a.75.75 0 0 1-.948-.948l1.41-4.24a1.5 1.5 0 0 1 .35-.53l9.9-9.9Z"/></svg>
                  Edit
                </a>
                <form action="/admin/grocery/items/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete item?')">
                  @csrf
                  @method('DELETE')
                  <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600" type="submit">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3.75h6a.75.75 0 0 1 .75.75V6h3a.75.75 0 0 1 0 1.5h-.71l-1.1 12.02A2.25 2.25 0 0 1 14.69 21H9.31a2.25 2.25 0 0 1-2.25-2.48L5.96 7.5H5.25A.75.75 0 0 1 5.25 6h3V4.5a.75.75 0 0 1 .75-.75Z"/></svg>
                    Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-4">{{ $items->links() }}</div>
    </div>
  </div>
@endsection

