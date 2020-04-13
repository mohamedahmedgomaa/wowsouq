<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(AdminDatatable $admin)
    {
        //
        return $admin->render('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
            'password' => 'required|confirmed|min:6',
//            'roles_list' => 'required'
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'password.required' => 'Password Id is Required',
//            'roles_list.required' => 'Roles List Id is Required'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
//        $user = User::create($request->except('roles_list'));
//        $user->roles()->attach($request->input('roles_list'));
        $record = User::create($request->all());
        flash()->success("Success");
        return redirect(route('admin.index'));
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
        //
        $model = User::findOrFail($id);
        return view('admin.admins.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        //
        $records = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|confirmed',
//            'roles_list' => 'required'
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'password.required' => 'Password Id is Required',
//            'roles_list.required' => 'Roles List Id is Required'
        ]);
//        $records->roles()->sync((array) $request->input('roles_list'));
        $records->update($request->except('password'));
        if (request()->input('password')) {
            $records->update(['password' => bcrypt($request->password)]);
        }
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/admin'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            User::destroy(request('item'));
        } else {
            User::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(url('admin/admin'));
    }
}
