<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarModel extends Model
{
    Protected $table = 't_bar';
		
	Protected $fillable = [
		"name", "address", "cover_image", "latitude", "longitude", "status", "updated_at", "created_at"
	];
}
