<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'city_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'city_id');
    }

}
