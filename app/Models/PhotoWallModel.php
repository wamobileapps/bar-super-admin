<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoWallModel extends Model
{
    Protected $table = 't_bar_photo_wall';
		
	Protected $fillable = [
		"id", "bar_id", "user_id", "image", "description", "status", "created_at", "updated_at"
	];
}
