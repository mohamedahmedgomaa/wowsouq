<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientSoftDeleteDatatable;
use App\Model\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\RoleDatatable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleDatatable $role
     * @return void
     */
    public function index(RoleDatatable $role)
    {
        //
        return $role->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (session('lang') === 'en') {
            session()->put('lang', 'en');
            $permission = Permission::pluck('name','id')->all();
        } elseif (session('lang') === 'ar') {
            session()->put('lang', 'ar');
            $permission = Permission::pluck('name_ar','id')->all();
        } else {
            session()->put('lang', 'ar');
            $permission = Permission::pluck('name_ar','id')->all();
        }

        return view('admin.roles.create', compact('permission'));
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
            'permission' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);

        $record = Role::create($request->except('permission'));
        $record->syncPermissions($request->input('permission'));

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('role.index'));
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
        $model = Role::findOrFail($id);
        $permission = Permission::get();
//        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
//            ->where("role_has_permissions.role_id",$id)
//            ->get()->toArray();
//        dd($rolePermissions);
        return view('admin.roles.edit', compact('model', 'rolePermissions', 'permission'));
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
        $records = Role::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'name_ar' => 'required',
            'permission' => 'required',
        ], [
            'name.required' => trans('validation.nameIsRequired'),
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->name_ar = $request->input('name_ar');
        $role->save();

        $role->syncPermissions($request->input('permission'));


        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/role'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Role::destroy(request('item'));
        } else {
            Role::find(request('item'))->delete();
        }
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/role'));
    }

}
