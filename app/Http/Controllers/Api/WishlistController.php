<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->guard('api')->user();
        $list = [];
        foreach ($user->getWishlist  as $wish) {
            $product = Product::find($wish->product_id);
            $list[] = [
                "products" => $product
            ];
        }

        return response()->json(["message" => "Success", "status" => 200, "list" => $list]);
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
        $validate = Validator::make($request->all(), [
            "id" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => "Product id is required", "status" => 402]);
        }

        try {
            $user = auth()->guard('api')->user()->id;
            $list = Wishlist::where("product_id", $request->id)->where("user_id", $user)->get();
            if (count($list) > 0) {
                return response()->json(["message" => "product already exist in wishlist", "list" => $list, "status" => 403]);
            }
            $wish = Wishlist::create([
                'user_id' => $user,
                "product_id" => $request->id
            ]);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage(), "status" => 403]);
        }
        return response()->json(["message" => "Product has been added in wishlist !", "status" => 200, "list" => $wish]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "id" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json(["message" => "Product id is required", "status" => 402]);
        }
        try {
            $user = auth()->guard('api')->user()->id;
            // $wish = Wishlist::where("product_id", $request->id)->where("user_id", $user)->delete();
            if(Wishlist::where("product_id", $request->id)->where("user_id", $user)->delete())
            {
                return response()->json(["message" => "Product removed !", "status" => 200]);
            }
        } catch (\Exception $th) {
            return response()->json(["message" => $th->getMessage(), "status" => 403]);
        }
        return response()->json(["message" => "Product not found !", "status" => 403]);
    }
}
