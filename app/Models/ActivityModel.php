<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    Protected $table = 't_activities';
		
	Protected $fillable = [
		"name",'image',
	];
}
