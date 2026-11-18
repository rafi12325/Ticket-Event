<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventKu — @yield('title', 'Semua Acara')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen flex flex-col">
<nav class="bg-white border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
        <a href="{{ route('events.index') }}" class="font-bold text-indigo-600 text-lg">🎟️ EventKu</a>
        <div class="flex items-center gap-4 text-sm">
            <a href="{{ route('events.index') }}" class="hover:text-indigo-600">Semua Acara</a>
            @auth
                @if(auth()->user()->isParticipant())
                    <a href="{{ route('tickets.my') }}" class="hover:text-indigo-600">Tiket Saya</a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.events.index') }}" class="hover:text-indigo-600">Dashboard Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Masuk</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<main class="max-w-6xl w-full mx-auto px-4 py-6 flex-1">
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
</main>

<footer class="py-4 text-center text-xs text-slate-400">
    EventKu
</footer>
</body>
</html>
