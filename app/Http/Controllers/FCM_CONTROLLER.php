<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Model\Token;
use App\User;

class FCM_CONTROLLER extends Controller
{
    public static function SEND_SINGLE_NOTIFICATION($user_id, $notification_title, $notification_body, $notification_data, $time_to_live = 60)
    {
        if (!Token::where('user_id', $user_id)->first()) {
            return 0;
        }
        $token = Token::where('user_id', $user_id)->first();
        if ($token->is_logged_in == "false") {
            return false;
        }
        $fcm_token = $token->fcm;
        $device_type = $token->device_type;
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive($time_to_live);
        $notificationBuilder = new PayloadNotificationBuilder($notification_title);
        $notificationBuilder->setBody($notification_body)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($notification_data);
        $option = $optionBuilder->build();
        if ($device_type == 'ios') {
            $notification = $notificationBuilder->build();
        } else {
            $notification = null;
        }
        $data = $dataBuilder->build();
        $send_process = false;
        try {
            $send_process = FCM::sendTo($fcm_token, $option, $notification, $data);
        } catch (\Exception $e) {
            $e->getMessage();
        }

        return $send_process;
    }

    // public static function SEND_MULTIPLE_NOTIFICATION_BY_ARRAY_OF_USERS_ID($array_of_users, $notification_title, $notification_body, $notification_data, $time_to_live = 60 * 20)
    public static function SEND_MULTIPLE_NOTIFICATION_BY_ARRAY_OF_USERS_ID($array_of_users, $fcm, $time_to_live = 60 * 20)
    {
        $android_ar_fcm_tokens = array();
        $android_en_fcm_tokens = array();
        $ios_ar_fcm_tokens = array();
        $ios_en_fcm_tokens = array();
        foreach ($array_of_users as $user_id) {
            $user = User::find($user_id);
            if ($user->lang == "ar") {
                if ($user->token && $user->token->device_type == "ios" && $user->token->fcm != "") {
                    array_push($ios_ar_fcm_tokens, $user->token->fcm);
                }
                if ($user->token && $user->token->device_type == "android" && $user->token->fcm != "") {
                    array_push($android_ar_fcm_tokens, $user->token->fcm);
                }

                if ($fcm['notification_body_ar']) {
                    $notification_title_ar = $fcm['notification_body_ar'];
                } else {
                    $notification_title_ar = trans("app.new_fcm_alert", [], 'ar');
                }
                $notification_data['title'] = $notification_title_ar;
            } else {
                if ($user->token && $user->token->device_type == "android" && $user->token->fcm != "") {
                    array_push($android_en_fcm_tokens, $user->token->fcm);
                }
                if ($user->token && $user->token->device_type == "ios" && $user->token->fcm != "") {
                    array_push($ios_en_fcm_tokens, $user->token->fcm);
                }
                if ($fcm['notification_body_en']) {
                    $notification_title_ar = $fcm['notification_body_en'];
                } else {
                    $notification_title_ar = trans("app.new_fcm_alert", [], 'en');
                }
                $notification_data['title'] = $notification_title_ar;
            }

            if ($fcm['key']) {
                $notification_data['key'] = $fcm['key'];
            }
            if ($fcm['id']) {
                $notification_data['id'] = $fcm['id'];
            }

            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive($time_to_live);
            $notificationBuilder = new PayloadNotificationBuilder($notification_data['title']);
            $notificationBuilder->setBody($notification_data['body'])
                ->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($notification_data);
            $option = $optionBuilder->build();
            $data = $dataBuilder->build();
            if (count($android_ar_fcm_tokens)) {
                FCM::sendTo($android_ar_fcm_tokens, $option, $notification = null, $data);
            }
            if (count($android_en_fcm_tokens)) {
                FCM::sendTo($android_en_fcm_tokens, $option, $notification = null, $data);
            }
            if (count($ios_ar_fcm_tokens)) {
                FCM::sendTo($ios_ar_fcm_tokens, $option, $notification, $data);
            }
            if (count($ios_ar_fcm_tokens)) {
                FCM::sendTo($ios_ar_fcm_tokens, $option, $notification, $data);
            }

            return true;

        }
    }

    public static function SEND_FCM_NOTIFICATION($devices, $notification_title, $notification_body, $notification_data, $os = 'android', $time_to_live = 60 * 2)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive($time_to_live);
        $notificationBuilder = new PayloadNotificationBuilder($notification_title);
        $notificationBuilder->setBody($notification_body)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($notification_data);
        $option = $optionBuilder->build();
        if ($os == "ios") {
            $notification = $notificationBuilder->build();
        } else {
            $notification = null;
        }
        $data = $dataBuilder->build();
        try {
            $downstreamResponse = FCM::sendTo($devices, $option, $notification, $data);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
