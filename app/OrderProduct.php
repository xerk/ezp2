<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{

    protected $table = 'order_product';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id', 'product_id', 'quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

}
