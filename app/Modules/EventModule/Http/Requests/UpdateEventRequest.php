<?php

namespace App\Modules\EventModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_category_id' => ['sometimes', 'required', 'exists:event_categories,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['sometimes', 'required', 'date'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'in:draft,open,closed'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul event wajib diisi.',
            'location.required' => 'Kolom lokasi wajib diisi.',
        ];
    }
}
