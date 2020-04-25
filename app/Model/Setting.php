<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'text', 'image',
        'image_login_client', 'image_register_client', 'image_wow_souq',
        'image_login_seller', 'image_register_seller', 'image_login_admin', 'delivery',
        'image_product','image_profile_client','image_profile_seller',
        'whats_app', 'instagram', 'you_tube', 'facebook', 'delivery');

}
