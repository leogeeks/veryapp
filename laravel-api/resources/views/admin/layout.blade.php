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
            primary: '#f04848',
            primaryDark: '#cc3d3d',
          }
        }
      }
    }
  </script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">
  <div class="min-h-full">
    <nav class="bg-white border-b-2 border-primary sticky top-0 z-30">
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
      <aside class="w-64 bg-white border-r-2 border-primary/30 hidden md:block min-h-[calc(100vh-4rem)]">
        <nav class="p-4 space-y-1">
          <a href="/admin/dashboard" class="block px-3 py-2 rounded-lg hover:bg-primary/10 hover:text-primary">Dashboard</a>
          <a href="/admin/users" class="block px-3 py-2 rounded-lg hover:bg-primary/10 hover:text-primary">Users</a>
        </nav>
      </aside>
      <div class="md:hidden" x-show="sidebarOpen" @click.away="sidebarOpen=false">
        <aside class="w-64 bg-white border-r-2 border-primary/30 fixed top-16 bottom-0">
          <nav class="p-4 space-y-1">
            <a href="/admin/dashboard" class="block px-3 py-2 rounded-lg hover:bg-primary/10 hover:text-primary">Dashboard</a>
            <a href="/admin/users" class="block px-3 py-2 rounded-lg hover:bg-primary/10 hover:text-primary">Users</a>
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

