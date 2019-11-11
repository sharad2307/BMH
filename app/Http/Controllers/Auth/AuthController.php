<?php

namespace App\Http\Controllers\Auth;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AuthController extends Controller
{
	// // public function register(Request $request){

	// // }

	 public function username()
    {
        return 'username';
    }

	public function login(Request $request){ 
		$validatedData = $request->validate([
			'username' => 'required',
			'password' => 'required',
		]);
		$user = User::where('username', $request->username)->where('password', $request->password)->first();
		// dd($validatedData);
		// dd(Auth::login($user));
		if(isset($user) && $user->roll_number != 0){ 
			// $user = Auth::user();  
			$accessToken = $user->createToken('authToken');
			$accessToken = $accessToken->accessToken;
			return response(['username'=>$user,'access_token'=>$accessToken]);
		} 
		else{ 

			$url= 'http://210.212.85.155:8082/api/profiles/login/';
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

			        //get response
			$output = curl_exec($ch);
			// dd($output);
			// return json_encode($output);        
			        //Print error if any
			if (curl_errno($ch)) {
				echo 'error:' . curl_error($ch);
			}

			curl_close($ch);
			// dd($ch);

			$arr = json_decode($output, true);
			// dd($arr);
			if (array_key_exists('username', $arr)) {
				$user = new User;
				$user->name = $arr['first_name'];
				$user->username = $arr['username'];
				$user->password = $request->password;
				$user->save();

				$accessToken = $user->createToken('authToken');
				$accessToken = $accessToken->accessToken;
				return response(['username'=>$user,'access_token'=>$accessToken]);

			}
			else{
				return response(['message' => 'Invalid Credentials']);
			}


			// $client = new Client();
			// // $response = $client->post($url,$postData);
			// // return $response;
			// 	$result = $client->request('POST', $url,['body'=>$postData] );
			// 	return $result;
				// $arr = json_decode($result, true);
			// $state = Str::random(40);$url=config('infoConnectApi.url');
				// $accesToken = auth()->user()->createToken('authToken')->accesToken;
				// return response(['username'=>auth()->user(),'accesToken'=>$accesToken]);
				// $accesToken = auth()->user()->createToken('authToken')->accesToken;
				// return response(['username'=>auth()->user(),'accesToken'=>$accesToken]);
				// $user = new User;
				// $user->name = $arr['first_name'];
				// $user->addmission_number = $arr['username'];
				// $user->token= $state;
				// return response()->json(['success' => $user], $this-> successStatus); 
		} 	
	}
}
