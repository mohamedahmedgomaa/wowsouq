<?php

namespace App\Model;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Seller extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'sellers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'image', 'password', 'phone', 'address', 'longitude', 'latitude', 'status', 'pin_code');

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Model\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notifiiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Model\Token', 'tokenable');
    }

}
