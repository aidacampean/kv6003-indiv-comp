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
}
