<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'collaborator_id',
        'trip_id',
        'description',
        'task1',
        'task2'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id', 'trip_id');
    }
    
    public function task()
    {
        return $this->belongsTo(UserTrip::class, 'id', 'collaborator_id');
    }
}


