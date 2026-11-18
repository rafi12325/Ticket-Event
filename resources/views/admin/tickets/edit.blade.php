@extends('layouts.admin')

@section('title', 'Edit Tiket')

@section('content')
<a href="{{ route('admin.events.tickets.index', $ticket->event->slug) }}" class="text-sm text-indigo-600 hover:underline">← Kembali</a>
<h1 class="text-2xl font-bold mt-1 mb-4">Edit Tiket: {{ $ticket->name }}</h1>

<div class="bg-white rounded-lg border border-slate-200 p-6 max-w-md">
    @include('partials.errors')

    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Nama Tiket <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $ticket->name) }}"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
            <input type="number" name="price" value="{{ old('price', $ticket->price) }}" min="0" step="1000"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            @error('price')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Kuota <span class="text-red-500">*</span></label>
            <input type="number" name="quota" value="{{ old('quota', $ticket->quota) }}" min="1"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            @error('quota')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700">
                Perbarui
            </button>
            <a href="{{ route('admin.events.tickets.index', $ticket->event->slug) }}"
               class="border border-slate-300 px-4 py-2 rounded text-sm hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
