<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'name',
        'description',
        'date'
    ];

    protected $casts = [
        'date'  => 'date:Y-m-d',
    ];

    public function trip()
    {
        return $this->hasOne(Trip::class, 'trip_id');
    }
}
