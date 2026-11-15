<?php

namespace App\Modules\EventModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_category_id' => ['required', 'exists:event_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:draft,open,closed'],
        ];
    }

    public function messages(): array
    {
        return [
            'event_category_id.required' => 'Kategori event wajib dipilih.',
            'event_category_id.exists' => 'Kategori event tidak ditemukan.',
            'title.required' => 'Judul event wajib diisi.',
            'event_date.required' => 'Tanggal event wajib diisi.',
            'event_date.after' => 'Tanggal event harus setelah hari ini.',
            'location.required' => 'Kolom lokasi wajib diisi.',
            'status.in' => 'Status hanya boleh draft, open, atau closed.',
        ];
    }
}
