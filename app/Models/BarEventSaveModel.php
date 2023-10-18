<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarEventSaveModel extends Model
{
    Protected $table = 't_event_save';
		
	Protected $fillable = [
		"user_id", "event_id", "bar_id", "created_at", "updated_at"
	];
}
