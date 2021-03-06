<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Model\File;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductDatatable;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(ProductDatatable $admin)
    {
        //
        if (session('lang') === 'en') {
            session()->put('lang', 'en');
        } elseif (session('lang') === 'ar') {
            session()->put('lang', 'ar');
        } else {
            session()->put('lang', 'ar');
        }
        return $admin->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ProductRequest $request)
    {
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

        $record = Product::create($input);

        foreach ($request->file('files') as $file) {
            $uploadFile = $file->store('products/' . $record->id);
            File::create([
                'seller_id' => $request->seller_id,
                'product_id' => $record->id,
                'path' => 'products/' . $record->id,
                'file' => $uploadFile,
                'file_name' => $file->getClientOriginalName(),
                'size' => Storage::size($uploadFile),
            ]);
        }


        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = Product::findOrFail($id);
        return view('admin.products.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
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
            'files' => 'array|max:4',
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required',
            'seller_id' => 'required',
            'number_product' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
            'description.required' => trans('validation.descriptionIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'files.image' => trans('validation.filesIsImage'),
            'files.mimes' => trans('validation.filesIsMimes'),
            'price.required' => trans('validation.priceIsRequired'),
            'price.numeric' => trans('validation.priceIsNumeric'),
            'offer.numeric' => trans('validation.offerIsNumeric'),
            'category_id.required' => trans('validation.categoryIdIsRequired'),
            'seller_id.required' => trans('validation.sellerIdIsRequired'),
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
                    'seller_id' => $request->seller_id,
                    'product_id' => $records->id,
                    'path' => 'products/' . $records->id,
                    'file' => $uploadFile,
                    'file_name' => $file->getClientOriginalName(),
                    'size' => Storage::size($uploadFile),
                ]);
            }
        }


        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/product'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Product::destroy(request('item'));
        } else {
            Product::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/product'));
    }
}
