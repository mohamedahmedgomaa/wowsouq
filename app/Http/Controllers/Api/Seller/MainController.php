<?php

namespace App\Http\Controllers\Api\Seller;

use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //
    public function wallet()
    {
        $wallet = auth('seller')->user()->wallet;
        if ($wallet != null) {
            return responseJson(200, trans('api.getSuccessWallet'), $wallet);
        }
        return responseJson(200, trans('api.getSuccessWalletZero'), 0);
    }

    public function walletCreate(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'wallet' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(), $validator->errors());
        }

        $client = Seller::findOrFail(auth('seller')->user()->id);
        $wallet = auth('seller')->user()->wallet + $request->wallet;
        $client->wallet = $wallet;
        $client->save();

        return responseJson(200, trans('api.getSuccessWallet'), $client->wallet);
    }

}
