<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\User;

class ProfileController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data Profile',
            'data'    => auth()->guard('api')->user(),
        ], 200);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // get data profile
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        
        // update with upload avatar
        if ($request->file('avatar')) {

            // delete old image
            Storage::disk('local')->delete('public/users'.basename($user->image));

            // upload image baru
            $image = $request->file('avatar');
            $image->storeAs('public/users', $image->hashName());

            $user->update([
                'name'      => $request->name,
                'avatar'    => $image->hashName()
            ]);

        } 
        
        //update without avatar
        $user->update([
            'name'      => $request->name,
        ]);

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profile Berhasil Diupdate!',
            'data'    => $user,
        ], 201);

    }

    /**
     * updatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $user->update([
            'password'  => Hash::make($request->password)
        ]);
            

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Password Berhasil Diupdate!',
            'data'    => $user,
        ], 201);
    }

}