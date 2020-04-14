<?php

namespace App\Http\Controllers\Api\General;

use App\Model\Category;
use App\Model\CategoryLang;
use App\Model\Client;
use App\Model\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            CategoryLang::with('category')->where('category_id', $category->id)->get();
        }
        return responseJson(200, trans('api.success'), [$categories->load('categoryLangs')]);
    }

    public function settings()
    {
        $settings = Setting::first();

        return responseJson(200, trans('api.success'), $settings);
    }
}
