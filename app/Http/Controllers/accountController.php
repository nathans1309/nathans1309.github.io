<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services;

class accountController extends Controller
{
    public function index(Request $request, Services\FBService $fb, Services\TwitterService $twitter){
	// $longLivedAccessToken = null;
	// $page_id = null;
    	$data = [];
	if($request->session()->has('facebook_access_token') && $request->session()->has('page_id')){
	    $data['facebook_access_token'] = $request->session()->get('facebook_access_token');
	    $data['page_id'] = $request->session()->get('page_id');
	}
	else
	{
		$data['fbLoginUrl'] = $fb->getLoginUrl();
	}

	if($request->session()->has('twitter_access_token')){
		$data['twitter_access_token'] = $request->session()->get('twitter_access_token');
	}else{
		$request_token = $twitter->getRequestToken();
		$request->session()->put('twitter_request_token', $request_token);
		$data['twitterLoginUrl'] = $twitter->getLoginUrl($request_token);
	}

    	return view('account.manage', $data);
    }

    public function profiles(){
    	return view('account.profiles');
    }
}
