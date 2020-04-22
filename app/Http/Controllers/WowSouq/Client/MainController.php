<?php

namespace App\Http\Controllers\WowSouq\Client;

use App\Model\Cart;
use App\Model\Category;
use App\Model\Client;
use App\Model\Like;
use App\Model\PaymentMethod;
use App\Model\Product;
use App\Model\Seller;
use App\Model\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //


    public function getProfile()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.client.profile', compact('top_products', 'categories'));
    }

    public function profile(Request $request)
    {
        $records = Client::findOrFail(auth('clients')->user()->id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . auth('clients')->user()->id,
            'password' => 'sometimes|nullable|confirmed',
            'phone' => 'required',
            'image' => v_image(),
            'age' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'email.required' => trans('validation.emailIsRequired'),
            'email.email' => trans('validation.emailIsEmail'),
            'email.unique' => trans('validation.emailIsUnique'),
            'password.required' => trans('validation.passwordIsRequired'),
            'password.confirmed' => trans('validation.passwordIsConfirmation'),
            'password.min' => trans('validation.passwordIsMin'),
            'phone.required' => trans('validation.phoneIsRequired'),
            'age.required' => trans('validation.ageIsRequired'),
            'gender.required' => trans('validation.genderIsRequired'),
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


        $records->update($request->except('password', 'image'));
        if (request()->input('password')) {
            $records->update(['password' => bcrypt($request->password)]);
        }

        if (request()->hasFile('image')) {
            $records['image'] = up()->upload([
                'file' => 'image',
                'path' => 'clients',
                'upload_type' => 'single',
                'delete_file' => $records->image,
            ]);
            $records->image = $records['image'];
            $records->save();
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect()->back();
    }

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
            $payment_method = PaymentMethod::all();
            return view('wow_souq.client.order.cart', compact('categories', 'top_products', 'payment_method'));
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
        $payment_method = PaymentMethod::all();
        return view('wow_souq.client.order.cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'top_products' => $top_products,
            'categories' => $categories,
            'payment_method' => $payment_method
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
            'note' => 'required',
            'address' => 'required',
            'payment_method_id' => 'required',
        ]);
        $client =  auth()->guard('clients')->user();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $products = new Cart($oldCart);


            $order = $client->orders()->create($request->all());
            $order->update(
                [
                    'order_number' => rand(11111111, 99999999),
                    'price' => $products->totalPrice,
                    'delivery' => settings()->delivery,
                    'total' => $products->totalPrice + settings()->delivery
                ]
            );
            foreach ($products->items as $product)
            {
                $order->products()->attach($product['product_id'],
                    [
                        'note' =>$request->note,
                        'qty' =>$product['qty'] ,
                        'price' =>$product['price']
                    ]);
            }
            session()->forget('cart');

            flash()->success(trans('web.orderSuccessRequest'));
            return redirect('/');

    }

    public function getLike()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.client.like', compact('top_products', 'categories'));
    }

}
