<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function getAllOrders()
    {
        $orders = Order::orderby('id', 'desc')->paginate(50);
        return view("admin.pages.order.list", ["orders" => $orders]);
    }

    public function getPendingOrders()
    {
        $orders = Order::where("status", 0)->orwhere("status", 1)->orderby('id', 'desc')->paginate(50);
        return view("admin.pages.order.pending", ["orders" => $orders]);
    }
    public function getDeliveredOrders()
    {
        $orders = Order::where("status", 2)->orderby("id", "desc")->paginate(50);
        return view("admin.pages.order.delivered", ["orders" => $orders]);
    }

    public function orderPreview($id)
    {
        $order = Order::find($id);
        return view("admin.pages.order.preview", ["order" => $order]);
    }
    public function statusManage(Request $request)
    {
        $validate = $request->validate([
            "status" => "required",
            "order" => "required"
        ]);

        if ($validate) {
            $ord = Order::find($request->order);
            $ord->status = $request->status;
            if ($ord->update()) {
                Mail::to($ord->getUser->email)
                    ->send(new OrderStatus($ord));
                return back()->with("success", "Status updated !");
            }
            return back()->with("error", "Unable to update");
        }
    }
    public function searchAllOrders($q)
    {
        $orders = Order::where('id', 'like', "$q")->get();
        $list = [];
        foreach ($orders as $item) {
            $list[] = [
                'id' => $item->id,
                'user' => $item->getUser->email,
                'amount' => $item->amount,
                'payment_mode' => $item->payment_mode == 1 ? 'Online' : 'COD',
                'payment_status' => $item->payment_status == 1 ? 'Paid' : 'Unpaid',
                'order_status' => $item->status == 0 ? ' Processing' : ($item->status == 1 ? 'Dispatched' : 'Delivered'),
            ];
        }
        return response()->json($list);
    }
    public function searchPendingOrders($q)
    {
        $orders = Order::where('id', 'like', "$q")->where('status', '!=', '2')->get();
        $list = [];
        foreach ($orders as $item) {
            $list[] = [
                'id' => $item->id,
                'user' => $item->getUser->email,
                'amount' => $item->amount,
                'payment_mode' => $item->payment_mode == 1 ? 'Online' : 'COD',
                'payment_status' => $item->payment_status == 1 ? 'Paid' : 'Unpaid',
                'order_status' => $item->status == 0 ? ' Processing' : ($item->status == 1 ? 'Dispatched' : 'Delivered'),
            ];
        }
        return response()->json($list);
    }
    public function searchDeliveredOrders($q)
    {
        $orders = Order::where('id', 'like', "$q")->where('status', '2')->get();
        $list = [];
        foreach ($orders as $item) {
            $list[] = [
                'id' => $item->id,
                'user' => $item->getUser->email,
                'amount' => $item->amount,
                'payment_mode' => $item->payment_mode == 1 ? 'Online' : 'COD',
                'payment_status' => $item->payment_status == 1 ? 'Paid' : 'Unpaid',
                'order_status' => $item->status == 0 ? ' Processing' : ($item->status == 1 ? 'Dispatched' : 'Delivered'),
            ];
        }
        return response()->json($list);
    }
}
