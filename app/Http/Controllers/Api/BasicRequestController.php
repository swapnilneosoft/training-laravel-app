<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasicRequestController extends Controller
{
    public function init()
    {
        $bannerList = [];
        $categoryList = [];
        $productList = [];
        $banner = Banner::where("status", 1)->get();
        foreach ($banner as $key => $value) {
            $bannerList[] = [
                "image" => config('app.url') . $value->image_url,
                "description"=>$value->caption
            ];
        }

        $category = Category::all();
        foreach ($category as $key => $value) {
            $categoryList[] = [
                "category_id" => $value->id,
                "category_name" => $value->name,
                "sub_categories" => $value->getSubCategory
            ];
        }
        $product = Product::where('quantity', '>', '0')->offset(0)->limit(11)->get();
        foreach ($product as $key => $value) {
            $image = [];
            foreach ($value->getImages as $key => $val) {
                $image[] = [
                   asset($val->image_url)
                ];
            }
            $productList[] = [
                "id" => $value->id,
                "name" => $value->name,
                "description" => $value->description,
                "quantity" => $value->quantity,
                "category" => $value->getCategory->name,
                "price" => $value->price,
                "images" => $image
            ];
        }
        $list = [
            "banner" => $bannerList,
            "product" => $productList,
            "category" => $categoryList
        ];

        return response()->json($list, 200);
    }
    public function getBannerList()
    {
    }

    public function addFeedback(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "query" => "required"
        ]);


        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $contact = Contact::create([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "subject" => $request->input('subject'),
            "query" => $request->input('query')
        ]);
        if ($contact) {
            return response()->json(["message" => "Feedback Submitted successfully !"], 200);
        }
        return response()->json(["message" => "Unable to submit feedback !"], 500);
    }
}
