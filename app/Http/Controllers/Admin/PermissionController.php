<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientSoftDeleteDatatable;
use App\Model\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PermissionDatatable;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PermissionDatatable $permission
     * @return void
     */
    public function index(PermissionDatatable $permission)
    {
        //
        return $permission->render('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permissions.create');
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
            'name_ar' => 'required',
            'routes' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);

        $input = $request->all();

        $record = Permission::create($input);

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect()->back();
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
        $model = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('model'));
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
        $records = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'name_ar' => 'required',
            'routes' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);


        $records->update($request->all());


        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/permission'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Permission::destroy(request('item'));
        } else {
            Permission::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/permission'));
    }

}
