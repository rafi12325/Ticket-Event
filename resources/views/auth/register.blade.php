@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="max-w-sm mx-auto mt-10">
    <div class="bg-white rounded-lg border border-slate-200 p-6">
        <h1 class="text-xl font-bold mb-1">Daftar Akun</h1>
        <p class="text-sm text-slate-500 mb-4">Buat akun peserta untuk membeli tiket acara.</p>

        @include('partials.errors')

        <form method="POST" action="{{ url('/register') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-medium">
                Daftar
            </button>
        </form>

        <p class="text-sm text-slate-500 mt-4 text-center">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 font-medium">Masuk</a>
        </p>
    </div>
</div>
@endsection
