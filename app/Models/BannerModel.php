<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    Protected $table = 't_ad_banner';
		
	Protected $fillable = [
		"bar_id", "banner_image", "start_date", "expiry_date", "remark", "status", "created_at", "updated_at"
	];
}
