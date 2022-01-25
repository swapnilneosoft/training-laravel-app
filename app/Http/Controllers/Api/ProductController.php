<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validate =  Validator::make($request->all(), [
            "product_id" => "required",
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $product = Product::find($request->product_id);
        $list = [];
        $images = [];
        foreach ($product->getImages as $image) {
            $images[] = [
                asset($image->image_url)
            ];
        }
        $list = [
            "id" => $product->id,
            "name" => $product->name,
            "description" => $product->description,
            "price" => $product->price,
            "quantity" => $product->quantity,
            "images" => $images,
            "assoc_attributes" => $product->getAssocAttr,
            "category" => $product->getCategory->name,
        ];
        return response()->json($list, 200);
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
    public function destroy($id)
    {
        //
    }

    public function getCategoryWiseProduct(Request $request)
    {

        $list = [];
        if ($request->sub_category_id) {
            $product = ProductCategory::where('sub_category_id', $request->sub_category_id)->get();
            // $product = DB::select("SELECT prod.product_id AS product_id FROM  product_categories prod,sub_categories sub WHERE prod.sub_category_id = sub.id AND prod.sub_category_id = ?",[$request->sub_category_id]);
            foreach ($product as $value) {
                $prod = Product::find($value->product_id);

                $images = [];
                foreach ($prod->getImages as $image) {
                    $images[] = [
                        asset($image->image_url)
                    ];
                }
                $list[] = [
                    "id" => $prod->id,
                    "name" => $prod->name,
                    "description" => $prod->description,
                    "price" => $prod->price,
                    "quantity" => $prod->quantity,
                    "images" => $images,
                    "assoc_attributes" => $prod->getAssocAttr,

                ];
            }
            return response()->json($list);
        }

        $product = Product::where('category_id', $request->category_id)->get();
        foreach ($product as $value) {
            $images = [];
            foreach ($value->getImages as $image) {
                $images[] = [
                    asset($image->image_url)
                ];
            }
            $list[] = [
                "id" => $value->id,
                "name" => $value->name,
                "description" => $value->description,
                "price" => $value->price,
                "quantity" => $value->quantity,
                "images" => $images,
                "assoc_attributes" => $value->getAssocAttr,
            ];
        }
        return response()->json($list);
    }
    public function getAllProducts()
    {
        $product = Product::all();
        $list = [];
        $images = [];
        foreach ($product as $item) {
            foreach ($item->getImages as $image) {
                $images[] = [
                    asset($image->image_url)
                ];
            }
            $list[] = [
                "id" => $item->id,
                "name" => $item->name,
                "description" => $item->description,
                "price" => $item->price,
                "quantity" => $item->quantity,
                "images" => $images,
                "assoc_attributes" => $item->getAssocAttr,
            ];
        }
         return response()->json($list,200);
    }
}
