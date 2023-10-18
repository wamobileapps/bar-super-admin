<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenucategoryModel extends Model
{
	Protected $table = 't_bar_menu_category';
		
	Protected $fillable = [
		"bar_id", "menu_type", "name", "image", "status", "created_at", "updated_at"
	];
    
}
