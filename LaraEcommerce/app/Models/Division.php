<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	// protita division er one or more district takte pare, so one to many reletion.
    public function districts(){
    	
    	return $this->hasMany(District::class);
    }
}
