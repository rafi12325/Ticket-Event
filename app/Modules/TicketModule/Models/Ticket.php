<?php

namespace App\Modules\TicketModule\Models;

use App\Modules\EventModule\Models\Event;
use App\Modules\RegistrationModule\Models\Registration;
use App\Modules\TicketModule\Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }

    protected $fillable = ['event_id', 'name', 'price', 'quota', 'sold'];

    protected $casts = [
        'price' => 'decimal:2',
        'quota' => 'integer',
        'sold' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Kuota tersisa dihitung, tidak disimpan — selalu konsisten
    public function remainingQuota(): int
    {
        return max(0, $this->quota - $this->sold);
    }
}
