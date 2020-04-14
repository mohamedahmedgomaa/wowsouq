<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryLang extends Model
{
    protected $table = 'category_langs';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'code_lang', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

}
