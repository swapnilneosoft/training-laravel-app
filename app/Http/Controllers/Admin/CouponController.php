<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "percentage" => ["required"],
            "discount" => ["required"],

        ]);
        if ($validate) {
            if ($request->percentage == 1 && $request->discount > 100) {
                return redirect()->back()->with("error", "You have selected percenatge option u need to enter discount value less than 100 !");
            }
            $cop = Coupon::create([
                "code" => $request->code ? strtoupper($request->code) : $this->generateCode(),
                "quantity" => $request->quantity,
                "percentage" => $request->percentage == 1 ? 1 : 0,
                "discount" => $request->discount,
                "status" => $request->status,
                "max_disc" => $request->max_disc
            ]);

            if ($cop) {
                return redirect()->route("coupon-list")->with("success", "Coupon has been added !");
            }
            return redirect()->route("coupon-list")->with("error", "Unable to add coupon ! ");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cop = Coupon::find($id);

        return view("admin.pages.coupon.edit", ["coupon" => $cop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            "code" => ["required"],
            "percentage" => ["required"],
            "discount" => ["required"],

        ]);
        if ($validate) {
            if ($request->percentage == 1 && $request->discount > 100) {
                return redirect()->back()->with("error", "You have selected percenatge option u need to enter discount value less than 100 !");
            }
            $cop = Coupon::find($id);
            $cop->code = strtoupper($request->code);
            $cop->quantity = $request->quantity;
            $cop->percentage = $request->percentage;
            $cop->discount = $request->discount;
            $cop->status = $request->status;
            $cop->max_disc = $request->max_disc;


            if ($cop->update()) {
                return redirect()->route("coupon-list")->with("success", "Coupon has been updated !");
            }
            return redirect()->route("coupon-list")->with("error", "Unable to Update coupon ! ");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Coupon::find($id)->delete()) {
            return redirect()->route("coupon-list")->with("success", "Coupon has been deleted !");
        }
        return redirect()->route("coupon-list")->with("error", "Unable to delete the Coupon , please try again !");
    }
    protected function generateCode()
    {
        $code  = rand(1111, 9999) . '-' . strtoupper(Str::random(4)) . '-' . rand(1111, 9999);
        while (DB::select("SELECT * FROM coupons WHERE code = '$code'")) {
            $code  = rand(1111, 9999) . '-' . strtoupper(Str::random(4)) . '-' . rand(1111, 9999);
        }
        return $code;
    }

    public function statusManage($id)
    {
        $cop = Coupon::find($id);
        $cop->status  = !$cop->status;
        $cop->update();

        return redirect()->route("coupon-list")->with("success", "Status has been changed !");
    }
}
