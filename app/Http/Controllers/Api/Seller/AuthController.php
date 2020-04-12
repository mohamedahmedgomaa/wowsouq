<?php

namespace App\Http\Controllers\Api\Seller;

use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400,$validator->errors()->first(), $validator->errors());
        }

        $seller = Seller::where('email',$request->email)->first();
        if ($seller) {
            $success['token'] = $seller->createToken('Token Name')->accessToken;
            $success['name'] = $seller->name;

            if (Hash::check($request->password, $seller->password)) {
                return responseJson(200,trans('api.Signed in successfully'), [
                    'data' => $success,
                    'seller' => $seller
                ]);
            } else {
                return responseJson(400, trans('api.The login information is incorrect'));
            }
        } else {
            return responseJson(400,trans('api.The login information is incorrect'));
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:sellers',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'image' => 'required',
            'delivery' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'status' => 'required|in:0,1',
        ], [
            'name.required' => trans('api.nameIsRequired'),
            'email.required' => trans('api.emailIsRequired'),
            'email.unique' => trans('api.emailIsUnique'),
            'password.required' => trans('api.passwordIsRequired'),
            'password.confirmed' => trans('api.passwordIsConfirmation'),
        ]);

        if ($validator->fails()) {
            return responseJson(400,$validator->errors()->first(), $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $seller = Seller::create($input);
        $success['token'] = $seller->createToken('Token Name')->accessToken;
        $success['name'] = $seller->name;

        return responseJson(200,'success', [
            'data' => $success,
            'seller' => $seller
        ]);
    }
}
