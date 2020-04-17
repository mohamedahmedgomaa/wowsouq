<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

        if (session('lang') === 'en') {
            session()->put('lang', 'en');
            $roles = Role::pluck('name','id')->all();
        } elseif (session('lang') === 'ar') {
            session()->put('lang', 'ar');
            $roles = Role::pluck('name_ar','id')->all();
        } else {
            session()->put('lang', 'ar');
            $roles = Role::pluck('name_ar','id')->all();
        }
        return view('admin.admins.create', compact('roles'));
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
            'roles' => 'required'
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'password.required' => 'Password Id is Required',
            'roles.required' => 'Roles List Id is Required'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('roles'));
        $user->syncRoles($request->input('roles'));
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
        $roles = Role::pluck('name','name')->all();
        $userRole = $model->roles->pluck('name','name')->all();
        return view('admin.admins.edit', compact('model', 'roles', 'userRole'));
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
            'roles' => 'required'
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'password.required' => 'Password Id is Required',
            'roles.required' => 'Roles List Id is Required'
        ]);
        $records->roles()->sync((array) $request->input('roles'));
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

    public function getChangePassword()
    {
        return view('admin.admins.change_password');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error",trans("admin.Your current password does not matches with the password you provided. Please try again."));
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error",trans('admin.New Password cannot be same as your current password. Please choose a different password.'));
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success",trans('admin.Password changed successfully !'));
    }
}
