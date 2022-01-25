<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function store(Request $request)
    {
        $validate = $request->validate([
            "image" => "required|mimes:jpeg,png,jpg,gif,svg",
            "status" => "required",
        ]);
        if ($validate) {
            $path = $request->image->store("upload/banner", "public");
            $image = Banner::create([
                'image_url' => "storage/" . $path,
                'caption' => $request->caption,
                'status' => $request->status
            ]);
            if ($image) {
                return redirect()->route("banner-list")->with("success", "Banner has been added !");
            }
            return back()->with("error", "unable to add banner please try again !");
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
        $banner = Banner::find($id);
        return view("admin.pages.banner.edit", ['banner' => $banner]);
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
            "status" => ['required'],
        ]);
        if ($validate) {
            $banner = Banner::find($id);
            $banner->status = $request->status;
            $banner->caption = $request->caption;
            if ($request->hasFile('image')) {
                $path = $request->image->store("upload/banner", "public");
                if (unlink(public_path($banner->image_url))) {
                    $banner->image_url = "storage/" . $path;
                }
            }
            if ($banner->update()) {
                return redirect()->route("banner-list")->with("success", "Banner has been updated !");
            }
            return redirect()->route("banner-list")->with("error", "Unable to update banner !");
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
        $banner = Banner::find($id);

        if (unlink(public_path($banner->image_url)) && $banner->delete()) {
            return redirect()->route("banner-list")->with("success", "Banner has been deleted !");
        }
        return redirect()->route("banner-list")->with("error", "Unable to delete banner please try again !");
    }
    public function statusManage($id)
    {
        $banner = Banner::find($id);
        $banner->status = $banner->status == 1 ? 0 : 1;
        if ($banner->update()) {
            return redirect()->route("banner-list")->with("success", "Status has been updated !");
        }
        return redirect()->route("banner-list")->with("error", "Unable to update status !");
    }
    public function imagePreview($id)
    {
        $banner = Banner::find($id);
        return view('admin.pages.banner.image-preview',["banner"=>$banner]);
    }
}
