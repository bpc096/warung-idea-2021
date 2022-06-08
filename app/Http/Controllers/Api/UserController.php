<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Campaign;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = Campaign::with('user:id,name')->distinct()->inRandomOrder()->get(['users_id']);

        // $users->when(request('filter_by'))

        $tempUsers = [];
        for($i = 0; $i < count($users); $i++){
            if ($i < 5) {
                array_push($tempUsers, $users[$i]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'List Data Creator!',
            'data'    => $users,
        ]);

    }

    public function GetUser() {
        $getData = User::where('role', '!=', null)->paginate(10);
        return response()->json([
            'success' => true,
            'users'   => $getData
        ], 200);
    }

    public function show($id)
    {
        $current_user = User::find($id);
        return response()->json([
            'data' => $current_user
        ]);
    }

    public function Edit($id) {
        $getData = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'user'    => $getData 
        ], 200);
    }

    // ** Create User For Super Admin
    public function CreateUser(Request $req) {
        $validator = Validator::make($req->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'role'      => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $file = $req->file('avatar');

        $user = new User;
        $user->name     = $req->name;
        $user->email    = $req->email;
        $user->password = Hash::make($req->password);
        $user->role     = $req->role;

        // ** Jika upload image
        if(!empty($file)) {
            $extension = $file->extension();
            $size = $file->getSize();

            // ** Validasi extensi
            $ext = ['jpg', 'jpeg', 'png', 'gif'];
            if(!in_array($extension, $ext)) {
                return response()->json([
                    "status" => 'error',
                    "message" => 'Jenis file tidak didukung'
                ], 500);
            }

            // ** Validasi size
            if($size > 1000000) {
                return response()->json([
                    "status" => 'error',
                    "message" => 'Ukuran maksimal file 1 MB'
                ], 500);
            }
            $user->avatar = $file->hashName();
            $file->storeAs(
                'public/users', $file->hashName()
            );
        }
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'User has been created'
        ], 201);
    }

    public function UpdateUser(Request $req) {
        //** Old Data
        $getOldData = User::where("id", $req->id)->first();

        $validator = Validator::make($req->all(), [
            'name'      => 'required',
<<<<<<< HEAD
            'email'     => 'required|email|unique:users',
            'role'      => ['required',
                function($attribute, $value, $fail) use($getOldData) {
                    // **  Superadmin tidak dapat mengubah rolenya sendiri
                    if(auth()->guard('api')->user()->role == '1') {
                        $fail("Tidak dapat mengubah role");
                    }
                }
            ]
=======
            'email'     => 'required',
            'role'      => 'required'
>>>>>>> 7705e10623724be46b4aec9d478601b0d80a6d7f
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $file = $req->file('avatar');

        $dataToUpdate = [
            "name"     => $req->name,
            "email"    => $req->email,
            "password" => !empty($req->password) ? $req->password : $getOldData->password,
            "role"     => $req->role,
            "avatar"   => str_replace("http://localhost:8000/storage/users/", "", $getOldData->avatar) // Set default avatar from old
        ];

        // ** Jika upload image
        if(!empty($file)) {
            $extension = $file->extension();
            $size = $file->getSize();

            // ** Validasi extensi
            $ext = ['jpg', 'jpeg', 'png', 'gif'];
            if(!in_array($extension, $ext)) {
                return response()->json([
                    "status" => 'error',
                    "message" => 'Jenis file tidak didukung'
                ], 500);
            }

            // ** Validasi size
            if($size > 1000000) {
                return response()->json([
                    "status" => 'error',
                    "message" => 'Ukuran maksimal file 1 MB'
                ], 500);
            }
            $dataToUpdate['avatar'] = $file->hashName();
            $file->storeAs(
                'public/users', $file->hashName()
            );
        }
        
        $update = User::where("id", $req->id)->update($dataToUpdate);
        if($update) {
            return response()->json([
                "success" => true,
                "message" => "User has been updated"
            ], 200);
        }
    }

    public function DeleteUser($id) {
        $role = User::where("id", $id)->first()->role;

        // ** Validasi tidak dapat menghapus super admin
        if($role == '1') {
            return response()->json([
                'success' => false,
                'message' => "Can't Delete Super Admin"
            ]);
        }

        $delete = User::where("id", $id)->delete();
        if($delete) {
            return response()->json([
                "success" => true,
                "message" => "User Has Been Deleted"
            ], 200);
        }
    }
}
