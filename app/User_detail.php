<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    //
	public $timestamps = false;
	public function user() 
	{
		return $this->hasOne('App\User', 'id', 'user_id');
	}

}
