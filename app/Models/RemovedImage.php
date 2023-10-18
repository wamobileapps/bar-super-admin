<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RemovedImage extends Model
{


    Protected $table = 'removed_user_images';
    Protected $fillable=[
      "user_id", "reason", "created_at", "updated_at",
      ];

   
}