<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Models\User as VoyagerUser;

class User extends VoyagerUser
{

    use Notifiable, SoftDeletes;

    protected $table = 'users';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city_id', 'user_type', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Determines if the User is a Super admin
     * @return null
    */
    public function isSuperAdmin()
    {
        return $this->hasRole('admin');
    }

    public function location()
    {
        return $this->hasOne('App\Location', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function supplierBalance()
    {
        return $this->hasOne('App\SupplierBalance', 'user_id');
    }

}
