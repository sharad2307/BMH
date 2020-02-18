<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckResultsController extends Controller
{
   public function checkdata(Request $request)
    {
    	dd($request);
    	dd("hello");
    	$a=$request->all();
    	$data = json_decode($a);
    	dd($data);
    }

}
