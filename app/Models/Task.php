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
        'type',
        'description'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }
    
    public function collaborator()
    {
        return $this->hasOne(Collaborator::class, 'id', 'collaborator_id');
    }
}


