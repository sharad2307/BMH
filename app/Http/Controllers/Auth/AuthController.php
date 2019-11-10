<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){

    }

    public function login(Request $request){
    	$loginData = $request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	if(!auth()->attempt($loginData)){
    		
    	}
    }
}
