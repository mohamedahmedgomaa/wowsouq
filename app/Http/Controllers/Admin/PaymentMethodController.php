<?php

namespace App\Http\Controllers\Admin;

use App\Model\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PaymentMethodDatatable;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(PaymentMethodDatatable $admin)
    {
        //
        return $admin->render('admin.payment_methods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);

        $record = PaymentMethod::create($request->all());

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('payment-method.index'));
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
        $model = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('model'));
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
        $records = PaymentMethod::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);

        $records->update($request->all());

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('payment-method.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        PaymentMethod::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/payment-method'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            PaymentMethod::destroy(request('item'));
        } else {
            PaymentMethod::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/payment-method'));
    }
}
