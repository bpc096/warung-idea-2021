<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Conversation;
use App\Events\MessageCreated;
use App\Message;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    // ** Get Inbox
    public function index($user_id) {
        $conversationList = Conversation::select('conversations.*', 'users.name as sender')
        ->join('users', 'users.id', '=', 'conversations.sender')
        ->where('conversations.receiver', $user_id)
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
        */

        $validator = Validator::make($req->all(), [
            'sender'   => 'required',
            'receiver' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $conversation = new Conversation;
        $conversation->sender   = $req->sender;
        $conversation->receiver = $req->receiver;
        $save = $conversation->save();

        if($save) {
            return response()->json([
                'success' => true,
                'message' => 'Inbox has been created'
            ], 201);
        }
    }

    // ** Get Conversation
    public function messages(Request $req) {
        $idConversation = $req->id_conversation;
        $idUser         = $req->id_user;
        
        $getConversation = Message::select('messages.*', 'users.name')
        ->join('users', 'users.id', '=', 'messages.user_id')
        ->where([
            'messages.conversation_id' => $idConversation,
            'messages.user_id' => $idUser
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
        $msg->conversation_id = $req->id_conv;
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
