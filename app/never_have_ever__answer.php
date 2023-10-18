<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class never_have_ever__answer extends Model
{
    protected $fillable = [
        'never_have_ever_id', 'user_id', 'answer'
    ];
}
