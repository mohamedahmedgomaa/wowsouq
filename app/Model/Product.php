<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'description','price', 'offer', 'image', 'category_id', 'seller_id', 'number_product');
//    protected $appends = ['is_favourite'];
//
//    public function getIsFavouriteAttribute()
//    {
//        $favourite = $this->whereHas('clients',function ($query){
//            $query->where('likes.client_id',request()->user()->id);
//            $query->where('likes.product_id',$this->id);
//        })->first();
//        if ($favourite)
//        {
//            return true;
//        }
//        return false;
//    }

    public function files()
    {
        return $this->hasMany('App\Model\File');
    }
//
//    public function clients()
//    {
//        return $this->belongsToMany('App\Model\Client', 'likes');
//    }


    public function clients()
    {
        return $this->hasMany('App\Model\Client');
    }

    public function seller()
    {
        return $this->belongsTo('App\Model\Seller');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Model\Order');
    }

    public function likes()
    {
        return $this->hasMany('App\Model\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function ads()
    {
        return $this->hasMany('App\Model\Ad');
    }

    public function reviews()
    {
        return $this->hasMany('App\Model\Review');
    }

}
