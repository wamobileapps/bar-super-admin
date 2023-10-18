<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BargameModel extends Model
{

	 Protected $table = 't_bar_game';
		
	Protected $fillable = [
		"bar_id", "name", "description", "image","no_of_players","category_id","status", "created_at", "updated_at"
	];
    
}
