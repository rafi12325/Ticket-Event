<?php

namespace App\Modules\EventModule\Models;

use App\Modules\EventModule\Database\Factories\EventFactory;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected static function newFactory(): EventFactory
    {
        return EventFactory::new();
    }

    protected $fillable = [
        'event_category_id', 'title', 'slug', 'description',
        'event_date', 'location', 'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    // One-to-Many: 1 event punya banyak tiket
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
