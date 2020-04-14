<?php

namespace App\Http\Controllers\Api\Seller;

use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //
    public function wallet()
    {
        $wallet = auth('seller')->user()->wallet;
        if ($wallet != null) {
            return responseJson(200, trans('api.SuccessMessage'), $wallet);
        }
        return responseJson(400, trans('api.getSuccessWalletZero'), 0);
    }

    public function walletCreate(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'wallet' => 'required',
        ],[
            'wallet.required' => trans('validation.walletIsRequired'),
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $client = Seller::findOrFail(auth('seller')->user()->id);
        $wallet = auth('seller')->user()->wallet + $request->wallet;
        $client->wallet = $wallet;
        $client->save();

        return responseJson(200, trans('api.getSuccessWallet'), $client->wallet);
    }

    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'current-password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current-password.required' => trans('validation.currentPasswordIsRequired'),
            'password.required' => trans('validation.passwordIsRequired'),
            'password.confirmed' => trans('validation.passwordIsConfirmed'),
            'password.min' => trans('validation.passwordIsMin'),
        ]);

        if (!(Hash::check($request->get('current-password'), auth('seller')->user()->password))) {
            // The passwords matches
            return responseJson(400, trans('api.Your current password does not matches with the password you provided. Please try again.'));
        }

        if (strcmp($request->get('current-password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return responseJson(400, trans('api.New Password cannot be same as your current password. Please choose a different password.'));
        }

        $client = auth('seller')->user();
        $client->password = bcrypt($request->get('password'));
        $client->save();

        return responseJson(200, trans('api.Password changed successfully !'), $client);
    }

    public function profileUpdate(Request $request)
    {
        $seller = Seller::findOrFail(auth('seller')->user()->id);
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth('seller')->user()->id,
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
            'gender.in' => trans('validation.genderIsIn'),
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $seller->update($request->except('image'));

        if ($request->hasFile('image')) {
            $seller['image'] = up()->upload([
                'file' => 'image',
                'path' => 'sellers',
                'upload_type' => 'single',
                'delete_file' => $seller['image'],
            ]);
            $seller->image = $seller['image'];
            $seller->save();
        }

        $sellers = Seller::findOrFail(auth('seller')->user()->id);

        return responseJson(200, trans('api.editMessageSuccess'), $sellers);
    }

}
