<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    Protected $table = 'files';
		
	Protected $fillable = [
		 "file_name", "file_size", "file_url", "file_type", "created","schedules_id","uploader_id"
	];
}
