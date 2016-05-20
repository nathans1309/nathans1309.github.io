<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class instagramController extends Controller
{
	public function index(Request $request){
		

		$client_id = env('INSTA_CLIENT_ID');
		$client_secret = env('INSTA_CLIENT_SECRET');
		$redirect_uri = 'http://'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'].'/instagram/auth';
		$login_url = "https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_uri&scope=basic&response_type=code";

		echo '<a href="' . $login_url . '" >Login with Instagram</a>';

	}

	public function auth(Request $request){

		if($request->input('code')){
			$body = [
				'client_id' => env('INSTA_CLIENT_ID'),
				'client_secret' => env('INSTA_CLIENT_SECRET'),
				'grant_type' => 'authorization_code',
				'redirect_uri' => 'http://'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'].'/instagram/auth',
				'code' => $request->input('code')
			];

			$client = new \GuzzleHttp\Client();
			$res = $client->post('https://api.instagram.com/oauth/access_token',['form_params' => $body]);
			$access_token =  json_decode($res->getBody())->access_token;
		}

	}

	public function update(Request $request){

	}

}	