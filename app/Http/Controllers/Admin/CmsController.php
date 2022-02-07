<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms = Cms::all();
        return view('admin.pages.cms.list', ['cms' => $cms]);
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
            "title" => ["required", "unique:cms,title"],
            "description" => ["required"]
        ]);
        if ($validate) {
            $config = Cms::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);
            if ($config) {
                return redirect()->back()->with('success', 'CMS has been added !');
            }
            return redirect()->back()->with('error', 'Having interna server error please try again');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cms = Cms::find($id);
        return view('admin.pages.cms.edit', ['cms' => $cms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validate = $req->validate([
            'title' => ["required", Rule::unique('cms', 'title')->ignore($id)],
            "description" => ["required"]
        ]);
        if ($validate) {
            $cms = Cms::find($req->id);
            $cms->title = $req->title;
            $cms->description = $req->description;
            if ($cms->update()) {
                return redirect()->route('cms-list')->with("success", "CMS   has been updated");
            }
            return redirect()->back()->with("error", "Internal server error . please try again !");
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
        //
    }
}
