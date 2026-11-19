@extends('layouts.admin')

@section('title', 'Tiket — '.$event->title)

@section('content')
<div class="flex justify-between items-center mb-4">
    <div>
        <a href="{{ route('admin.events.index') }}" class="text-sm text-indigo-600 hover:underline">← Kelola Acara</a>
        <h1 class="text-2xl font-bold mt-1">Tiket: {{ $event->title }}</h1>
    </div>
    <a href="{{ route('admin.events.tickets.create', $event->slug) }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700">
        + Tiket Baru
    </a>
</div>

<div class="bg-white rounded-lg border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-500 border-b border-slate-200">
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3">Kuota</th>
                <th class="px-4 py-3">Terjual</th>
                <th class="px-4 py-3">Sisa</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr class="border-b border-slate-100">
                    <td class="px-4 py-3 font-medium">{{ $ticket->name }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $ticket->quota }}</td>
                    <td class="px-4 py-3">{{ $ticket->sold }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full
                            {{ $ticket->remainingQuota() > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $ticket->remainingQuota() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}"
                           class="text-xs text-slate-600 border border-slate-300 rounded px-2 py-1 hover:bg-slate-50 mr-1">Edit</a>
                        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}" class="inline"
                              onsubmit="return confirm('Hapus tiket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-white bg-red-600 rounded px-2 py-1 hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada tiket untuk event ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
