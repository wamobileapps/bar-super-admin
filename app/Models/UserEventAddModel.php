<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEventAddModel extends Model
{
    Protected $table = 't_add_user_event';
		
	Protected $fillable = [
		"id", "user_id", "bar_id", "event_id", "created_at", "updated_at"
	];
}