<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Campaign;

class UserController extends Controller
{
    public function index()
    {
        $users = Campaign::with('user:id,name')->get(['users_id']);
        // $totalUsers = 0;
        // if(count($users) >= 2) {
        //     $totalUsers = 2;
        // } else {
        //     $totalUsers = count($users);
        // }

        $tempUsers = [];
        for($i = 0; $i < count($users); $i++){
            if ($i < 5) {
                array_push($tempUsers, $users[$i]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'List Data Creator!',
            'data'    => $tempUsers,
        ]);
        
    }

    public function show($id)
    {
        $current_user = User::find($id);

        return response()->json([
            'data' => $current_user
        ]);
    }
}
