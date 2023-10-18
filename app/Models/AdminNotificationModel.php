<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotificationModel extends Model
{
    Protected $table = 't_admin_notification';
		
	Protected $fillable = [
		"id", "notification"
	];
}
