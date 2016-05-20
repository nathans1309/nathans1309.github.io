<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facebook;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;

class fbController extends Controller
{

    public function index(Request $request)
    {
        try {
            if($request->session()->has('facebook_access_token') && $request->session()->has('page_id')){
                $longLivedAccessToken = new Facebook\Authentication\AccessToken($request->session()->get('facebook_access_token'));
                $page_id = $request->session()->get('page_id');
            }
        } catch(FacebookSDKException $e) {
            $longLivedAccessToken = null;
        }

        if(isset($longLivedAccessToken) && isset($page_id)){
            return view('facebook.post');
        }else{
            $loginUrl = $fb->getLoginUrl();
            echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
        }
    }

    public function auth(Request $request, Services\FBService $fb){
          $accessToken = $fb->getAccessToken();
          $request->session()->put('facebook_access_token', $accessToken);
          $pages = $fb->getPages($accessToken);
          return view('facebook.pages')->with('data', $pages->data);
    }

    public function post(Request $request){
        $fb = new Facebook\Facebook([
          'app_id' => env('FB_APPID'),
          'app_secret' => env('FB_SECRET'),
          'default_graph_version' => env('FB_DEFAULT_GRAPH_VERSION'),
          'default_access_token' => env('FB_APPID').'|'.env('FB_SECRET')
        ]);

        $fb->setDefaultAccessToken($request->session()->get('facebook_access_token'));
        
        $message = $request->input('message');
        $page_id = $request->session()->get('page_id');
        $page_data = json_decode($fb->get($page_id . '?fields=access_token')->getBody());
        $page_token = $page_data->access_token;
        $fb->post($page_id, ['message' => $message] );

    }

    public function save_pages(Request $request){
        $page_id = (string) $request->input('page_id');
        $request->session()->put('page_id', $page_id);
        return redirect('account');
    }

}