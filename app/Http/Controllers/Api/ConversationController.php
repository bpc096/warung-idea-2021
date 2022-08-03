<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Conversation;
use App\Message;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    // ** Get Inbox
    public function index($id_user) {
        $conversationList = Conversation::select('conversations.*', 'users.name as sender')
        ->join('users', 'users.id', '=', 'conversations.sender')
        ->where('conversations.receiver', $id_user)
        ->get();

        return response()->json([
            "success" => true,
            "conversation_list" => $conversationList
        ], 200);
    }

    // ** Post Inbox
    public function post_inbox(Request $req) {
        // ** Params :
        /*
            --> sender
            Value = id_user
            --> receiver
            Value = id_user
            --> id_campaign
            value = from id campaign
        */

        $validator = Validator::make($req->all(), [
            'sender'   => 'required',
            'receiver' => 'required',
            'id_campaign' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // ** Check if sender and receiver are same
        if($req->sender == $req->receiver) {
            return response()->json([
                'success' => false,
                'message' => 'Sender and receiver must not be same'
            ], 400);
        }

        // ** Check if inbox already exist
        $checkInbox = Conversation::where([
            'sender' => $req->sender,
            'receiver' => $req->receiver
        ])
        ->first();

        // ** If user has never created the conversation
        if(empty($checkInbox)) {
            $code = "cnv_".date('ymdhis')."_".rand(10000, 99999);
            $data = [
                [
                    'sender'      => $req->sender,
                    'receiver'    => $req->receiver,
                    'id_campaign' => $req->id_campaign,
                    'code'        => $code
                ],
                [
                    'sender'      => $req->receiver,
                    'receiver'    => $req->sender,
                    'id_campaign' => $req->id_campaign,
                    'code'        => $code
                ]
            ];
            $save = Conversation::insert($data);

            if($save) {
                return response()->json([
                    'success' => true,
                    'message' => 'Inbox has been created'
                ], 201);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Conversation already exist',
            'code'    => $checkInbox->code
        ], 400);
    }

    // ** Get Conversation
    public function messages($id_conversation) {
        $getConversation = Message::select('messages.*', 'users.name')
        ->join('users', 'users.id', '=', 'messages.user_id')
        ->where([
            'messages.id_conversation' => $id_conversation,
        ])
        ->orderBy('messages.created_at', 'desc')
        ->get();
        return response()->json([
            'success' => true,
            'messages' => $getConversation
        ]);
    }

    public function post_message(Request $req) {
        $validator = Validator::make($req->all(), [
            'id_conv' => 'required',
            'id_user' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $msg = new Message;
        $msg->id_conversation = $req->id_conv;
        $msg->user_id         = $req->id_user;
        $msg->body            = $req->content;

        if($msg->save()) {
            return response()->json([
                'success' => true
            ], 201);
        }

        return response()->json([
            'success' => false
        ], 500);
    }
}
