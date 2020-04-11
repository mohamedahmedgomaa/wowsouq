<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    public function notifiiable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

}