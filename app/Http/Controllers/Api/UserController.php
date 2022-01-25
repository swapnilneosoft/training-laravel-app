<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = auth()->guard('api')->user();
        $list = [
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "role" => $user->getRole->name,
            "status" => $user->status == 1 ? 'Active' : 'Inactive',
            "address" => $user->getAddress,
        ];

        return response()->json($list, 200);
    }
    public function changePassword(Request $request)
    {
        $validate  = Validator::make($request->all(), [
            "old_password" => ["required"],
            "new_password" => ["required"],
            "confirm_new_password" => ["required", "same:new_password"]
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => [
                $validate->errors()->first("old_password"),
                $validate->errors()->first("new_password"),
                $validate->errors()->first("confirm_new_password "),
            ], "status" => 403]);
        }
        $user = User::find(auth()->guard('api')->user()->id);
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(["message" => "Old password does not match", "status" => 403]);
        }
        if (Hash::check($request->input('new_password'), $user->password)) {

            return response()->json(["message" => "Password already exist , please enter different password", "status" => 403]);
        }
        $user->password = Hash::make($request->input('new_password'));
        if ($user->update()) {
            return response()->json(["message" => "Password changed !", "status" => 200]);
        }
        return response()->json(["message" => "unable to change the password !", "status" => 500]);
    }
}
