<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
    protected $table = 'ads';
    public $timestamps = true;
    protected $fillable = array('image', 'time_start', 'time_finish', 'product_id');

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
