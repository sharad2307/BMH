<?php

namespace App\Http\Controllers;

use App\GirlsHostel;
use Illuminate\Http\Request;

class GirlsHostelController extends Controller
{
    public function select_roommates(Request $request)
    {

        $user = User::find($request->id);

        if(User::whereIn('year',[1,2])){
            $roommates=User::where('year','=',$user->year)->where('hostel', $user->hostel)->where('id' , '<>' ,$request->id )->select('name' ,'username')->get();
            return $roommates;
        }
        
    }
}
