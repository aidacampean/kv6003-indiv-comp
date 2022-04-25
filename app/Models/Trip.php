<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory;
    use SoftDeletes;

    //https://laravel.com/docs/5.6/eloquent-mutators#date-mutators
    protected $dates = [
        'date_from',
        'date_to'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'user_id',
        'name',
        'date_from',
        'date_to'
    ];

    protected $casts = [
        'date_from'  => 'date:Y-m-d',
        'date_to' => 'date:Y-m-d',
    ];

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('date', 'desc');
    }

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class, 'trip_id', 'id');
    }

    public function userInvites()
    {
        return $this->hasMany(UserInvitation::class, 'trip_id', 'id');
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class, 'trip_id', 'id');
    }
}
