<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDoors extends Model
{
    protected $fillable = [
        'door_id', 'user_id'
    ];
    protected $with = ['door'];

    public function door()
    {
        return $this->hasOne(Doors::class, 'id', 'door_id');
    }
}
