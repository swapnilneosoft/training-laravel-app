<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserOrderMail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UsedCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getUserOrder()
    {
        $user = auth()->guard('api')->user();
        $order = Order::where("user_id", $user->id)->get();
        $list = [];
        foreach ($order as $item) {
            $orderProducts = null;
            $ordProd = OrderProduct::where("order_id", $item->id)->get();
            foreach ($ordProd as $i) {
                $orderProducts[] = [
                    "product" => $i->getProduct
                ];
            }

            $list[] = [
                "order_id" => $item->id,
                "user_id" => $item->user_id,
                "amount" => $item->amount,
                "payment_mode" => $item->payment_mode,
                "payment_status" => $item->payment_status,
                "payment_id" => $item->payment_id,
                "transaction_id" => $item->transaction_id,
                "coupon_used" => $item->coupon_used == 1 ? true : false,
                "order_status" => $item->status == 0 ? "Processing" : ($item->status == 1 ? 'Dispatched' : 'Delivered'), //going to add order_status table one to many
                "products" => $orderProducts
            ];
        }
        return response()->json($list);
    }
    public function placeOrder(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "address_id" => ["required"],
            "payment_mode" => ["required"],
            "products" => ["required"],
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => $validate->errors(), "status" => 401]);
        }
        $user = auth()->guard('api')->user();
        $total_amount = 0;
        $final_amount = 0;

        try {
            $order = Order::create([
                "user_id" => $user->id,
                "address_id" => $request->address_id,
                "payment_mode" => $request->payment_mode,
            ]);

            foreach ($request->products as $item) {

                $product = Product::find($item['id']);
                $prod = OrderProduct::create([
                    "order_id" => $order->id,
                    "product_id" => $product->id,
                    "total_price" => $product->price * $item['quantity']
                ]);

                $total_amount += $prod->total_price;
            }

            // Checking if there any shipping charges or not
            if ($total_amount < 500) {
                $total_amount += 50;
            }


            if ($request->coupon['id'] != '' && $request->coupon['response']) {

                $coupon = Coupon::find($request->coupon['id']);
                if ($coupon->percentage == 1) {
                    $percentage_amt = ($coupon->discount / 100) *  $total_amount;
                    $final_amount = $total_amount - $percentage_amt;
                } else {
                    $final_amount = $total_amount - $coupon->discount;
                }
                UsedCoupon::create([
                    "coupon_id" => $request->coupon['id'],
                    "user_id" => $user->id,
                    "order_id" => $order->id,
                    "discounted_price" => $coupon->discount,
                ]);
                $order->coupon_used = 1;
            } else {
                $final_amount = $total_amount;
            }
            $order->amount = $final_amount < 0 ? 0 : $final_amount;
            $order->update();
            // Mail::to($request->user())->send(new MailableClass);
            Mail::to($user->email)
                ->cc("admin@shoponline.com")
                ->send(new UserOrderMail($order));
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage(), "status" => 500]);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "status" => 500]);
        }
        return response()->json(["message" => "order created !", "order" => $order, "status" => 200]);
    }

    public function getOrderDetails(Request $request)
    {
        // return response()->json($request->all());
        $validate = Validator::make($request->all(), [
            "id" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => "invalid operation . Please select the order !", "status" => 403]);
        }
        $order = Order::find($request->id);
        if ($order->payment_status == 1) {
            return response()->json(["message" => "Payment has done already ", "status" => 403]);
        }
        return response()->json(["order" => $order, "status" => 200]);
    }
    public function confirmPayment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "order_id" => "required",
            "payment_id" => "required",
        ]);

        if ($validate->fails()) {
            return response()->json(["message" => "Invalid operation ", "status" => 403]);
        }

        $order = Order::find($request->order_id);
        $order->payment_status =  1;
        $order->payment_mode =  1;
        $order->transaction_id = $request->payment_id;
        if ($order->update()) {
            return response()->json(["message" => "Payment Success !", "status" => 200]);
        }
        return response()->json(["message"=>"Unabele to catch payment","status"=>403]);
    }
}
