<?php

namespace App\Http\Controllers\Api\Client;

use App\Mail\ResetPasswordClient;
use App\Model\Client;
use App\Model\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            $success['token'] = $client->createToken('Token Name')->accessToken;
            $success['name'] = $client->name;

            if (Hash::check($request->password, $client->password)) {
                return responseJson(200, trans('api.Signed in successfully'), [
                    'data' => $success,
                    'client' => $client
                ]);
            } else {
                return responseJson(400, trans('api.The login information is incorrect'));
            }
        } else {
            return responseJson(400, trans('api.The login information is incorrect'));
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'image' => v_image(),
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
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'clients',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }


        $input['password'] = bcrypt($input['password']);
        $client = Client::create($input);
        $success['token'] = $client->createToken('Token Name')->accessToken;
        $success['name'] = $client->name;

        return responseJson(200, 'success', [
            'data' => $success,
            'client' => $client
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            $code = rand(1111, 9999);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($client->email)
                    ->bcc('mido.15897@gmail.com')
                    ->send(new ResetPasswordClient($code));
                return responseJson(200, trans('api.Please check your email'), ['pin_code' => $code]);
            } else {
                return responseJson(400, trans('api.an error occurred . Try again'));
            }
        } else {
            return responseJson(400, trans('api.The data is incorrect'));
        }

    }

    public function newPassword(Request $request)
    {

        $validator = validator()->make($request->all(), [
            'pin_code' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)
            ->where('email', $request->email)->first();

        if ($client) {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;

            if ($client->save()) {
                return responseJson(200, trans('api.Password changed successfully'), $client);
            } else {
                return responseJson(400, trans('api.an error occurred . Try again'));
            }
        } else {
            return responseJson(400, trans('api.This code is incorrect'));
        }
    }

}
