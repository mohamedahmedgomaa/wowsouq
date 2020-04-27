<?php

namespace App\Http\Controllers\Admin;

use App\Model\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ReviewDatatable;
use Illuminate\Routing\Redirector;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(ReviewDatatable $admin)
    {
//        dd(Review::all());
        return $admin->render('admin.reviews.index');
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
     * @return void
     */
    public function show()
    {
        //
        return abort(404);
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
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Review::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/review'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Review::destroy(request('item'));
        } else {
            Review::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/review'));
    }
}
