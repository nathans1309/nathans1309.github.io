<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Services;

class twitterController extends Controller
{
	private $twitter;

	function __construct(Services\TwitterService $twitter){
		$this->twitter = $twitter;
	}
	public function index(Request $request){

		if($request->session()->has('twitter_access_token'))
		{
			return view('twitter.tweet');
		}
		$request_token = $this->twitter->getRequestToken();
		$request->session()->put('twitter_request_token', $request_token);

		echo '<a href="' . $this->twitter->getLoginUrl() . '" >Login with Twitter</a>';
	}

	public function auth(Request $request){
		$request_token = $request->session()->get('twitter_request_token');
		// $connection = new TwitterOAuth(
		// 	env('TWITTER_KEY'), 
		// 	env('TWITTER_SECRET'),
		// 	$request_token['oauth_token'],
		// 	$request_token['oauth_token_secret']
		// );
		$access_token = $this->twitter->getAccessToken($request->input('oauth_verifier'), $request_token);
		// $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $request->input('oauth_verifier')]);

		if(isset($access_token)){
			$request->session()->put('twitter_access_token', $access_token);
		}
		// if (200 == $connection->getLastHttpCode()) {
		//     /* Save the access tokens. Normally these would be saved in a database for future use. */
		//     $request->session()->put('access_token', $access_token);
		//     /* Remove no longer needed request tokens */
		//     $request->session()->forget('request_token');
		//     /* The user has been verified and the access tokens can be saved for future use */
		//     // $_SESSION['status'] = 'verified';
		// } else {
		//    echo 'Could not connect to Twitter. Refresh the page or try again later.';
		//     exit;
		// }

		return redirect('account');
	}

	public function tweet(Request $request)
	{
		$message = $request->input('message');
		$access_token = $request->session()->get('access_token');

		$connection = new TwitterOAuth(
			env('TWITTER_KEY'), 
			env('TWITTER_SECRET'),
			$access_token['oauth_token'],
			$access_token['oauth_token_secret']
		);

		$statuses = $connection->post("statuses/update", ["status" => $message]);
		if ($connection->getLastHttpCode() == 200) {
		    return redirect('twitter');
		} else {
		    // Handle error case
			echo 'Could not post to Twitter. Refresh the page or try again later.';
		    	exit;
		}
	}

	public function unauth(Request $request)
	{
		// $request->session()->forget('access_token');
		$request->session()->flush();
		return redirect('twitter');
	}
}