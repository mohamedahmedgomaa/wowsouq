<?php

namespace App\Http\Controllers\WowSouq\Seller;

use App\Http\Requests\SellerRequest;
use App\Mail\WowSouqResetPasswordSeller;
use App\Model\Category;
use App\Model\File;
use App\Model\Product;
use App\Model\Seller;
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

        return view('wow_souq.sellers.auth.login', compact('categories', 'top_products'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:sellers,email',
            'password' => 'required',
        ]);

        $rememberme = request('rememberme') == 1 ? true : false;
        if (auth()->guard('sellers')->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect('/seller');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    }

    public function logout()
    {
        if (auth('sellers')->check())
        {
            auth()->guard('sellers')->logout();
            return redirect()->route('wowsouq.seller.get_login');
        }
        return redirect()->back();
    }

    public function getRegister()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.sellers.auth.register', compact('categories', 'top_products'));
    }

    public function register(SellerRequest $request)
    {

        $input = $request->all();

        if (request()->hasFile('image')) {
            $input['image'] = up()->upload([
                'file' => 'image',
                'path' => 'sellers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $input['password'] = bcrypt($input['password']);

        $record = Seller::create($input);

        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('wowsouq.seller.get_login'));
    }

    public function getForgetPassword()
    {
        $top_products = Product::withCount(['likes', 'comments'])->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->limit(5)->get();
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.sellers.auth.forget_password', compact('top_products', 'categories'));
    }

    public function forgetPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|exists:sellers,email',
        ]);

        $sellers = Seller::where('email',$request->email)->first();
        if ($sellers) {
            $code = rand(1111, 9999);
            $update = $sellers->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($sellers->email)
                    ->bcc('mido.15897@gmail.com')
                    ->send(new WowSouqResetPasswordSeller($code));
                flash()->success(trans('admin.sendMessageSuccess'));
                return redirect()->route('wowsouq.seller.get.reset.password');
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
        $categories = Category::withCount(['products'])->orderBy('products_count', 'desc')->limit(10)->get();

        return view('wow_souq.sellers.auth.new_password',compact('top_products', 'categories'));
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'pin_code' => 'required',
            'email' => 'required|exists:sellers,email',
            'password' => 'required|confirmed',
        ]);

        $sellers = Seller::where('pin_code',$request->pin_code)->where('pin_code', '!=' , 0)
            ->where('email',$request->email)->first();
        if ($sellers) {
            $sellers->password = bcrypt($request->password);
            $sellers->pin_code = null;

            if ($sellers->save())
            {
                flash()->success(trans('admin.editMessageSuccess'));
                return redirect()->route('wowsouq.seller.get_login');
            } else {
                flash()->error(trans('admin.editMessageError'));
                return back();
            }
        } else {
            flash()->error(trans('admin.editMessageError'));
            return back();
        }
    }

    public function resetCode(Request $request) {
        $this->validate($request, [
            'email' => 'required|exists:sellers,email',
        ]);

        $sellers = Seller::where('email',$request->email)->first();
        if ($sellers) {
            $code = rand(1111, 9999);
            $update = $sellers->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($sellers->email)
                    ->bcc('mido.15897@gmail.com')
                    ->send(new WowSouqResetPasswordSeller($code));
                flash()->success(trans('admin.sendMessageSuccess'));
                return redirect()->back();
            } else {
                flash()->error(trans('admin.sendMessageError'));
                return back();
            }
        } else {
            flash()->error(trans('admin.sendMessageError'));
            return back();
        }
    }


}
