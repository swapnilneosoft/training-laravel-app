<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Admin Side bar link controller
    public function index()
    {
        return view("admin.pages.dashboard");
    }

    public function getUserList()
    {
        $user = User::paginate(10);
        return view("admin.pages.user.list", ["users" => $user]);
    }

    public function getAddUser()
    {
        $roles = Role::all();
        return view("admin.pages.user.add", ['roles' => $roles]);
    }


    public function getBannerList()
    {
        $banner = Banner::paginate(10);
        return view("admin.pages.banner.list", ["banners" => $banner]);
    }
    public function getAddBanner()
    {
        return view("admin.pages.banner.add");
    }

    public function getCategoryList()
    {
        $cat = Category::paginate(10);
        return view("admin.pages.category.list", ['categories' => $cat]);
    }

    public function getSubCategoryList()
    {
        $list = SubCategory::paginate(2);
        $cat  = Category::all();
        return view("admin.pages.sub-category.list", ['list' => $list,'cat'=>$cat]);
    }

    public function getProductList()
    {
        $prod = Product::paginate(100);
        return view("admin.pages.product.list",['products'=>$prod]);
    }
    public function getAddProduct()
    {
        $cat = Category::all();
        return view("admin.pages.product.add",['cat'=>$cat]);
    }

    public function getCouponList()
    {
        $cop = Coupon::paginate(5);
        return view("admin.pages.coupon.list",["coupon"=>$cop]);
    }
    public function getAddCouponList()
    {
        return view("admin.pages.coupon.add");
    }

    public function getContactList()
    {
        $con = Contact::orderby('status','desc')->paginate(10);
        return view("admin.pages.contact.list",["contact"=>$con]);
    }

    // admin side bar link ends -->


}
