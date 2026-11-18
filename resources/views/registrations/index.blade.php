@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tiket Saya</h1>

<div class="grid md:grid-cols-2 gap-4">
    @forelse($registrations as $registration)
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <div class="flex justify-between items-start">
                <h2 class="font-semibold">{{ $registration->ticket->event->title }}</h2>
                <span class="text-xs px-2 py-0.5 rounded-full
                    {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($registration->status) }}
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">
                {{ $registration->ticket->name }} · {{ $registration->quantity }} tiket ·
                🗓 {{ $registration->ticket->event->event_date->format('d M Y') }}
            </p>
            <div class="mt-3 bg-slate-900 text-green-300 font-mono text-center text-lg tracking-widest rounded py-2">
                {{ $registration->unique_code }}
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg border border-dashed border-slate-300 p-6 text-center text-slate-500">
            <p class="font-medium">Belum ada tiket</p>
            <p class="text-sm mt-1">
                <a href="{{ route('events.index') }}" class="text-indigo-600 hover:underline">Lihat semua acara</a>
                untuk membeli tiket pertamamu.
            </p>
        </div>
    @endforelse
</div>
@endsection
