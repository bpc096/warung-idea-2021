<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications as Notif;

class NotificationController extends Controller
{
    /**
   * Get Notification By Id User
   *
   * @return \Illuminate\Http\Response
   */
    public function index() {
        $idUser = auth('api')->user()->id;
        $notifications = Notif::where("to", $idUser)
        ->where("is_read", '0') // ** Choose only the unread notif
        ->get();
        $results = [];
        foreach($notifications as $notif) {
            $data = [];
            $data["title"]   = $notif->title;
            $data["content"] = $notif->content;
            $data["is_read"] = $notif->is_read;
            $results[] = $data;
        }

        return response()->json([
            "notifications" => $results,
            "count" => count($results)
        ]);
    }

    /**
   * Mark Notification As Read Response
   *
   * @return \Illuminate\Http\Response
   */
    public function markNotifAsRead(Request $req) {
        $res = false;

        $idUser = auth('api')->user()->id;
        $update = Notif::where("to", $idUser)
        ->update([
            "is_read" => "1"
        ]);
        if($update) {
          $res = true;
        }

        return response()->json([
            "success" => $res
        ]);
    }
}
