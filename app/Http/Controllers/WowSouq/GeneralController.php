<?php

namespace App\Http\Controllers\WowSouq;

use App\Http\Requests\ContactRequest;
use App\Model\Category;
use App\Model\Contact;
use App\Model\Like;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    //
    public function wow_souq()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $top_product = Product::withCount(['orders'])->orderBy('orders_count', 'desc')->limit(4)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
        return view('wow_souq/index', compact('top_products', 'top_product', 'categories'));
    }

    public function contact()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq/contact', compact('top_products', 'categories'));
    }

    public function contacts(ContactRequest $request)
    {

        $input = $request->all();
        $record = Contact::create($input);

        return redirect()->back();
    }

    public function product($id)
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $product = Product::findOrFail($id);

        return view('wow_souq/products/product', compact('top_products', 'categories', 'product'));
    }
}
