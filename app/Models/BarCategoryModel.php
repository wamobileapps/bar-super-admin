<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarCategoryModel extends Model
{

	 Protected $table = 't_bar_category';
		
	Protected $fillable = [
		"bar_id", "activity_id","game_id",'description',"created_at", "updated_at"
	];

    public function bar(){
        return $this->hasMany(BarModel::class,'bar_id','bar_id');
    }
}
