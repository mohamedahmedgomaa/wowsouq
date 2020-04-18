<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\OrderDatatable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(OrderDatatable $admin)
    {
//        dd(Order::all());
        return $admin->render('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return void
     */
    public function edit()
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update()
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/order'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Order::destroy(request('item'));
        } else {
            Order::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/order'));
    }
}
