<?php


namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CheckResultsController extends Controller
{
   public function checkdata(Request $request)
    {
    	
    	
    	//dd($request);
    	// $a=$request;
    	// $data = json_decode($a,true);
    	dd(json_decode($request->getContent(), true));
    	dd($data);
    }

}
