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

    public function files()
    {
        return $this->hasMany('App\Model\File');
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

}
