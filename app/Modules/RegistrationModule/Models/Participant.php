<?php

namespace App\Modules\RegistrationModule\Models;

use App\Modules\RegistrationModule\Database\Factories\ParticipantFactory;
use App\Models\User;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected static function newFactory(): ParticipantFactory
    {
        return ParticipantFactory::new();
    }

    protected $fillable = ['user_id', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Many-to-Many: Participant <-> Ticket melalui tabel pivot registrations
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'registrations')
            ->withPivot('quantity', 'unique_code', 'status')
            ->withTimestamps();
    }
}
