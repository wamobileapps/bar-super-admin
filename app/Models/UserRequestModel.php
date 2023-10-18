<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequestModel extends Model
{
    Protected $table = 't_user_request';
		
	Protected $fillable = [
		"user_id", "request_type", "bar_id","order_id" ,"request_user_id","request_status", "created_at", "updated_at",
	];
}