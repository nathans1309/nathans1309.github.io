<?php

namespace App\Services;

 use Facebook;

/**
 * Wrapper class for Facebook Service
 */
Interface IFBService
{
    public function getLoginUrl();
    public function getAccessToken();
    public function getPages($accessToken);
    public function sendPost($accessToken, $page_id, $message);
}

class FBService implements IFBService
{
    private $fb;

    function __construct()
    {
        $this->fb = new Facebook\Facebook([
          'app_id' => env('FB_APPID'),
          'app_secret' => env('FB_SECRET'),
          'default_graph_version' => env('FB_DEFAULT_GRAPH_VERSION'),
          'default_access_token' => env('FB_APPID').'|'.env('FB_SECRET')
        ]);
    }

    /**
     * Get the Login Url for Facebook OAuth
     *
     * @return string
     */
    public function getLoginUrl()
    {
        session_start();
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes', 'manage_pages']; // optional
        $loginUrl = $helper->getLoginUrl('http://'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'].'/fb/auth', $permissions);

        return (string) $loginUrl;
    }

    /**
     * OAuth callback should be directed here to generate an access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        session_start();
        $helper = $this->fb->getRedirectLoginHelper();
        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          return  'Graph returned an error: ' . $e->getMessage();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          return  'Facebook SDK returned an error: ' . $e->getMessage();
        }

        if (isset($accessToken)) {
            // Logged in!
            // Exchange the short-lived token for a long-lived token.
          $oAuth2Client = $this->fb->getOAuth2Client();
          // Exchanges a short-lived access token for a long-lived one
          try{
              $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          }catch(Facebook\Exceptions\FacebookSDKException $e){
              return  "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
          }
          // Now store the long-lived token in the database
          // . . . $db->store($longLivedAccessToken);
          // Make calls to Graph with the long-lived token.

          return (string) $longLivedAccessToken;
        }
    }

    /**
     * Gets all the pages an access token has access to
     *
     * @param string $accessToken
     * @return json
     */
    public function getPages($accessToken)
    {
        $this->fb->setDefaultAccessToken($accessToken);
        $pages = json_decode($this->fb->get('/me/accounts')->getBody());
        return $pages;
    }

    /**
     * Posts to facebook page
     *
     * @param string $accessToken
     * @return void
     */
    public function sendPost($accessToken, $page_id, $message)
    {
        $this->fb->setDefaultAccessToken($accessToken);
        // $page_data = json_decode($fb->get($page_id . '?fields=access_token')->getBody());
        // $page_token = $page_data->access_token;
        $this->fb->post($page_id, ['message' => $message] );
    }
}