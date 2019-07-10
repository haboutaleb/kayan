<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_API;

class NotificationController extends PARENT_API
{
    public static function MK_NOTIFY($user_id, $type, $order_id, $value_ar, $value_en, $is_seen = 0)
    {
        $notify = new Notification();
        $notify->user_id = $user_id;
        $notify->type = $type;
        $notify->order_id = $order_id;
        $notify->value_ar = $value_ar;
        $notify->value_en = $value_en;
        $notify->is_seen = $is_seen;
        $notify->save();
        return $notify;
    }

    public static function DEL_NOTIFY($conditions)
    {

        $query = DB::table('notification');
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        $query->delete();
        return true;
    }

    public function my_notifications(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $this->data['data'] = Notification::where('user_id', $user->id)->select('id', 'type', 'order_id', 'user_id', 'value_' . $this->lang . ' as value', 'type', 'is_seen', 'created_at')->orderBy('id', 'desc')->get();
        Notification::where('user_id', $user->id)->update(['is_seen' => 1]);
        $this->data['status'] = "ok";
        $this->data['message'] = "";
        return response()->json($this->data, 200);
    }
}
