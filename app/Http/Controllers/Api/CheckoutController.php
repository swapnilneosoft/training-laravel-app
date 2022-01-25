<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function getCheckoutProducts(Request $request)
    {
        $list = [];
        foreach ($request->id as $key => $item) {
            $product = Product::find($item);
            $image = [];
            if ($product->getImages) {
                foreach ($product->getImages as $item) {
                    $image[] = [
                        "image" => asset(($item->image_url))
                    ];
                }
            }
            $list[] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $request->quantity[$key],
                "image" => $image
            ];
        }

        return response()->json([$list]);
    }

    public function applyCoupon(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "code" => "required",
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => "code field is required !", "status" => 401]);
        }
        try {
            $coupon = Coupon::where("code", $request->code)->where("status", 1)->get()->first();
            if ($coupon) {
                if ($coupon->quantity > 0 && $coupon->quantity != '') {
                    $coupon->quantity -= 1;
                    $coupon->update();
                }
                return response()->json(["message" => "valid coupon !", "coupon" => $coupon, "status" => 200]);
            }
            return response()->json(["message" => "Coupon not found", "status" => 401]);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage(), "status" => 500]);
        }
    }
}
