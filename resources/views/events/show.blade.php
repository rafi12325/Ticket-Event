@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
    <div class="h-40 bg-gradient-to-r from-indigo-200 via-indigo-100 to-slate-200"></div>

    <div class="p-6 grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">
                {{ $event->category->name ?? '-' }}
            </span>
            <h1 class="text-2xl font-bold mt-2">{{ $event->title }}</h1>
            <p class="text-slate-500 mt-1">
                📍 {{ $event->location }} &nbsp;·&nbsp; 🗓 {{ $event->event_date->format('d M Y, H:i') }}
            </p>
            <p class="mt-4 text-slate-700 leading-relaxed">{{ $event->description }}</p>
        </div>

        <div class="bg-slate-50 rounded-lg border border-slate-200 p-4 h-fit">
            <h3 class="font-semibold mb-2">Pilih Tiket</h3>

            @forelse($tickets as $ticket)
                <div class="flex justify-between items-center border-b border-slate-200 py-2">
                    <span class="font-medium">{{ $ticket->name }}</span>
                    <span>Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-slate-500 mb-2 mt-0.5">
                    Sisa: {{ $ticket->remainingQuota() }} / {{ $ticket->quota }}
                </p>
            @empty
                <p class="text-sm text-slate-500">Belum ada tiket untuk event ini.</p>
            @endforelse

            @auth
                @if(auth()->user()->isParticipant())
                    @if($tickets->where(fn ($t) => $t->remainingQuota() > 0)->isNotEmpty())
                        <form method="POST" action="{{ route('purchase.store', $event->slug) }}" class="mt-3 space-y-2">
                            @csrf
                            @include('partials.errors')
                            <div>
                                <label class="block text-sm font-medium mb-1">Tiket</label>
                                <select name="ticket_id" class="w-full border border-slate-300 rounded px-2 py-1.5 text-sm">
                                    @foreach($tickets as $ticket)
                                        @if($ticket->remainingQuota() > 0)
                                            <option value="{{ $ticket->id }}">
                                                {{ $ticket->name }} — Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Jumlah</label>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="10"
                                       class="w-full border border-slate-300 rounded px-2 py-1.5 text-sm">
                                @error('quantity')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-medium text-sm">
                                Beli Tiket
                            </button>
                        </form>
                    @else
                        <div class="bg-red-50 border border-red-300 text-red-700 text-sm px-3 py-2 rounded mt-3">
                            Semua jenis tiket untuk event ini sudah habis.
                        </div>
                    @endif
                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('admin.events.tickets.index', $event->slug) }}"
                       class="block text-center text-sm text-indigo-600 hover:underline mt-3">
                        Kelola tiket acara ini →
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="block w-full bg-slate-200 text-slate-700 py-2 rounded text-center font-medium text-sm mt-3 hover:bg-slate-300">
                    Masuk untuk membeli tiket
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection
