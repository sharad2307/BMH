<?php
namespace App\Http\Controllers\Boys\Ish;
use App\Http\Controllers\Controller;
use App\User;


use App\Ish;
use Illuminate\Http\Request;

class IshController extends Controller
{
    public function select_roommates(Request $request)
   {
    $user = User::find($request->id);

    $roommates=User::where('year','=',$user->year)->where('hostel', $user->hostel)->where('id' , '<>' ,$request->id )->select('name' ,'username')->get();
    return $roommates;
   }
}
