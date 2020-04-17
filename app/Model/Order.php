<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('note', 'status', 'seller_id',
        'client_id', 'price', 'delivery', 'commission', 'total', 'address', 'payment_method_id');

    public function products()
    {
        return $this->belongsToMany('App\Model\Product')->withPivot('qty', 'note', 'price');
    }

    public function seller()
    {
        return $this->belongsTo('App\Model\Seller');
    }

    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Model\PaymentMethod');
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }

}
