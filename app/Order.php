<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'billing_email', 'billing_name', 'billing_address', 'city_id', 'billing_phone', 'billing_discount',
        'billing_discount_code', 'billing_subtotal', 'billing_tax', 'billing_total', 'payment_gateway', 'error', 'status', 'comment'
    ];




    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'pin_code');
    }

}
