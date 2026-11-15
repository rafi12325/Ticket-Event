<?php

namespace App\Modules\RegistrationModule\Models;

use App\Modules\RegistrationModule\Database\Factories\RegistrationFactory;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected static function newFactory(): RegistrationFactory
    {
        return RegistrationFactory::new();
    }

    protected $fillable = ['participant_id', 'ticket_id', 'quantity', 'unique_code', 'status'];

    // Many-to-Many (pivot): Participant <-> Ticket dengan atribut tambahan
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
