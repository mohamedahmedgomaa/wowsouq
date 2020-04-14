<?php

namespace App\Http\Controllers\Api\Client;

use App\Model\Client;
use App\Model\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //
    public function wallet()
    {
        $wallet = auth()->user()->wallet;
        if ($wallet != null) {
            return responseJson(200, trans('api.SuccessMessage'), $wallet);
        }
        return responseJson(200, trans('api.getSuccessWalletZero'), 0);
    }

    public function walletCreate(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'wallet' => 'required',
        ],[
          'wallet.required' => trans('validation.walletIsRequired'),
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(), $validator->errors());
        }

        $client = Client::findOrFail(auth()->user()->id);
        $wallet = auth()->user()->wallet + $request->wallet;
        $client->wallet = $wallet;
        $client->save();

        return responseJson(200, trans('api.SuccessMessage'), $client->wallet);
    }

    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'current-password' => 'required',
            'password' => 'required|min:6|confirmed',
        ],[
            'current-password.required' => trans('validation.currentPasswordIsRequired'),
            'password.required' => trans('validation.passwordIsRequired'),
            'password.confirmed' => trans('validation.passwordIsConfirmed'),
            'password.min' => trans('validation.passwordIsMin'),
        ]);

        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return responseJson(400, trans('api.Your current password does not matches with the password you provided. Please try again.'));
        }

        if(strcmp($request->get('current-password'), $request->get('password')) == 0){
            //Current password and new password are same
            return responseJson(400, trans('api.New Password cannot be same as your current password. Please choose a different password.'));
        }

        $client = auth()->user();
        $client->password = bcrypt($request->get('password'));
        $client->save();

        return responseJson(200, trans('api.Password changed successfully !'), $client);
    }

    public function profileUpdate(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required',
            'image' => 'required|'.v_image(),
            'age' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'status' => 'required|in:0,1',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'email.required' => trans('validation.emailIsRequired'),
            'email.unique' => trans('validation.emailIsUnique'),
            'email.email' => trans('validation.emailIsEmail'),
            'phone.required' => trans('validation.phoneIsRequired'),
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'age.required' => trans('validation.ageIsRequired'),
            'gender.required' => trans('validation.genderIsRequired'),
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

        $client->update($request->except('image'));

        if ($request->hasFile('image')) {
            $client['image'] = up()->upload([
                'file' => 'image',
                'path' => 'clients',
                'upload_type' => 'single',
                'delete_file' => $client['image'],
            ]);
            $client->image = $client['image'];
            $client->save();
        }

        return responseJson(200, trans('api.editMessageSuccess'), $client);
    }

    public function like(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'like' => 'required|in:0,1',
            'product_id' => 'required|numeric|exists:products,id',
        ],[
            'like.required' => trans('validation.likeIsRequired'),
            'product_id.required' => trans('validation.productIsRequired'),
            'product_id.numeric' => trans('validation.productIsNumeric'),
            'product_id.exists' => trans('validation.productIsExists'),
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $like = Like::create([
            'like' => $request->like,
            'product_id' => $request->product_id,
            'client_id' => auth()->user()->id,
        ]);

        return responseJson(200, trans('api.createMessageSuccess'), $like);
    }
}
