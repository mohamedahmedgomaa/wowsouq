<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('comment', 'evaluate', 'product_id', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}