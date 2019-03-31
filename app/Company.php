<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    protected $table = 'companies';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name', 'image'
    ];

    public function products()
    {
        return $this->hasMany('App\Product', 'company_id');
    }

}
