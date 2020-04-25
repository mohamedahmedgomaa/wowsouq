<?php

namespace App\Http\Controllers\Api\Seller;

use App\Model\Product;
use App\Model\Seller;
use App\Model\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //
    public function wallet(Request $request)
    {
        $wallet = $request->user()->wallet;
        if ($wallet != null) {
            return responseJson(200, trans('api.SuccessMessage'), $wallet);
        }
        return responseJson(400, trans('api.getSuccessWalletZero'), 0);
    }

    public function walletCreate(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'wallet' => 'required',
        ], [
            'wallet.required' => trans('validation.walletIsRequired'),
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $client = Seller::findOrFail($request->user()->id);
        $wallet = $request->user()->wallet + $request->wallet;
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

        if (!(Hash::check($request->get('current-password'), $request->user()->password))) {
            // The passwords matches
            return responseJson(400, trans('api.Your current password does not matches with the password you provided. Please try again.'));
        }

        if (strcmp($request->get('current-password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return responseJson(400, trans('api.New Password cannot be same as your current password. Please choose a different password.'));
        }

        $client = $request->user();
        $client->password = bcrypt($request->get('password'));
        $client->save();

        return responseJson(200, trans('api.Password changed successfully !'), $client);
    }

    public function profileUpdate(Request $request)
    {
        $seller = Seller::findOrFail($request->user()->id);
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:sellers,email,' . $request->user()->id,
            'phone' => 'required',
            'image' => v_image(),
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

        $sellers = Seller::findOrFail($request->user()->id);

        return responseJson(200, trans('api.editMessageSuccess'), $sellers);
    }

    public function products(Request $request)
    {
        $product = $request->user()->products()->with('category')->get();
        return responseJson(200, trans('api.getSuccessData'), $product);
    }


    public function showProduct(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'product_id' => 'required|exists:products,id', //
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $product = $request->user()->products()->find($request->product_id);
        if ($product) {
            return responseJson(200, trans('api.getSuccessData'), $product->load('category'));
        }
        return responseJson(400, trans('api.The operation failed'));
    }


    public function createProduct(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|' . v_image(),
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required',
            'number_product' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        if ($request['offer'] <= $request['price'] && $request['offer'] != null) {
            return responseJson(400, trans('api.The offer price is smaller than or equal to the product price'));
        }

        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'products',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $product = Product::create($input);

        $product->seller_id = $request->user()->id;
        $product->save();

        return responseJson(1, trans('api.createMessageSuccess'), $product);
    }

    public function updateProduct(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'product_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => v_image(),
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required',
            'number_product' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $product = $request->user()->products()->find($request->product_id);
        if ($product) {
            $product->update($request->except('image'));
            if (request()->hasFile('image')) {
                $product['image'] = up()->upload([
                    'file' => 'image',
                    'path' => 'products',
                    'upload_type' => 'single',
                    'delete_file' => $product->image,
                ]);
                $product->image = $product['image'];
                $product->save();
            }
            return responseJson(200, trans('api.editMessageSuccess'), ['product' => $product]);
        }
        return responseJson(400, trans('api.The operation failed'));
    }

    public function removeProduct(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'product_id' => 'required|exists:products,id', //
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $product = $request->user()->products()->find($request->product_id);

        if ($product) {
            $product->delete();
        }
        return responseJson(200, trans('api.deleteMessageSuccess'));
    }


    public function createToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
            'type' => 'required|in:android,ios',
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
        $token = $request->user()->tokens()->create($request->all());
        return responseJson(200, trans('api.createMessageSuccess'), $token);
    }

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();

        return responseJson(200, trans('api.removeMessageSuccess'));
    }
}
