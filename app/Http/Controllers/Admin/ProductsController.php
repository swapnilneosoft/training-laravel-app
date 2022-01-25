<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAssoc;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
            "name" => ["required"],
            "price" => ["required", "numeric"],
            "quantity" => ["required", "numeric"],
            "category_id" => ["required"],
        ]);

        if ($validate) {
            $prod = Product::create([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "category_id" => $request->category_id
            ]);

            if ($prod) {

                if ($request->sub_category_id) {
                    foreach ($request->sub_category_id as $item) {
                        ProductCategory::create([
                            "product_id" => $prod->id,
                            "sub_category_id" => $item
                        ]);
                    }
                }

                if ($request->hasFile("product_images")) {
                    foreach ($request->file("product_images") as $file) {
                        $path = $file->store("upload/product", "public");
                        ProductImage::create([
                            "image_url" => "storage/" . $path,
                            "product_id" => $prod->id
                        ]);
                    }
                }
                if (!empty($request->assoc_name)) {
                    foreach ($request->assoc_name as $index => $value) {
                        if ($value != null) {
                            ProductAssoc::create([
                                "product_id" => $prod->id,
                                "attr_name" => $value,
                                "attr_description" => $request->assoc_dsc[$index]
                            ]);
                        } else {
                            break;
                        }
                    }
                }
                return redirect()->route("product-list")->with("success", "product has been added !");
            }
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
        $prod = Product::find($id);
        return view("admin.pages.product.preview", ["product" => $prod]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod = Product::find($id);
        $cat = Category::all();
        return view("admin.pages.product.edit", ["product" => $prod, 'cat' => $cat]);
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
            "name" => ["required"],
            "price" => ["required", "numeric"],
            "quantity" => ["required", "numeric"],
            "category_id" => ["required"],
        ]);

        if ($validate) {
            $prod = Product::find($id);
            $prod->name  = $request->name;
            $prod->description = $request->description;
            $prod->price = $request->price;
            $prod->quantity = $request->quantity;
            $prod->category_id = $request->category_id;
            if ($prod->update()) {
                if (!empty($request->sub_category_id)) {
                    if (ProductCategory::where("product_id", $prod->id)->delete()) {
                        foreach ($request->sub_category_id as $key => $value) {
                            ProductCategory::create([
                                "product_id" => $prod->id,
                                "sub_category_id" => $value,
                            ]);
                        }
                    }
                }

                if ($request->hasFile("product_images")) {
                    if ($prod->getImages) {
                        foreach ($prod->getImages as $image) {
                            unlink(public_path($image->image_url));
                            $image->delete();
                        }
                    }

                    foreach ($request->file("product_images") as $file) {
                        $path = $file->store("upload/product", "public");
                        ProductImage::create([
                            "image_url" => "storage/" . $path,
                            "product_id" => $prod->id
                        ]);
                    }
                }

                if ($prod->getAssocAttr) {
                    ProductAssoc::where("product_id", $id)->delete();
                }

                if (!empty($request->assoc_name)) {
                    foreach ($request->assoc_name as $index => $value) {
                        if ($value != null) {
                            ProductAssoc::create([
                                "product_id" => $prod->id,
                                "attr_name" => $value,
                                "attr_description" => $request->assoc_dsc[$index]
                            ]);
                        } else {
                            break;
                        }
                    }
                }
            }

            return redirect()->route("product-list")->with("success", "Product has been updated !");
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
        $prod = Product::find($id);

        if ($prod->getImages) {
            foreach ($prod->getImages as $image) {
                unlink(public_path($image->image_url));
                $image->delete();
            }
        }

        if ($prod->getAssocAttr) {
            foreach ($prod->getAssocAttr as $item) {
                $item->delete();
            }
        }
        foreach ($prod->getSubCategories as $item) {
            $item->delete();
        }

        if ($prod->delete()) {
            return redirect()->route("product-list")->with("success", "Product has been deleted !");
        }
        return redirect()->route("product-list")->with("error", "unable to delete product , please try again !");
    }
}
