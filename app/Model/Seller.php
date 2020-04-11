<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model 
{

    protected $table = 'sellers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'image', 'password', 'phone', 'delivery', 'address', 'longitude', 'latitude', 'status', 'pin_code');

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notifiiable');
    }

}