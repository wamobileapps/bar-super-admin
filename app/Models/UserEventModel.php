<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEventModel extends Model
{
    Protected $table = 't_add_user_event';
		
	Protected $fillable = [
		"bar_id", "user_id", "event_id",  "created_at", "updated_at"
	];
}
