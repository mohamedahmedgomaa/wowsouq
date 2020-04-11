<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = array('product_id', 'path', 'file', 'size', 'file_name');

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}