<?php

namespace App\Http\Controllers\Api\General;

use App\Model\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

//    public function login()
//    {
//        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
//            $user = Auth::user();
//
//
//            $success['token'] = $user->createToken('myApp')->accessToken;
//            dd($success['token']);
//
//        }
//    }
//
//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'email' => 'required|email',
//            'password' => 'required',
//            'c_password' => 'required|same:password',
//        ]);
//
//        if ($validator->fails()) {
//            return responseJson(0,$validator->errors()->first(), $validator->errors());
//        }
//
//        $input = $request->all();
//        $input['password'] = bcrypt($input['password']);
//        $user = User::create($input);
//        $success['token'] = $user->createToken('Token Name')->accessToken;
//        $success['name'] = $user->name;
//
//        return responseJson(1,'success', $success);
//    }
}
