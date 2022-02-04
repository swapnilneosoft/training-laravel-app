<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Configuration::all();
        return view("admin.pages.config.list",['config'=>$config]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "title"=>["required","unique:configurations,title"],
            "value"=>["required"]
        ]);
        if($validate)
        {
            $config = Configuration::create([
                'title'=>$request->input('title'),
                'value'=>$request->input('value'),
            ]);
            if($config)
            {
                return redirect()->back()->with('success','Configuration has been added !');
            }
            return redirect()->back()->with('error','Having interna server error please try again');

        }
    }
}
