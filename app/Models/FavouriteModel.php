<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteModel extends Model
{
    Protected $table = 't_user_favourite';
		
	Protected $fillable = [
		"user_id",  "favourite_bar_id", "created_at", "updated_at"
	];
}
