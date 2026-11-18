<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventKu Admin — @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen">
<div class="flex min-h-screen">
    <aside class="w-56 bg-white border-r border-slate-200 p-4 flex flex-col">
        <a href="{{ route('events.index') }}" class="font-bold text-indigo-600 mb-6">🎟️ EventKu Admin</a>

        <a href="{{ route('admin.events.index') }}"
           class="px-3 py-2 rounded text-sm {{ request()->routeIs('admin.events.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            📋 Kelola Acara
        </a>
        <a href="{{ route('admin.registrations.index') }}"
           class="px-3 py-2 rounded text-sm {{ request()->routeIs('admin.registrations.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            👥 Registrasi
        </a>

        <div class="mt-auto text-xs text-slate-400">
            <p class="mb-2">Masuk sebagai <span class="font-medium text-slate-600">{{ auth()->user()->name }}</span></p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:text-red-600">↩︎ Keluar</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 p-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
