<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAllOrders()
    {
        $orders = Order::orderby('id', 'desc')->paginate(50);
        return view("admin.pages.order.list",["orders"=>$orders]);
    }

    public function getPendingOrders()
    {
        $orders = Order::where("status", 0)->orwhere("status", 1)->orderby('id', 'desc')->paginate(50);
        return view("admin.pages.order.pending",["orders"=>$orders]);

    }
    public function getDeliveredOrders()
    {
        $orders = Order::where("status", 2)->orderby("id", "desc")->paginate(50);
        return view("admin.pages.order.delivered",["orders"=>$orders]);

    }

    public function orderPreview($id)
    {
        $order = Order::find($id);
        return view("admin.pages.order.preview",["order"=>$order]);
    }
    public function statusManage(Request $request)
    {
        $validate = $request->validate([
            "status"=>"required",
            "order"=>"required"
        ]);

        if($validate)
        {
            $ord = Order::find($request->order);
            $ord->status = $request->status;
            if($ord->update())
            {
                return back()->with("success","Status updated !");
            }
            return back()->with("error","Unable to update");
        }
    }
}
