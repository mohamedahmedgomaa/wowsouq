<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    //
    protected $table = 'ads';
    public $timestamps = true;
    protected $fillable = array('review', 'rate', 'client_id');

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
