<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
	private $connection;
	function __construct()
	{
		$this->connection = new TwitterOAuth(
			env('TWITTER_KEY'), 
			env('TWITTER_SECRET')
		);
	}

	public function getRequestToken()
	{
		return $this->connection->oauth("oauth/request_token", ["oauth_callback" => "http://amplifysocial.dev/twitter/auth"]);
	}

	public function getLoginUrl($request_token)
	{
		switch ($this->connection->getLastHttpCode()) {
			case 200:
				$login_url = $this->connection->url("oauth/authorize", ["oauth_token" => $request_token['oauth_token']]);
				break;
			default:
				$login_url =  '';
		}
		return $login_url;
	}

	public function getAccessToken($oauth_verifier, $request_token)
	{
		$this->connection->setOauthToken(
			$request_token['oauth_token'],
			$request_token['oauth_token_secret']
		);
		$access_token = $this->connection->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier]);

		if (200 == $this->connection->getLastHttpCode()) {
		    /* Save the access tokens. Normally these would be saved in a database for future use. */
		    return $access_token;
		    /* Remove no longer needed request tokens */
		    // $request->session()->forget('request_token');
		    /* The user has been verified and the access tokens can be saved for future use */
		    // $_SESSION['status'] = 'verified';
		}
	}

	public function sendTweet($message, $access_token)
	{
		$this->connection->setOauthToken(
			$access_token['oauth_token'],
			$access_token['oauth_token_secret']
		);
		$statuses = $this->connection->post("statuses/update", ["status" => $message]);

		if ($this->connection->getLastHttpCode() == 200) {
		    return $status;
		} else {
		    // Handle error case
			return  'Could not post to Twitter. Refresh the page or try again later.';
		}
	}
}