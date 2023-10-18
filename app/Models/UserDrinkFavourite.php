<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDrinkFavourite extends Model
{
    Protected $table = 't_user_drink_favourite';
		
	Protected $fillable = [
		"user_id", "bar_id", "menu_id", "created_at", "updated_at",
	];
}