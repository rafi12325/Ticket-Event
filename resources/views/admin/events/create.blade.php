@extends('layouts.admin')

@section('title', 'Acara Baru')

@section('content')
<h1 class="text-2xl font-bold mb-4">+ Acara Baru</h1>

<div class="bg-white rounded-lg border border-slate-200 p-6 max-w-2xl">
    @include('partials.errors')

    <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Kategori <span class="text-red-500">*</span></label>
            <select name="event_category_id"
                    class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                <option value="">— Pilih kategori —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('event_category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('event_category_id')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Judul Acara <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal &amp; Jam <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="event_date" value="{{ old('event_date') }}"
                       class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                @error('event_date')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi <span class="text-red-500">*</span></label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                @error('location')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full border border-slate-300 rounded px-3 py-2 text-sm">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                @foreach(['draft' => 'Draft', 'open' => 'Open', 'closed' => 'Closed'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700">
                Simpan
            </button>
            <a href="{{ route('admin.events.index') }}"
               class="border border-slate-300 px-4 py-2 rounded text-sm hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
