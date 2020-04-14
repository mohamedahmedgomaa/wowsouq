<?php

namespace App\Http\Controllers\Api\Client;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function newOrder()
    {
        $new_order = Order::where('status', 'pending')->where('client_id', auth()->user()->id)->get();

        if ($new_order->count() != 0) {
            return responseJson(200, trans('api.SuccessMessage'), $new_order);
        } else {
            return responseJson(400, trans('api.NoData'));
        }
    }

    public function CurrentOrder()
    {
        $current_order = Order::where('status', 'accepted')->where('client_id', auth()->user()->id)->get();

        if ($current_order->count() != 0) {
            return responseJson(200, trans('api.SuccessMessage'), $current_order);
        } else {
            return responseJson(400, trans('api.NoData'));
        }
    }

    public function OldOrder()
    {
        $old_order = Order::whereIn('status', ['rejected', 'delivered', 'declined'])
            ->where('client_id', auth()->user()->id)->get();

        if ($old_order->count() != 0) {
            return responseJson(200, trans('api.SuccessMessage'), $old_order);
        } else {
            return responseJson(400, trans('api.NoData'));
        }
    }


}
