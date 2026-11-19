<?php

namespace App\Modules\TicketModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'quota' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tiket wajib diisi.',
            'price.required' => 'Harga tiket wajib diisi.',
            'price.numeric' => 'Harga tiket harus berupa angka.',
            'price.min' => 'Harga tiket tidak boleh negatif.',
            'price.max' => 'Harga tiket terlalu besar (maksimal Rp 9.999.999.999.999,99).',
            'quota.required' => 'Kuota tiket wajib diisi.',
            'quota.min' => 'Kuota tiket minimal 1.',
        ];
    }
}
