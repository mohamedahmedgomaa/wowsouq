<?php

namespace App\Http\Controllers\WowSouq;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    //
    public function wow_souq()
    {
        return view('wow_souq/index');
    }
}
