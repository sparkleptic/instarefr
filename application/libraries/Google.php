<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google 
{
  /*
   *    Google Library is used for Google Login 
   *   
   */  
  public function __construct()
  {    
       require( dirname(__FILE__) . "/Google/autoload.php" );   // Load autoload Library file.
  }

  public function googlelog()
  {
        
        //Insert your cient ID and secret 
	//You can get it from : https://console.developers.google.com/
	$client_id = '950510867797-pa2gsotikknagh64o87ehr00e109k41f.apps.googleusercontent.com'; 			// Your Google Client Id
	$client_secret = 'ooik2NrPnOINBmVTjf9Dm8fG';				// Your Google Secret Key
	$redirect_uri = 'http://www.instarefr.com';  // Return url for google login. It should be same with the link provided in google login app created on https://console.developers.google.com

	/************************************************
	  Make an API request on behalf of a user. In
	  this case we need to have a valid OAuth 2.0
	  token for the user, so we need to send them
	  through a login flow. To do this we need some
	  information from our API console project.
	 ************************************************/
	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->addScope("email");
	$client->addScope("profile");
	
	
	/************************************************
	  When we create the service here, we pass the
	  client to it. The client then queries the service
	  for the required scopes, and uses that when
	  generating the authentication URL later.
	 ************************************************/
	$service = new Google_Service_Oauth2($client);
	
	/************************************************
	  If we have a code back from the OAuth 2.0 flow,
	  we need to exchange that with the authenticate()
	  function. We store the resultant access token
	  bundle in the session, and redirect to ourself.
	*/
	  
	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['google_access_token'] = $client->getAccessToken();
	  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	  exit;
	}
	 /************************************************
	  If we have an access token, we can make
	  requests, else we generate an authentication URL.
	 ************************************************/
	if (isset($_SESSION['google_access_token']) && $_SESSION['google_access_token']) 
	{
	  $client->setAccessToken($_SESSION['google_access_token']);
	  $googleuser = $service->userinfo->get(); //get user info 
	  return $googleuser;   //  Return Google Login user infor
	}
	else 
	{
	  $googlelogin =  $client->createAuthUrl();
	  return $googlelogin;  // Return Google Login Url
	}
  }
}
/* End of file Google.php */
/* Location:  ./application/libraries/Google.php */
?>