<?php

namespace App\Http\Controllers\Api\Client;

use App\Model\Client;
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

        $client = Client::where('email',$request->email)->first();
        if ($client) {
            $success['token'] = $client->createToken('Token Name')->accessToken;
            $success['name'] = $client->name;

            if (Hash::check($request->password, $client->password)) {
                return responseJson(200,trans('api.Signed in successfully'), [
                    'data' => $success,
                    'client' => $client
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
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'image' => 'required',
            'age' => 'required',
            'gender' => 'required|in:male,female',
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
        $client = Client::create($input);
        $success['token'] = $client->createToken('Token Name')->accessToken;
        $success['name'] = $client->name;

        return responseJson(200,'success', [
            'data' => $success,
            'client' => $client
        ]);
    }
}
