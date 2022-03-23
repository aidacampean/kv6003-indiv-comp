<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $dates = [
        'date_from',
        'date_to'
    ];

    protected $fillable = [
        'trip_id',
        'name',
        'date_from',
        'date_to',
        'budget'
    ];
    
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
