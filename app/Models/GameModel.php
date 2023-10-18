<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{

	 Protected $table = 't_game';
	 Protected $fillable = [
		 "name", "image",
	];
		
    public function category(){

		return $this->hasMany(BarCategoryModel::class,'activity_id');
	}
}
?>
