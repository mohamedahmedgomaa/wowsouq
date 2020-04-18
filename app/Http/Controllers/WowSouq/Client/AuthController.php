<?php

namespace App\Http\Controllers\WowSouq\Client;

use App\Http\Requests\ClientCreateRequest;
use App\Mail\ResetPasswordClient;
use App\Model\Client;
use App\Model\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('wow_souq.client.auth.login');
    }

    public function login(Request $request)
    {
        $rememberme = request('rememberme') == 1 ? true : false;
        if (auth()->guard('clients')->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
//            dd(auth('clients')->user()->name);
            return redirect('/');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    }

    public function logout()
    {
        if (auth('clients')->check())
        {
            auth()->guard('clients')->logout();
            return redirect()->route('index');
        }
        return redirect()->back();
    }

    public function getRegister()
    {
        return view('wow_souq.client.auth.register');
    }

    public function register(ClientCreateRequest $request)
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
        return redirect(route('wowsouq.client.get_login'));
    }

}
