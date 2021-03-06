<?php

namespace App\Model;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone', 'image', 'password', 'age', 'gender', 'address', 'longitude', 'latitude', 'status', 'pin_code');

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Model\Review');
    }

    public function likes()
    {
        return $this->hasMany('App\Model\Like');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

//    public function products()
//    {
//        return $this->belongsToMany('App\Model\Product', 'likes');
//    }
    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }


    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notifiiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Model\Token', 'tokenable');
    }

    protected $hidden = [
        'password'
    ];
}
