<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarorderModel extends Model
{
    Protected $table = 't_order';
		
	Protected $fillable = [
		"bar_id", "user_id", "menu_id","payment_id", "drink_name","item_id", "category_name", "menu_type","payments_id","price","quantity","bar_name","order_status","order_pin","is_redeemed","details","redeemQuantity","tip","is_regifted","senders_id", "created_at", "updated_at","regift_send_date","regift_to","regift_recieved_date","redeem_date","purchase_date"
	];
}
