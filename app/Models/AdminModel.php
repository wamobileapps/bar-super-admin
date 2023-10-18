<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    Protected $table = 't_admin';
		
	Protected $fillable = [
		"id", "name", "email", "password"
	];
}
