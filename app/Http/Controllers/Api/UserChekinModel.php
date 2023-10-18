<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChekinModel extends Model
{
    Protected $table = 't_checked_in_user';
		
	Protected $fillable = [
		"user_id", "bar_id", "created_at"
	];
}
