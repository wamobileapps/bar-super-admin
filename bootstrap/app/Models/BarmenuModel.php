<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarmenuModel extends Model
{
    Protected $table = 't_bar_menu';
		
	Protected $fillable = [
		"bar_id", "category_id", "name", "description", "image", "price", "status", "created_at", "updated_at"
	];
}
