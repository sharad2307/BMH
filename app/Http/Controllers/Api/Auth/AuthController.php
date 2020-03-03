<?php

namespace App\Http\Controllers\Api\Auth;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Request;
use App\User;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Validator;
use Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
	public function register(Request $request){
		$this->validate(request(), [
			'email' => 'required|string|email|max:255|unique:users',
			'mobile_number' => 'required|max:10',
			'roll_number' =>'required|max:11|unique:users',
			'year'=>'required',
			'gender'=>'required',
			'is_hosteler'=>'required',
			'hostel'=>'required',
			'result_url' => 'required'
		]);

		$header = $request->header('Authorization');
		
		$user = User::find($request->id);
		//dd($user);
		if($header== $user->access_token)
		{
			$user->email = $request->email;
			$user->mobile_number = $request->mobile_number;
			$user->roll_number = $request->roll_number;
			$user->year = $request->year;
			$user->gender = $request->gender;
			$user->is_hosteler = $request->is_hosteler;
			$user->hostel =$request->hostel;
			$user->result_url =$request->result_url;

			$user->save();
			return response(['message'=>'Data saved successfully' , 'accessToken' => $user->access_token ,
				'id'=>$user->id,
			]);
		}
		else
			return response(['message'=>'token does not match']);

	}


	
	

	public function login(Request $request){ 
		$validatedData = $request->validate([
			// 'username' => 'required',
			'password' => 'required',
		]);
		$user = User::where('username', $request->username)->where('password', $request->password)->first();
		
		if(isset($user) ){
			if($user->type=='admin')
			{
				$accessToken = $user->access_token;
			//dd($accessToken);
				return response(['message'=>'its admin user','access_token'=>$accessToken,
					'id'=>$user->id,]);
			} 
			// $user = Auth::user();  
				$accessToken = $user->access_token;
			//dd($accessToken);
				return response(['message'=>'old user','access_token'=>$accessToken,
					'id'=>$user->id,

				]);
			} 
			else{ 

				$url= 'http://192.168.0.8:8082/api/profiles/login/';
			// dd($url);
				$postData = [
					'username' => $request->input('username'),
					'password' => $request->input('password'),
				];

				$ch = curl_init();
				curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postData
				));

	        //Ignore SSL certificate verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_FAILONERROR, 1);

			        //get response
				$output = curl_exec($ch);
			 // dd($output);
			// return json_encode($output);        
			        //Print error if any
			//dd(curl_error($ch));
				if (curl_errno($ch)) {
					echo 'error:' . curl_error($ch);
				}

				curl_close($ch);
			// dd($ch);

				$arr = json_decode($output, true);
			if(!empty($arr))
				{if (array_key_exists('username', $arr)) {
					$user = new User;
					$user->name = $arr['first_name'];
					$user->username = $arr['username'];
					$user->password = $request->password;
				//dd($user);


					$accessToken = $user->createToken('authToken');
					$accessToken = $accessToken->accessToken;
					$user->access_token=$accessToken;
				//dd($accessToken);
					$user->save();
				// dd($user);
					return response(['message'=>'new user',
						'access_token'=>$user->access_token ,
						'id'=>$user->id,

					]);



				}
			}
				else{
					return response(['message' => 'Invalid Credentials']);
				}



			} 	
		}
	}