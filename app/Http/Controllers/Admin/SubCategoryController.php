<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => ["required", "unique:sub_categories,name"],
            "category_id" => ['required']
        ]);

        if ($validate) {
            $sub = SubCategory::create([
                'name' => ucfirst($request->name),
                "category_id" => $request->category_id
            ]);
            if ($sub) {
                return redirect()->route("sub-category-list")->with("succes", "Sub category added !");
            }
            return redirect()->route("sub-category-list")->with("error", "Unable to add sub category !");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::all();
        $sub = SubCategory::find($id);
        return view("admin.pages.sub-category.edit", ["cat" => $cat, "sub" => $sub]);
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
            "name" => ["required", Rule::unique("sub_categories")->ignore($id)],
            "category_id" => ["required"]
        ]);
        if ($validate) {
            $sub = SubCategory::find($id);
            $sub->name = ucfirst($request->name);
            $sub->category_id = $request->category_id;
            if ($sub->update()) {
                return redirect()->route("sub-category-list")->with("success", "category has been updated !");
            }
            return redirect()->route("sub-category-list")->with("error", "category not updated ,  please try again !");
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
        if (SubCategory::find($id)->delete()) {
            return redirect()->route('sub-category-list')->with("success", "Sub category has been deleted !");
        }
        return redirect()->route('sub-category-list')->with("error", "Sub category not deleted please try again !");
    }

    
}
