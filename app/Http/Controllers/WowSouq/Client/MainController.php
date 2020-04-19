<?php

namespace App\Http\Controllers\WowSouq\Client;

use App\Model\Cart;
use App\Model\Category;
use App\Model\Client;
use App\Model\Like;
use App\Model\Product;
use App\Model\Seller;
use App\Model\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //
    public function getAddToCart(Request $request,$id)
    {
        $product = Product::find($id);
        $seller = $product->seller();
        if(session()->exists('seller_id'))
        {
            if($seller->first()->id != session('seller_id'))
            {
                flash()->error('error');
                return back();
            }
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        Cart::addRestaurantId($oldCart , $seller->first()->id);

        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
//        dd($request->session()->get('cart'));
        return redirect()->back();
    }

    public function shoppingCart()
    {
        if (!Session::has('cart')) {
            $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
            $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

            return view('wow_souq.client.order.cart', compact('categories', 'top_products'));
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
        return view('wow_souq.client.order.cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'top_products' => $top_products,
            'categories' => $categories
        ]);

    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('client.shoppingCart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('client.shoppingCart');
    }


    public function addOrder(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'payment_method_id' => 'required',
        ]);
        $client =  auth()->guard('client')->user();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $products = new Cart($oldCart);

        $seller = Seller::find(session('seller_id'));

        if($seller)
        {
            $order = $client->orders()->create($request->all());
            $order->update(
                [
                    'seller_id' => $seller->id ,
                    'price' => $products->totalPrice,
                    'delivery' => $seller->delivery,
                    'total' => $products->totalPrice + $seller->delivery
                ]
            );
            foreach ($products->items as $product)
            {
                $order->products()->attach($product['product_id'],
                    [
                        'qty' =>$product['qty'] ,
                        'price' =>$product['price']
                    ]);
            }
            session()->forget('cart');
            session()->forget('seller_id');

            flash()->success('تم اضافة االطلب بنجاح');
            return redirect('/sofra');
//            return view('front.clients.editShoppingCart', compact('order'));
        }
    }

}
