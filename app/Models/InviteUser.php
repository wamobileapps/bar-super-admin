<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteUser extends Model
{
    Protected $table = 't_user_invite';
		
	Protected $fillable = [
		"sender_id", "receiver_id", "bar_id", "invitation_type", "game_id", "event_id", "chat_message", "created_at", "updated_at",
	];
}