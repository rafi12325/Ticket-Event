@extends('layouts.app')

@section('title', 'Semua Acara')

@section('content')
<h1 class="text-2xl font-bold mb-4">Semua Acara</h1>

<div class="grid md:grid-cols-3 gap-4">
    @forelse($events as $event)
        <a href="{{ route('events.show', $event->slug) }}"
           class="bg-white rounded-lg border border-slate-200 hover:shadow-md overflow-hidden transition">
            <div class="h-24 bg-gradient-to-r from-indigo-100 via-indigo-50 to-slate-200"></div>
            <div class="p-4">
                <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">
                    {{ $event->category->name ?? '-' }}
                </span>
                <h2 class="font-semibold mt-2">{{ $event->title }}</h2>
                <p class="text-sm text-slate-500 mt-1">
                    🗓 {{ $event->event_date->format('d M Y') }} &nbsp;·&nbsp; 📍 {{ $event->location }}
                </p>
            </div>
        </a>
    @empty
        <p class="text-slate-500">Belum ada acara.</p>
    @endforelse
</div>
@endsection
