<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdRequest;
use App\Model\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdDatatable;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(AdDatatable $admin)
    {
        return $admin->render('admin.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AdRequest $request)
    {
        $input = $request->all();
        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'ads_ads',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $record = Ad::create($input);

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('ad.index'));
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
        $model = Ad::findOrFail($id);
        return view('admin.ads.edit', compact('model'));
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
        $records = Ad::findOrFail($id);
        $this->validate($request, [
            'image' => v_image(),
            'time_start' => 'required',
            'time_finish' => 'nullable',
            'product_id' => 'required|exists:products,id',
        ], [
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'time_start.required' => trans('validation.timeStartIsRequired'),
            'time_finish.required' => trans('validation.timeFinishIsRequired'),
            'product_id.required' => trans('validation.productIdIsRequired'),
            'product_id.exists' => trans('validation.productIdIsExists'),
        ]);

        $records->update($request->except('image'));

        if (request()->hasFile('image')) {
            $records['image'] = up()->upload([
                'file' => 'image',
                'path' => 'ads_ads',
                'upload_type' => 'single',
                'delete_file' => $records->image,
            ]);
            $records->image = $records['image'];
            $records->save();
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('ad.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Ad::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/ad'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Ad::destroy(request('item'));
        } else {
            Ad::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/ad'));
    }
}
