<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_type', 
        'payment_id',
        'transaction_id', 
        'stripe_order_id',
        'paying_amount',
        'subtotal',
        'coupon_discount', 
        'invoice_no',
        'return_order_status',
        'return_reason',
        'return_request_date',
        'return_accept_date',
        'return_request_month', 
        'return_accept_month',
        'return_request_year', 
        'return_accept_year',
        'confirmed_by',
        'processing_by',
        'picked_by',
        'shipped_by',
        'delivered_by',
        'confirmed_date',
        'processing_date',
        'picked_date',
        'shipped_date',
        'delivered_date',
        'cancel_reason',
        'cancel_date',
        'status',
        'order_date',
        'order_month',
        'order_year',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    

   
}
