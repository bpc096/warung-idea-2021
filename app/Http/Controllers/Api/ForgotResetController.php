<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotResetController extends Controller
{
    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email');

        if(User::where('email', $email)->doesntExist()){
            return response()->json([
                'message' => 'User doesn\'t exists!'
            ], 404);
        }
        
        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            Mail::send('emails.forgot', ['token' => $token], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset Your Password (Warung Idea)');
            });

            //send email
            return response()->json([
                'message' => 'Check your email!'
            ], 200);
            
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');

        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()){
            return response()->json([
                'message' => 'Invalid token!'
            ], 400);
        }

        if (!$user = User::where('email', $passwordResets->email)->first()) {
            return response()->json([
                'message' => 'User doesn\'t exists!'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'message' => 'Success To Reset Password!'
        ], 201);
    }
}
