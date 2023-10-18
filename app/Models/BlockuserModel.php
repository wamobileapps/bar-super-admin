<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BlockuserModel extends Model
{
    Protected $table = 't_user_block';
		
	Protected $fillable = [
		 "user_id", "block_user_id", "block_reason", "updated_at", "created_at"
	];
}
