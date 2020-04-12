<?php

namespace App\Http\Controllers\Api\General;

use App\Model\Category;
use App\Model\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function category()
    {
        $category = Category::all();
        if ($category == null) {
            return responseJson(1, 'success', $category);
        } else {
            return responseJson(0, 'success');
        }
    }

}
