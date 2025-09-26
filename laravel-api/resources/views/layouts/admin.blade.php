<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, userMenu: false, groceryOpen: false }" class="h-full bg-gray-50">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    :root { --input-border: #dddddd; }
  </style>
  @stack('head')
  @yield('head')
  @vite([])
</head>
<body class="h-full">
  <div class="min-h-full">
    <!-- Topbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40">
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded hover:bg-gray-100">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <a href="/admin/dashboard" class="inline-flex items-center gap-2 text-lg font-semibold text-gray-900">
              <span class="inline-block w-2.5 h-2.5 rounded-full bg-primary"></span>
              <span>Admin</span>
            </a>
          </div>
          <div class="flex-1 max-w-xl mx-4 hidden md:block">
            <form method="GET" action="{{ url()->current() }}">
              <input name="q" value="{{ request('q') }}" placeholder="Search..." class="input" />
            </form>
          </div>
          <div class="relative" @keydown.escape.window="userMenu=false">
            <button @click="userMenu=!userMenu" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 bg-white shadow-sm hover:bg-gray-50">
              <span class="hidden sm:block text-sm text-gray-700">{{ auth()->user()->name ?? 'User' }}</span>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}</span>
              <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
            </button>
            <div x-show="userMenu" x-cloak @click.away="userMenu=false" class="absolute right-0 mt-2 w-48 rounded-lg border border-gray-200 bg-white shadow-md overflow-hidden">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
              <form action="/admin/logout" method="POST">
                @csrf
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-[#ff2d201a] text-[color:var(--sidebar-text,#333333)] hidden md:block min-h-[calc(100vh-4rem)]">
        <nav class="p-4 space-y-1" x-init="$nextTick(() => { if (window.location.pathname.startsWith('/admin/grocery')) groceryOpen = true })">
          <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/dashboard') ? 'bg-primary text-white font-semibold' : '' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.91-.91V19.5A2.25 2.25 0 0 1 17 21.75H7A2.25 2.25 0 0 1 4.75 19.5v-6.82l-.91.91a.75.75 0 0 1-1.06-1.06l8.69-8.69Z"/></svg>
            <span>Dashboard</span>
          </a>
          <a href="/admin/users" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/users*') ? 'bg-primary text-white font-semibold' : '' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7.5 6a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 20.25a7.5 7.5 0 1 1 15 0v.75H2.25v-.75Z"/><path d="M17.25 7.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM15.75 21v-.75a6 6 0 0 1 9 0V21h-9Z"/></svg>
            <span>Users</span>
          </a>
          <a href="/admin/tasks" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/tasks*') ? 'bg-primary text-white font-semibold' : '' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12.75 11.25 15l3.75-4.5M21 6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75Z"/></svg>
            <span>Tasks</span>
          </a>
          <div class="mt-4">
            <button type="button" @click="groceryOpen = !groceryOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/grocery*') ? 'bg-primary text-white font-semibold' : '' }}">
              <span class="flex items-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18l-1.5 9.75A2.25 2.25 0 0 1 17.26 18H8.24a2.25 2.25 0 0 1-2.22-1.88L4.5 6Z"/><path d="M9 20.25a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/></svg>
                <span>Grocery</span>
              </span>
              <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" :class="{'rotate-180': groceryOpen}"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
            </button>
            <div class="mt-1 space-y-1" x-show="groceryOpen" x-collapse>
              <a href="/admin/grocery/categories" class="flex items-center gap-3 ml-6 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/grocery/categories*') ? 'bg-primary text-white font-semibold' : '' }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                <span>Categories</span>
              </a>
              <a href="/admin/grocery/items" class="flex items-center gap-3 ml-6 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/grocery/items*') ? 'bg-primary text-white font-semibold' : '' }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 7.5A1.5 1.5 0 0 1 7.5 6h9A1.5 1.5 0 0 1 18 7.5v9A1.5 1.5 0 0 1 16.5 18h-9A1.5 1.5 0 0 1 6 16.5v-9Z"/></svg>
                <span>Items</span>
              </a>
            </div>
          </div>
          <a href="/admin/settings" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/settings*') ? 'bg-primary text-white font-semibold' : '' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M10.5 6a4.5 4.5 0 1 1 3 8.485V18a1.5 1.5 0 1 1-3 0v-3.515A4.5 4.5 0 0 1 10.5 6Z"/></svg>
            <span>Settings</span>
          </a>
        </nav>
      </aside>
      <!-- Mobile Sidebar -->
      <div class="md:hidden" x-show="sidebarOpen" @click.away="sidebarOpen=false">
        <aside class="w-64 bg-white text-[color:var(--sidebar-text,#333333)] fixed top-16 bottom-0 border-r border-gray-200">
          <nav class="p-4 space-y-1">
            <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/dashboard') ? 'bg-primary text-white font-semibold' : '' }}">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.91-.91V19.5A2.25 2.25 0 0 1 17 21.75H7A2.25 2.25 0 0 1 4.75 19.5v-6.82l-.91.91a.75.75 0 0 1-1.06-1.06l8.69-8.69Z"/></svg>
              <span>Dashboard</span>
            </a>
            <a href="/admin/users" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/users*') ? 'bg-primary text-white font-semibold' : '' }}">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7.5 6a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 20.25a7.5 7.5 0 1 1 15 0v.75H2.25v-.75Z"/><path d="M17.25 7.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM15.75 21v-.75a6 6 0 0 1 9 0V21h-9Z"/></svg>
              <span>Users</span>
            </a>
            <a href="/admin/tasks" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/tasks*') ? 'bg-primary text-white font-semibold' : '' }}">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12.75 11.25 15l3.75-4.5M21 6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75Z"/></svg>
              <span>Tasks</span>
            </a>
            <a href="/admin/settings" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/90 hover:text-white {{ request()->is('admin/settings*') ? 'bg-primary text-white font-semibold' : '' }}">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M10.5 6a4.5 4.5 0 1 1 3 8.485V18a1.5 1.5 0 1 1-3 0v-3.515A4.5 4.5 0 0 1 10.5 6Z"/></svg>
              <span>Settings</span>
            </a>
          </nav>
        </aside>
      </div>

      <!-- Main content -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        @if(session('status'))
          <div class="mb-4 alert-success">{{ session('status') }}</div>
        @endif
        @if(session('error'))
          <div class="mb-4 alert-error">{{ session('error') }}</div>
        @endif
        <div class="card p-6">
          @yield('admin_content')
        </div>
      </main>
    </div>

    <footer class="border-t border-gray-200 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 text-sm text-gray-500">
        © {{ date('Y') }} Admin Panel
      </div>
    </footer>
  </div>
  @stack('scripts')
</body>
</html>

