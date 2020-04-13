<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller
{
//    $request, $path,$upload_type='single',$delete_file=null, $new_name = null, $crud_type = []
    public function upload($data = [])
    {
        if (in_array('new_name',$data)) {
            $new_name = $data['new_name'] === null ? time() : $data['new_name'];
        }
        if (request()->hasFile($data['file']) && $data['upload_type'] = 'single') {

            Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';

            return request()->file($data['file'])->store($data['path']);
        }
    }
}
