<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'user_id',
        'status',
    ];

    // public function trip()
    // {
    //     return $this->hasMany(Trip::class);
    // }

    // public function user()
    // {
    //     return $this->hasOne(User::class);
    // }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id', 'trip_id')->where('tasks.collaborator_id', '=', 'collaborators.user_id');
        #return $this->hasMany(Task::class)->where('collaborator_id', '=', 'user_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function trip()
    {
        return $this->hasOne(Trip::class, 'id', 'trip_id');
    }

}