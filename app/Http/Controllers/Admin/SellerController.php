<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SellerSoftDeleteDatatable;
use App\Http\Requests\SellerRequest;
use App\Model\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SellerDatatable;
use Illuminate\Routing\Redirector;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SellerDatatable $seller
     * @return void
     */
    public function index(SellerDatatable $seller)
    {
        //
        return $seller->render('admin.sellers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SellerRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(SellerRequest $request)
    {
        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'sellers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $input['password'] = bcrypt($input['password']);

        $record = Seller::create($input);

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('seller.index'));
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
        $model = Seller::findOrFail($id);
        return view('admin.sellers.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $records = Seller::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:sellers,email,' . $id,
            'password' => 'sometimes|nullable|confirmed',
            'phone' => 'required',
            'image' => v_image(),
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
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'address.required' => trans('validation.addressIsRequired'),
            'longitude.required' => trans('validation.longitudeIsRequired'),
            'latitude.required' => trans('validation.latitudeIsRequired'),
        ]);


        $records->update($request->except('password', 'image'));
        if (request()->input('password')) {
            $records->update(['password' => bcrypt($request->password)]);
        }

        if (request()->hasFile('image')) {
            $records['image'] = up()->upload([
                'file' => 'image',
                'path' => 'sellers',
                'upload_type' => 'single',
                'delete_file' => $records->image,
            ]);
            $records->image = $records['image'];
            $records->save();
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('seller.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Seller::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/seller'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Seller::destroy(request('item'));
        } else {
            Seller::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/seller'));
    }

    public function activated($id)
    {
        $activated = Seller::findOrFail($id);
        $activated->status = 'activated';
        $activated->save();
        flash()->success(trans('admin.activatedMessage'));
        return redirect(url('admin/seller'));
    }

    public function notActivated($id)
    {
        $not_activated = Seller::findOrFail($id);
        $not_activated->status = 'not_activated';
        $not_activated->save();
        flash()->success(trans('admin.notActivatedMessage'));
        return redirect(url('admin/seller'));
    }

    public function forbidden($id)
    {
        $forbidden = Seller::findOrFail($id);
        $forbidden->status = 'forbidden';
        $forbidden->save();
        flash()->success(trans('admin.forbiddenMessage'));
        return redirect(url('admin/seller'));
    }

    public function wallet(Request $request, $id)
    {
        $wallet = Seller::findOrFail($id);
        $wallet->wallet = $wallet->wallet + $request->wallet;
        $wallet->save();
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(url('admin/seller'));
    }

    public function trashed(SellerSoftDeleteDatatable $seller)
    {
        return $seller->render('admin.clients.soft_delete');
    }


    public function softDelete($id)
    {
        $client = Seller::withTrashed()->where('id', $id)->first();
        $client->forceDelete();
        flash()->success(trans('admin.forceDeleted'));
        return redirect()->back();
    }

    public function restore($id)
    {
        $client = Seller::withTrashed()->where('id', $id)->first();
        $client->restore();
        flash()->success(trans('admin.restoreData'));
        return redirect()->back();
    }
}
