<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
class AuthenticationModel extends Model implements AuthenticatableContract {
    use Authenticatable;
		Protected $table = 't_user';
		Protected $id = 'id';
		Protected $fillable = [
		"user_id", "username", "full_name", "email", "dob", "ageRange", "password", "gender", "relationship_status", "age", "profileImage", "paymentMode", "favourite_drink", "payment_gateway_id", "device_type", "device_token", "interests", "about", "status", "forgetpassword_link", "is_password_link_valid", "rating", "mood_at_bar", "drunk_level","orientation", "profile_completed", "created_at", "updated_at",'provider_name','provider_id','fcm_token'
		];
		protected $with = ['doors'];
		public function doors()
		{
			return $this->hasMany('App\UserDoors', 'user_id', 'id');
			
		}
}
