<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFriendModel extends Model
{
    Protected $table = 't_user_friends';
		
	Protected $fillable = [
		"user_id", "friend_user_id", "request_status", "created_at", "updated_at",
	];
}