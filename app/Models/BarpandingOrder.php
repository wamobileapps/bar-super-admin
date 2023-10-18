<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarpandingOrder extends Model
{
    Protected $table = 't_panding_order';
		
	Protected $fillable = [
		"order_id", "bar_id", "quantity","status", "code", "user_id", "menu_id", "drink_name", "category_name", "created_at", "updated_at","item_id",
	];
}
