<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return response()->json([
            'data' => $users
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
