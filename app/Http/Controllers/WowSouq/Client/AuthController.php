<?php

namespace App\Http\Controllers\WowSouq\Client;

use App\Http\Requests\ClientCreateRequest;
use App\Mail\ResetPasswordClient;
use App\Mail\WowSouqResetPasswordClient;
use App\Model\Category;
use App\Model\Client;
use App\Model\File;
use App\Model\Product;
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
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.client.auth.login', compact('categories', 'top_products'));
    }

    public function login(Request $request)
    {
        $rememberme = request('rememberme') == 1 ? true : false;
        if (auth()->guard('clients')->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
//            dd(auth('clients')->client()->name);
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
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.client.auth.register', compact('categories', 'top_products'));
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

    public function getForgetPassword()
    {
        return view('wow_souq.client.auth.forget_password');
    }

    public function forgetPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|exists:clients,email',
        ]);

        $client = Client::where('email',$request->email)->first();
        if ($client) {
            $code = rand(1111, 9999);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($client->email)
                    ->bcc('mido.15897@gmail.com')
                    ->send(new WowSouqResetPasswordClient($code));
                flash()->success(trans('admin.sendMessageSuccess'));
                return redirect()->route('wowsouq.client.get.reset.password'); //->route('wow_souq.client.auth.reset');
            } else {
                flash()->error(trans('admin.sendMessageError'));
                return back();
            }
        } else {
            flash()->error(trans('admin.sendMessageError'));
            return back();
        }

    }

    public function getResetPassword()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        return view('wow_souq.client.auth.new_password',compact('top_products'));
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'pin_code' => 'required',
            'email' => 'required|exists:clients,email',
            'password' => 'required|confirmed',
        ]);

        $client = Client::where('pin_code',$request->pin_code)->where('pin_code', '!=' , 0)
            ->where('email',$request->email)->first();
        if ($client) {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;

            if ($client->save())
            {
                flash()->success(trans('admin.editMessageSuccess'));
                return redirect()->route('wowsouq.client.get_login');
            } else {
                flash()->error(trans('admin.editMessageError'));
                return back();
            }
        } else {
            flash()->error(trans('admin.editMessageError'));
            return back();
        }
    }

}
