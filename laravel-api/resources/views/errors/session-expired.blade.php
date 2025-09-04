<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Session Expired</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
  <div class="max-w-md w-full bg-white shadow-lg rounded-xl p-8 text-center">
    <div class="mx-auto w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mb-4">
      <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <h1 class="text-2xl font-semibold text-gray-900">Your session has expired</h1>
    <p class="mt-2 text-gray-600">Please log in again to continue.</p>
    <a href="/admin/login" class="inline-flex items-center justify-center mt-6 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Go to Login</a>
    <p class="mt-2 text-sm text-gray-500">Redirecting in <span id="count">5</span>…</p>
  </div>
  <script>
    let n = 5;
    const el = document.getElementById('count');
    const timer = setInterval(() => {
      n -= 1; el.textContent = n;
      if (n <= 0) { clearInterval(timer); window.location.href = '/admin/login'; }
    }, 1000);
  </script>
</body>
</html>

