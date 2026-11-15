<?php

namespace App\Modules\EventModule\Models;

use App\Modules\EventModule\Database\Factories\EventCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    protected static function newFactory(): EventCategoryFactory
    {
        return EventCategoryFactory::new();
    }

    protected $fillable = ['name', 'slug'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
