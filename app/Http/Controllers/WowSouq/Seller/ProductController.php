<?php

namespace App\Http\Controllers\WowSouq\Seller;

use App\Http\Requests\ProductRequest;
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

class ProductController extends Controller
{
    //
    public function create()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
        $category = Category::all();
        return view('wow_souq.sellers.product.create', compact('top_products', 'categories', 'category'));
    }

    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|' . v_image(),
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'number_product' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'description.required' => trans('validation.descriptionIsRequired'),
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'price.required' => trans('validation.priceIsRequired'),
            'price.numeric' => trans('validation.priceIsNumeric'),
            'offer.numeric' => trans('validation.offerIsNumeric'),
            'category_id.required' => trans('validation.categoryIdIsRequired'),
            'category_id.exists' => trans('validation.categoryIdIsExists'),
            'seller_id.required' => trans('validation.sellerIdIsRequired'),
            'number_product.required' => trans('validation.numberProductIsRequired'),
        ]);
        $input = $request->all();
        if ($input['offer'] <= $input['price']) {
            flash()->error(trans('admin.The offer price is smaller than or equal to the product price'));
            return redirect()->back();
        }

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'products',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $input['seller_id'] = auth('sellers')->user()->id;

        $record = Product::create($input);


        flash()->success(trans('admin.createMessageSuccess'));
        return redirect()->back();
    }
}
