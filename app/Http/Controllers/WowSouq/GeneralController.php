<?php

namespace App\Http\Controllers\WowSouq;

use App\Http\Requests\ContactRequest;
use App\Model\Category;
use App\Model\Contact;
use App\Model\Like;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    //

    public function index()
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

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect()->back();
    }

    public function product($id)
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $product = Product::findOrFail($id);
//        foreach ($product->reviews as $review) {
//            dd($review->avg('rate'));
//        }

        return view('wow_souq/products/product', compact('top_products', 'categories', 'product'));
    }

    public function category($id)
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $category = Category::findOrFail($id);
        $products = $category->products()->paginate(20);
//        dd($products->count());
        $category_all = Category::all();

        return view('wow_souq/category', compact('top_products', 'categories', 'category', 'category_all', 'products'));
    }

    public function productAll()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $products = Product::orderBy('created_at', 'desc')->paginate(30);

        return view('wow_souq/products/product_all', compact('top_products', 'categories', 'products'));
    }

    public function productTop()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $productsTop = Product::withCount(['orders'])->orderBy('orders_count', 'desc')->paginate(30);

        return view('wow_souq/products/product_top', compact('top_products', 'categories', 'productsTop'));
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {

            $data = Product::where('name', 'LIKE', '%' . $request->country . '%')->take(10)
                ->get();

            $output = '';

            if (count($data) > 0) {
                $output = '<div>';
                $output .= '<ul style="display: block; position: absolute;width: 95%;">';

                foreach ($data as $row) {
                    $output .= '<a href="' . url('product', $row->id) . '"><li class="btn-light list-group-item" style="margin-top: 0;border: none">' . $row->name . '</li></a>';
                }

                $output .= '</ul>';
                $output .= '</div>';

            } else {

                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
            }

            return $output;
        }
    }

    public function productOffer()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        $products = Product::orderBy('created_at', 'desc')->where('offer', '!=', null)->paginate(30);

        return view('wow_souq/products/product_offer', compact('top_products', 'categories', 'products'));
    }

}
