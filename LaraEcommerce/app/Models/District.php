<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function division(){
    	
    	// every district has one division so it is one to one reletion.

    	return $this->belongsTo(Division::class);
    }
}
