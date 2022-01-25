<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => ["required", "email"],
            'password' => ["required"]
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }

        if (!$token = auth()->guard("api")->attempt(["email" => $request->email, "password" => $request->password, "status" => 1])) {
            return response()->json(["error" => "Invalida email and password  or blocked by the admin"], 401);
        }
        $user = auth()->guard('api')->user();
        if (auth()->guard('api')->user()->role_id == User::Roles['Admin'] || auth()->guard('api')->user()->role_id == User::Roles['SuperAdmin']) {
            auth()->guard('api')->logout();
            return response()->json(["message" => "You are unauthorized to login", "status" => 401], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => ["required", "email", "unique:users,email"],
            'password' => ["required"],
            "confirm_password" => ["required", "same:password"],
            "firstname" => ["required"],
            "lastname" => ["required"],
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }

        try {
            $user = User::create([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "role_id" => User::Roles['Customer'],
            ]);
            if ($user) {
                $user = [
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->email,
                    "role" => $user->getRole->name,
                    "status" => 'Active'
                ];
                return response()->json(["user" => $user], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage(), "message" => "error"]);
        }
    }

    public function logout(Request $request)
    {
        auth()->guard("api")->logout();

        return response()->json(['message' => 'User successfully logged out.'], 200);
    }

    protected function respondWithToken($token, $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60,
            "user" => $user
        ]);
    }
}
