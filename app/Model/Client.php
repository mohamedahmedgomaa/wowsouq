<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone', 'image', 'password', 'age', 'type', 'address', 'longitude', 'latitude', 'status', 'pin_code');

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notifiiable');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

}