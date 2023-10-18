<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationModel extends Model
{
	use SoftDeletes;

    Protected $table = 't_bar_notification';
		
	Protected $fillable = [
		"title","bar_id","request_drink_id","event_id", "game_id","notification_type", "user_id", "frined_request_id","description", "gift_sender_id", "accepte_by", "updated_at", "created_at"
	];
}
