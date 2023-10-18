<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BargameFavouriteModel extends Model
{
    Protected $table = 't_user_game_favourite';
		
	Protected $fillable = [
		"user_id", "favourite_id", "created_at", "updated_at"
	];
}
