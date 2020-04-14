<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    public $timestamps = true;
    protected $fillable = array('like', 'client_id', 'product_id');

    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
