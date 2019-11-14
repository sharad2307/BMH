<?php
namespace App\Http\Controllers\Boys\BoysHostel;
use App\Http\Controllers\Controller;


use App\BoysHostel;
use Illuminate\Http\Request;

class BoysHostelController extends Controller
{
   public function select_roommates(Request $request)
   {
    $user = User::find($request->id);
    $roommates=User::where('year', $user->year)->where(['hostel', '=', 'bh']);
    dd($roommates);
   }
   
}
