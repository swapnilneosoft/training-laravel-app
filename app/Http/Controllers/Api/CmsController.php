<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function getAbout()
    {
        $cms = Cms::get()->where('title', 'about')->first();
        if ($cms) {
            return response()->json(['data' => $cms->description, 'status' => 200]);
        }
        return response()->json(['data' => '', 'message' => 'About not found !', 'status' => 404]);
    }

    public function getTerms()
    {
        $terms = Cms::get()->where('title', 'terms')->first();
        if ($terms) {
            return response()->json(['data' => $terms->description, 'status' => 200]);
        }
        return response()->json(['data' => '', 'message' => 'Terms not found !', 'status' => 404]);
    }
    public function getPolicy()
    {
        $policy = Cms::get()->where('title', 'policy')->first();
        if ($policy) {
            return response()->json(['policy' => $policy->description, 'status' => 200]);
        }
        return response()->json(['data' => '', 'message' => 'Terms not found !', 'status' => 404]);
    }
}
