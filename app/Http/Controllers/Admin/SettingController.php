<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.edit')->with('settings', Setting::first());
    }


    public function update(Request $request)
    {

        $data = $this->validate($request, [
            'phone' => 'required',
            'email' => 'required',
            'text' => 'required',
            'image' => v_image(),
            'image_login_client' => v_image(),
            'image_register_client' => v_image(),
            'image_wow_souq' => v_image(),
            'image_login_seller' => v_image(),
            'image_register_seller' => v_image(),
            'image_login_admin' => v_image(),
            'image_product' => v_image(),
            'whats_app' => 'required',
            'instagram' => 'required',
            'you_tube' => 'required',
            'facebook' => 'required',
        ]);

        $setting = Setting::first();

        if (request()->hasFile('image')) {
            $setting['image'] = up()->upload([
                'file' => 'image',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image,
            ]);
        }
        if (request()->hasFile('image_wow_souq')) {
            $setting['image_wow_souq'] = up()->upload([
                'file' => 'image_wow_souq',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_wow_souq,
            ]);
        }
        if (request()->hasFile('image_login_client')) {
            $setting['image_login_client'] = up()->upload([
                'file' => 'image_login_client',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_login_client,
            ]);
        }
        if (request()->hasFile('image_register_client')) {
            $setting['image_register_client'] = up()->upload([
                'file' => 'image_register_client',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_register_client,
            ]);
        }

        if (request()->hasFile('image_login_seller')) {
            $setting['image_login_seller'] = up()->upload([
                'file' => 'image_login_seller',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_login_seller,
            ]);
        }

        if (request()->hasFile('image_register_seller')) {
            $setting['image_register_seller'] = up()->upload([
                'file' => 'image_register_seller',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_register_seller,
            ]);
        }

        if (request()->hasFile('image_login_admin')) {
            $setting['image_login_admin'] = up()->upload([
                'file' => 'image_login_admin',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_login_admin,
            ]);
        }

        if (request()->hasFile('image_product')) {
            $setting['image_product'] = up()->upload([
                'file' => 'image_product',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_product,
            ]);
        }

        if (request()->hasFile('image_profile_client')) {
            $setting['image_profile_client'] = up()->upload([
                'file' => 'image_profile_client',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_profile_client,
            ]);
        }

        if (request()->hasFile('image_profile_seller')) {
            $setting['image_profile_seller'] = up()->upload([
                'file' => 'image_profile_seller',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => settings()->image_profile_seller,
            ]);
        }



        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->text = $request->text;
        $setting->whats_app = $request->whats_app;
        $setting->instagram = $request->instagram;
        $setting->you_tube = $request->you_tube;
        $setting->facebook = $request->facebook;
        $setting->save();

        flash()->success("تم التعديل بنجاح");
        return redirect()->back();


    }
}
