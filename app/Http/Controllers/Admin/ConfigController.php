<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Configuration::all();
        return view("admin.pages.config.list", ['config' => $config]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "title" => ["required", "unique:configurations,title"],
            "value" => ["required"]
        ]);
        if ($validate) {
            $config = Configuration::create([
                'title' => $request->input('title'),
                'value' => $request->input('value'),
            ]);
            if ($config) {
                return redirect()->back()->with('success', 'Configuration has been added !');
            }
            return redirect()->back()->with('error', 'Having interna server error please try again');
        }
    }

    public function show($id)
    {
        $conf = Configuration::find($id);

        return view('admin.pages.config.edit', ['config' => $conf]);
    }

    public function update(Request $req, $id)
    {
        $validate = $req->validate([
            'title' => ["required", Rule::unique('configurations', 'title')->ignore($id)],
            "value" => ["required"]
        ]);
        if ($validate) {
            $config = Configuration::find($req->id);
            $config->title = $req->title;
            $config->value = $req->value;
            if ($config->update()) {
                return redirect()->route('config-list')->with("success", "Configuration has been updated");
            }
            return redirect()->back()->with("error", "Internal server error . please try again !");
        }
    }
}
