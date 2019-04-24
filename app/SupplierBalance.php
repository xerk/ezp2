<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBalance extends Model 
{

    protected $table = 'supplier_balances';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'balance', 'debit', 'credit'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}