<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LangProcuct extends Model 
{

    protected $table = 'lang_products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'code_lang', 'product_id');

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}