<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarPhotowall extends Model
{
    Protected $table = 't_bar_photowall';
		
	Protected $fillable = [
		"user_id", "bar_id", "photo", "title", "description"
	];
}
