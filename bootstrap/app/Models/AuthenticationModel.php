<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationModel extends Model
{
		Protected $table = 't_user';
		
		Protected $fillable = [
		"user_id", "name", "email", "password", "gender", "relationship_status","age", "dob", "profile_pic", "payment_gateway_id", "device_type", "device_token", "status"
		];

}
