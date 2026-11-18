@extends('layouts.admin')

@section('title', 'Registrasi')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Registrasi</h1>

<div class="bg-white rounded-lg border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-500 border-b border-slate-200">
                <th class="px-4 py-3">Kode Tiket</th>
                <th class="px-4 py-3">Peserta</th>
                <th class="px-4 py-3">Acara</th>
                <th class="px-4 py-3">Jenis Tiket</th>
                <th class="px-4 py-3">Jumlah</th>
                <th class="px-4 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $registration)
                <tr class="border-b border-slate-100">
                    <td class="px-4 py-3 font-mono">{{ $registration->unique_code }}</td>
                    <td class="px-4 py-3">{{ $registration->participant->user->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $registration->ticket->event->title ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $registration->ticket->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $registration->quantity }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full
                            {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada registrasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
