<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
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
            "name" => ["required", "unique:categories,name"]
        ]);
        if ($validate) {
            $cat = Category::create([
                "name" => ucfirst($request->name)
            ]);
            if ($cat) {
                return redirect()->route('category-list')->with('success', 'Category has been added');
            }
            return redirect()->route('category-list')->with('error', 'unable to Category please try again ');
        }
    }



    public function edit($id)
    {

        $cat = Category::find($id);
        return view("admin.pages.category.edit", ['category' => $cat]);
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
            "name" => ["required", Rule::unique('categories')->ignore($id)]
        ]);
        if ($validate) {
            $cat = Category::find($id);
            $cat->name = ucfirst($request->name);
            if ($cat->update()) {
                return redirect()->route('category-list')->with("success", "Category has been updated !");
            }
            return back()->with("error", "Unable to update the category , please try again !");
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
        if (Category::find($id)->delete()) {
            return redirect()->route('category-list')->with("error", "Category has been deleted !");
        }
        return redirect()->route('category-list')->with("error", "Unable to delete category !");
    }

    public function search($q)
    {
        $categories = Category::where("name", "like", "%$q%")->get();


        $list = [];
        foreach ($categories as $category) {
            $list[] = [
                "id" => $category->id,
                "name" => $category->name,
            ];
        }

        return response()->json($list, 200);
    }
    public function getSubcategoriesById($id)
    {
        $sub = SubCategory::where("category_id",$id)->get();
        $list = [];
        foreach ($sub as $subcat) {
            $list[] = [
                "id" => $subcat->id,
                "name" => $subcat->name,
                "category_id"=>$subcat->category_id
            ];
        }
        return response()->json($list,200);

    }
}
