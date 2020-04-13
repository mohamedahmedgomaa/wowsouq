<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'mido.15897@gmail.com', 'name' => 'Mohamed Gomaa'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => 'mido.15897@gmail.com',
    'password' => 'mido_15897@yahoo.com',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,

];
