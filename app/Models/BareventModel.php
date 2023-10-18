<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BareventModel extends Model
{
    Protected $table = 't_bar_event';
		
	Protected $fillable = [
		"bar_id", "name", "description", "image", "event_type", "start_date", "start_time", "end_date", "end_time", "status", "created_at", "updated_at"
	];
}
