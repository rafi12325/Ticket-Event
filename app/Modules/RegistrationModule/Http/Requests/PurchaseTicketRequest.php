<?php

namespace App\Modules\RegistrationModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // route sudah diproteksi middleware role:participant
    }

    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'integer', 'exists:tickets,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_id.required' => 'Tiket wajib dipilih.',
            'ticket_id.exists' => 'Tiket tidak ditemukan.',
            'quantity.required' => 'Jumlah tiket wajib diisi.',
            'quantity.min' => 'Minimal beli 1 tiket.',
            'quantity.max' => 'Maksimal beli 10 tiket per transaksi.',
        ];
    }
}
