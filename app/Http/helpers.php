<?php

use App\Model\Setting;

function responseJson($status, $message, $data=null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json($response);
}

if (!function_exists('up')) {
    function up() {
        return new \App\Http\Controllers\Upload;
    }
}

function settings()
{
    $settings = Setting::find(1);
    if ($settings) {
        return $settings;
    } else {
        return new Setting;
    }
}

if (!function_exists('lang')) {
    function lang() {
        if (session()->has('lang')) {
            return session('lang');
        } else {
//            session()->put('lang', settings()->main_lang);
//            return settings()->main_lang;
            return 'ar';
        }
    }
}


if (!function_exists('active_menu')) {
    function active_menu($link) {
        if (preg_match('/'.$link.'/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}


if (!function_exists('direction')) {
    function direction() {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'rtl';
        }
    }
}


function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{
// https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
// API access key from Google FCM App Console
    // env('FCM_API_ACCESS_KEY'));

//    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
//    $registrationIDs = array(
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
//    );
    $registrationIDs = $tokens;

// prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support​
// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)

// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
//    dd(env('FIREBASE_API_ACCESS_KEY'));
    $headers = array(
        'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );
    // if($type == 'client')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_client'),
    //         'Content-Type: application/json'
    //     );
    // }
    // if($type == 'driver')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_driver'),
    //         'Content-Type: application/json'
    //     );
    // }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}




if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return 	['sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu' => trans('admin.sLengthMenu'),
            'sZeroRecords' => trans('admin.sZeroRecords'),
            'sEmptyTable' => trans('admin.sEmptyTable'),
            'sInfo' => trans('admin.sInfo'),
            'sInfoEmpty' => trans('admin.sInfoEmpty'),
            'sInfoFiltered' => trans('admin.sInfoFiltered'),
            'sInfoPostFix' => trans('admin.sInfoPostFix'),
            'sSearch' => trans('admin.sSearch'),
            'sUrl' => trans('admin.sUrl'),
            'sInfoThousands' => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate' =>  [
                'sFirst'=> trans('admin.sFirst'),
                'sLast'=> trans('admin.sLast'),
                'sNext'=> trans('admin.sNext'),
                'sPrevious'=> trans('admin.sPrevious')
            ],
            'oAria' => [
                'sSortAscending'=> trans('admin.sSortAscending'),
                'sSortDescending'=> trans('admin.sSortDescending')
            ],
        ];
    }
}

///////// validate Helper Function /////////
if (!function_exists('v_image')) {
    function v_image($ext=null)
    {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:'.$ext;
        }
    }
}
///////// validate Helper Function /////////
