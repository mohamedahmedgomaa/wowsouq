<?php

namespace App\Http\Controllers\Api\Seller;

use App\Mail\ResetPasswordClient;
use App\Mail\ResetPasswordSeller;
use App\Model\Client;
use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => trans('validation.emailIsRequired'),
            'email.email' => trans('validation.emailIsEmail'),
            'password.required' => trans('validation.passwordIsRequired'),
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
            'image' => 'required|'.v_image(),
            'delivery' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'status' => 'required|in:0,1',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'email.required' => trans('validation.emailIsRequired'),
            'email.email' => trans('validation.emailIsEmail'),
            'email.unique' => trans('validation.emailIsUnique'),
            'password.required' => trans('validation.passwordIsRequired'),
            'password.confirmed' => trans('api.passwordIsConfirmation'),
            'phone.required' => trans('validation.phoneIsRequired'),
            'delivery.required' => trans('validation.deliveryIsRequired'),
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'address.required' => trans('validation.addressIsRequired'),
            'longitude.required' => trans('validation.longitudeIsRequired'),
            'latitude.required' => trans('validation.latitudeIsRequired'),
            'status.required' => trans('validation.statusIsRequired'),
            'status.in' => trans('validation.statusIsIn'),
        ]);

        if ($validator->fails()) {
            return responseJson(400,$validator->errors()->first(), $validator->errors());
        }

        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'sellers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $input['password'] = bcrypt($input['password']);
        $seller = Seller::create($input);
        $success['token'] = $seller->createToken('Token Name')->accessToken;
        $success['name'] = $seller->name;

        return responseJson(200,trans('api.createMessageSuccess'), [
            'data' => $success,
            'seller' => $seller
        ]);
    }


    public function resetPassword(Request $request) {
        $validator = validator()->make($request->all(), [
            'email' => 'required|email',
        ],[
            'email.required' => trans('validation.emailIsRequired'),
            'email.email' => trans('validation.emailIsEmail'),
        ]);
        if ($validator->fails()) {
            return responseJson(400,$validator->errors()->first(), $validator->errors());
        }
        $user = Seller::where('email',$request->email)->first();
        if ($user) {
            $code = rand(1111, 9999);
            $update = $user->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($request->email)
                    ->bcc('mido.15897@gmail.com')
                    ->send(new ResetPasswordSeller($code));
                return responseJson(200,trans('api.Please check your email'), ['pin_code' => $code]);
            } else {
                return responseJson(400, trans('api.an error occurred . Try again'));
            }
        } else {
            return responseJson(400,trans('api.The data is incorrect'));
        }

    }

    public function newPassword(Request $request) {

        $validator = validator()->make($request->all(), [
            'pin_code' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ],[
            'pin_code.required' => trans('validation.pinCodeIsRequired'),
            'email.required' => trans('validation.emailIsRequired'),
            'password.required' => trans('validation.passwordIsRequired'),
            'password.confirmed' => trans('api.passwordIsConfirmation'),
        ]);

        if ($validator->fails()) {
            return responseJson(400,$validator->errors()->first(), $validator->errors());
        }

        $user = Seller::where('pin_code',$request->pin_code)->where('pin_code', '!=' , 0)
            ->where('email',$request->email)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;

            if ($user->save())
            {
                return responseJson(200, trans('api.Password changed successfully'), $user);
            } else {
                return responseJson(400, trans('api.an error occurred . Try again'));
            }
        } else {
            return responseJson(400, trans('api.This code is incorrect'));
        }
    }


}
