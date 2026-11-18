@if ($errors->any())
    <div class="bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded mb-4">
        <p class="font-semibold mb-1">Periksa kembali isian berikut:</p>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
