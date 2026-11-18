@extends('layouts.admin')

@section('title', 'Kelola Acara')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Kelola Acara</h1>
    <a href="{{ route('admin.events.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700">
        + Acara Baru
    </a>
</div>

<div class="bg-white rounded-lg border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-500 border-b border-slate-200">
                <th class="px-4 py-3">Judul</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Lokasi</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr class="border-b border-slate-100">
                    <td class="px-4 py-3 font-medium">{{ $event->title }}</td>
                    <td class="px-4 py-3">{{ $event->category->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $event->event_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ $event->location }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full
                            {{ $event->status === 'open' ? 'bg-green-100 text-green-700' : ($event->status === 'closed' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600') }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="{{ route('admin.events.tickets.index', $event->slug) }}"
                           class="text-xs text-indigo-600 hover:underline mr-2">Tiket</a>
                        <a href="{{ route('admin.events.edit', $event->id) }}"
                           class="text-xs text-slate-600 border border-slate-300 rounded px-2 py-1 hover:bg-slate-50 mr-1">Edit</a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" class="inline"
                              onsubmit="return confirm('Hapus event ini beserta tiketnya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-white bg-red-600 rounded px-2 py-1 hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada acara.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
