<?php

namespace App\Http\Controllers\WowSouq\Seller;

use App\Http\Requests\ProductRequest;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Client;
use App\Model\File;
use App\Model\Like;
use App\Model\Product;
use App\Model\Seller;
use App\Model\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function create()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
        $category = Category::all();
        return view('wow_souq.sellers.products.create', compact('top_products', 'categories', 'category'));
    }

    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|' . v_image(),
            'files.*' => 'required|' . v_image(),
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
        if ($input['offer'] <= $input['price'] && $input['offer'] != null) {
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

        foreach ($request->file('files') as $file) {

            $uploadFile = $file->store('products/' . $record->id);
            File::create([
               'seller_id' => auth('sellers')->user()->id,
               'product_id' => $record->id,
                'path' => 'products/' . $record->id,
                'file' => $uploadFile,
                'file_name' => $file->getClientOriginalName(),
                'size' => Storage::size($uploadFile),
            ]);
        }

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if (auth('sellers')->user()->id == $product->seller_id) {
            $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
            $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();
            $category = Category::all();
            return view('wow_souq.sellers.products.edit', compact('product', 'top_products', 'categories', 'category'));
        }
        return abort(403);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('delete_photo') && $request->has('file_id')) {
            foreach ($request->input('file_id') as $file_id) {
                $file = File::find($file_id);
                Storage::delete($file->file);
                $file->delete();
            }
            flash()->success(trans('admin.photoIsDeleted'));
            return redirect()->back();
        }
        $records = Product::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => v_image(),
            'files.*' => v_image(),
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required',
            'number_product' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'description.required' => trans('validation.descriptionIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'price.required' => trans('validation.priceIsRequired'),
            'price.numeric' => trans('validation.priceIsNumeric'),
            'offer.numeric' => trans('validation.offerIsNumeric'),
            'category_id.required' => trans('validation.categoryIdIsRequired'),
            'number_product.required' => trans('validation.numberProductIsRequired'),
        ]);

        if ($request['offer'] <= $request['price'] && $request['offer'] != null) {
            flash()->error(trans('admin.The offer price is smaller than or equal to the product price'));
            return redirect()->back();
        }

        $records->update($request->except('image'));

        if (request()->hasFile('image')) {
            $records['image'] = up()->upload([
                'file' => 'image',
                'path' => 'products',
                'upload_type' => 'single',
                'delete_file' => $records->image,
            ]);
            $records->image = $records['image'];
            $records->save();
        }
        if (request()->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $uploadFile = $file->store('products/' . $records->id);
                File::create([
                    'seller_id' => auth('sellers')->user()->id,
                    'product_id' => $records->id,
                    'path' => 'products/' . $records->id,
                    'file' => $uploadFile,
                    'file_name' => $file->getClientOriginalName(),
                    'size' => Storage::size($uploadFile),
                ]);
            }
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (auth('sellers')->user()->id == $product->seller_id) {
            Storage::delete($product->image);
            Storage::deleteDirectory('products/'.$product->id);
            $file = File::where('product_id', $product->id)->delete();
            $product->delete();
            flash()->error(trans('admin.deleted_record'));
            return redirect(url('seller'));
        }
        return abort(403);
    }

}
