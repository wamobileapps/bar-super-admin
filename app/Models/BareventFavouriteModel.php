<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BareventFavouriteModel extends Model
{
    Protected $table = 't_user_event_favourite';
		
	Protected $fillable = [
		"user_id", "favourite_id", "created_at", "updated_at"
	];
}
