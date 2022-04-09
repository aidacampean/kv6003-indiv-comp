<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'user_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasOne(Task::class, 'collaborator_id', 'id');
    }
}
