<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    Protected $table = 't_payment';
		
	Protected $fillable = [
		"transaction_id","bar_id","payments_id", "user_id", "amount", "created_at", "updated_at"
	];
}
