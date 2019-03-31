<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

}
