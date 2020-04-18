<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientSoftDeleteDatatable;
use App\Http\Requests\ClientCreateRequest;
use App\Model\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ClientDatatable;
use Illuminate\Routing\Redirector;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ClientDatatable $client
     * @return void
     */
    public function index(ClientDatatable $client)
    {
        //
        return $client->render('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientCreateRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ClientCreateRequest $request)
    {
        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'clients',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $input['password'] = bcrypt($input['password']);

        $record = Client::create($input);

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('client.index'));
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
        $model = Client::findOrFail($id);
        return view('admin.clients.edit', compact('model'));
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
        $records = Client::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id,
            'password' => 'sometimes|nullable|confirmed',
            'phone' => 'required',
            'image' => v_image(),
            'age' => 'required',
            'gender' => 'required|in:male,female',
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
            'age.required' => trans('validation.ageIsRequired'),
            'gender.required' => trans('validation.genderIsRequired'),
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'address.required' => trans('validation.addressIsRequired'),
            'longitude.required' => trans('validation.longitudeIsRequired'),
            'latitude.required' => trans('validation.latitudeIsRequired'),
            'status.required' => trans('validation.statusIsRequired'),
            'status.in' => trans('validation.statusIsIn'),
            'gender.in' => trans('validation.genderIsIn'),
        ]);


        $records->update($request->except('password', 'image'));
        if (request()->input('password')) {
            $records->update(['password' => bcrypt($request->password)]);
        }

        if (request()->hasFile('image')) {
            $records['image'] = up()->upload([
                'file' => 'image',
                'path' => 'clients',
                'upload_type' => 'single',
                'delete_file' => $records->image,
            ]);
            $records->image = $records['image'];
            $records->save();
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/client'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Client::destroy(request('item'));
        } else {
            Client::find(request('item'))->delete();
        }

        flash()->success(trans('admin.deleted_record'));
        return redirect(url('admin/client'));
    }


    public function wallet(Request $request,$id)
    {
        $wallet = Client::findOrFail($id);
        $wallet->wallet = $wallet->wallet + $request->wallet;
        $wallet->save();
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(url('admin/client'));
    }

    public function trashed(ClientSoftDeleteDatatable $client)
    {
        return $client->render('admin.clients.soft_delete');
    }


    public function softDelete($id)
    {
        $client = Client::withTrashed()->where('id', $id)->first();
        $client->forceDelete();
        flash()->success(trans('admin.forceDeleted'));
        return redirect()->back();
    }

    public function restore($id)
    {
        $client = Client::withTrashed()->where('id', $id)->first();
        $client->restore();
        flash()->success(trans('admin.restoreData'));
        return redirect()->back();
    }
}
