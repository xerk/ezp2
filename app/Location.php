<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Location extends Model
{
    use SpatialTrait;
    protected $table = 'locations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $spatialFields = [
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
