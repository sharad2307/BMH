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
    	$obj=json_decode($request->getContent(), true);
    	//dd($obj);
    	//print_r($obj); 
    	// echo $obj['details']['Name'];
    	// echo $obj['details']['RollNo'];
    	// echo "\n";
    	//echo $obj['result']['SessionType'];
    	//echo count($obj['result']);
    		$a=array();

    	for($i=0; $i<sizeof($obj['result']); $i++) 
    	{
    		// dd(sizeof($obj['result'][$i]['COP']));
    			if(!empty($obj['result'][$i]['COP']))
				{
					$c=sizeof($obj['result'][$i]['COP']);
    					for($j=0;$j<$c;$j++)
    					{
    				
    						array_push($a,$obj['result'][$i]['COP'][$j]);
    					}
    			}


		}
		if(!empty($a)){
			$subjects= sizeof(array_unique($a));
			//echo $subjects;
			if($subjects>2)
				 return response()->json([
        "message" => "student not allowed"
    ], 200);
				else
					 return response()->json([
        "message" => "student allowed"
    ], 200);
		}
		else
			 return response()->json([
        "message" => "student allowed"
    ], 200);
    	
    }

}
