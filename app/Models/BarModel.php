<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarModel extends Model
{
    Protected $table = 't_bar';
		
	Protected $fillable = [
		"name", "email", "address", "cover_image", "latitude", "longitude", "status", "updated_at", "created_at", "open_time", "close_time", "password", "people_in","account","bank_account_name","routing_number","account_number","bank_account"
	];

  
}
