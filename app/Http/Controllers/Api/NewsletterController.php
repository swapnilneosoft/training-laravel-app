<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Newsletter;

class NewsletterController extends Controller
{
    public function subcsribe(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email'=>['required','email']
        ]);
        if($validate->fails())
        {
            return response()->json([$validate->errors(),'status'=>403]);
        }
        if ( ! NewsLetter::isSubscribed($request->email) )
        {
            Newsletter::subscribePending($request->email);
           return response()->json(['message'=>"Subscribed !",'status'=>200]);
        }
        return response()->json(['message'=>"Already registred !",'status'=>200]);


    }
}
