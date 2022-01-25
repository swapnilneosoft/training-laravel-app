<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class UserAddressController extends Controller
{
    public function addAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "fullname" => "required",
            "address" => "required",
            "state" => "required",
            "city" => "required",
            "pincode" => "required",
            "mobile_no" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json(["status" => "401", "message" => $validate->errors()]);
        }
        $address =    UserAddress::create([
            "user_id" => auth()->guard('api')->user()->id,
            "fullname" => $request->fullname,
            "address" => $request->address,
            "state" => $request->state,
            "city" => $request->city,
            "pincode" => $request->pincode,
            "mobile_no" => $request->mobile_no
        ]);

        if ($address) {
            return response()->json(["message" => "Address has been added", "status" => 200]);
        }
        return response()->json(["message" => "unable to add , please tray again", "status" => 401]);
    }
}
