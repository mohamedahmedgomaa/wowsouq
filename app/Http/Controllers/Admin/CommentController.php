<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CommentDatatable;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(CommentDatatable $admin)
    {
        //
        return $admin->render('admin.comments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        return abort(404);
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
     */
    public function edit()
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
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
        Comment::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/comment'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Comment::destroy(request('item'));
        } else {
            Comment::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/comment'));
    }
}
