<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public $fillable = [

    			'user_id',
    			'ip_address',
                'payment_id',
    			'phone_no',
    			'name',
    			'shipping_address',
    			'email',
    			'message',
                'transaction_id',
    			'is_paid',
    			'is_completed',
    			'is_seen_by_admin'

    ];

    public function user(){

    	// User and order model same directory te ache so kono folder er name dite hoin ni,na takle App\Models\.....dite hoto

    	return $this->belongsTo(User::class);
    }

     public function carts(){

     	/* Akta order er  onek gulo carts takte pare
        // akjon user onek gulo cart  takbe,protita product er jonno akta akta cart
        but onek gulo cart akta order id under e takbe */

    	return $this->hasMany(Cart::class);
    }

    public function payment(){

        return $this->belongsTo(Payment::class);
    }
}
