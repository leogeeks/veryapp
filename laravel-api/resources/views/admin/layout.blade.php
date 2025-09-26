<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full bg-gray-50">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#ff2d20',
            primaryDark: '#e0261c',
          }
        }
      }
    }
  </script>
  <style>
    :root { --primary: #ff2d20; --primary-dark: #e0261c; }
    .btn-primary { background: var(--primary); color:#fff; border-radius:0.5rem; padding:0.5rem 0.875rem; font-weight:600; box-shadow:0 1px 2px rgba(0,0,0,0.04); }
    .btn-primary:hover { background: var(--primary-dark); }
    .btn-primary:focus { outline:2px solid rgba(255,45,32,0.35); outline-offset:2px; }
    .form-input, .form-select, .form-textarea { background:#fff; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.5rem 0.75rem; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(255,45,32,0.15); outline:none; }
    .table { width:100%; border-collapse:collapse; }
    .table thead th { background:#fff5f4; color:#6b7280; font-weight:600; text-align:left; padding:0.75rem; border-bottom:1px solid #f3f4f6; }
    .table tbody td { padding:0.75rem; border-bottom:1px solid #f3f4f6; }
  </style>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">
  <div class="min-h-full">
    <nav class="bg-white border-b border-[rgba(255,45,32,0.12)] sticky top-0 z-30">
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded hover:bg-gray-100">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <a href="/admin/dashboard" class="text-lg font-semibold text-gray-900"><span class="text-primary">●</span> Admin</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name ?? 'Guest' }}</span>
            <form action="/admin/logout" method="POST">
              @csrf
              <button class="inline-flex items-center px-3 py-1.5 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-primaryDark">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <div class="flex">
      <aside class="w-64 bg-primary text-white hidden md:block min-h-[calc(100vh-4rem)]">
        <nav class="p-4 space-y-1">
          <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/dashboard') ? 'bg-primaryDark font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.91-.91V19.5A2.25 2.25 0 0 1 17 21.75H7A2.25 2.25 0 0 1 4.75 19.5v-6.82l-.91.91a.75.75 0 0 1-1.06-1.06l8.69-8.69Z"/></svg>
            <span>Dashboard</span>
          </a>
          <a href="/admin/users" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/users*') ? 'bg-primaryDark font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M7.5 6a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 20.25a7.5 7.5 0 1 1 15 0v.75H2.25v-.75Z"/><path d="M17.25 7.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM15.75 21v-.75a6 6 0 0 1 9 0V21h-9Z"/></svg>
            <span>Users</span>
          </a>
          <a href="/admin/tasks" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/tasks*') ? 'bg-primaryDark font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M9 12.75 11.25 15l3.75-4.5M21 6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75Z"/></svg>
            <span>Tasks</span>
          </a>
        </nav>
      </aside>
      <div class="md:hidden" x-show="sidebarOpen" @click.away="sidebarOpen=false">
        <aside class="w-64 bg-primary text-white fixed top-16 bottom-0">
          <nav class="p-4 space-y-1">
            <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/dashboard') ? 'bg-primaryDark font-semibold' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.91-.91V19.5A2.25 2.25 0 0 1 17 21.75H7A2.25 2.25 0 0 1 4.75 19.5v-6.82l-.91.91a.75.75 0 0 1-1.06-1.06l8.69-8.69Z"/></svg>
              <span>Dashboard</span>
            </a>
            <a href="/admin/users" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/users*') ? 'bg-primaryDark font-semibold' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M7.5 6a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 20.25a7.5 7.5 0 1 1 15 0v.75H2.25v-.75Z"/><path d="M17.25 7.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM15.75 21v-.75a6 6 0 0 1 9 0V21h-9Z"/></svg>
              <span>Users</span>
            </a>
            <a href="/admin/tasks" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white hover:bg-primaryDark {{ request()->is('admin/tasks*') ? 'bg-primaryDark font-semibold' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M9 12.75 11.25 15l3.75-4.5M21 6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75Z"/></svg>
              <span>Tasks</span>
            </a>
          </nav>
        </aside>
      </div>
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        @if(session('status'))
          <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-800 p-3">{{ session('status') }}</div>
        @endif
        @if(session('error'))
          <div class="mb-4 rounded border border-red-200 bg-red-50 text-red-800 p-3">{{ session('error') }}</div>
        @endif
        @yield('admin_content')
      </main>
    </div>
  </div>
  </body>
  </html>

