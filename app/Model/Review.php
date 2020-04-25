<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('review', 'rate', 'client_id', 'product_id');

    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
