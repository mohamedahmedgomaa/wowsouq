<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'text', 'image',
        'image_login_client', 'image_register_client', 'image_wow_souq',
        'whats_app', 'instagram', 'you_tube', 'facebook');

}
