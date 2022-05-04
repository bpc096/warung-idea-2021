<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications as Notif;

class NotificationController extends Controller
{
    // ** Get Notification By Id User
    public function index() {
        $idUser = auth('api')->user()->id;
        $notifications = Notif::where("to", $idUser)->get();
        $results = [];
        foreach($notifications as $notif) {
            $data = [];
            $data["title"]   = $notif->title;
            $data["content"] = $notif->content;
            $data["is_read"] = $notif->is_read;
            $results[] = $data;
        }
        print_r($results);
    }
}
