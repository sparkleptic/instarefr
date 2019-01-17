<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twitter 
{
    /*
     *  Twitter Login Library file 
     *  Used to interact with twitter login libraries.
     *  Get the Twitter login urls
     *  and Twitter User information. 
     *     
     */
    
     public function __construct()
     {    
       include_once( dirname(__FILE__) . "/twitter/twitteroauth.php" );   // Include twitteroauth Library file.
     }
     
     /*  
      * 
      *  Function : twitterlogin()
      *  Used to get Twitter Login url and user information after Login.
      * 
      */
     public function twitterlogin()
     {
          /*  Api Keys.   */
          $CONSUMER_KEY = 'XXXXXXXXXXXXXXXXX';				// Your Twitter CONSUMER KEY
          $CONSUMER_SECRET =  'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';	// Your Twitter CONSUMER SECRET
          $OAUTH_CALLBACK = base_url().'login';
          // ends here
          
          /*  If token is old, distroy session and redirect user to login page   */
          if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) 
          {
             session_destroy();
             redirect(base_url().'login');
          }
          //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
          elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) 
          {
                $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);  // Connection with twitterOAuth
                $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);   // Get access token
                if($connection->http_code == '200')
                {
                        $_SESSION['status'] = 'verified';
                        $_SESSION['request_vars'] = $access_token;

                        $user_info = $connection->get('account/verify_credentials');    // Get User info
                        
                        $_SESSION['user_info'] = $user_info;    // Set session of user information
                        
                        /*  Here will come your db functions to check existing users and insert users   */
                        //Unset no longer needed request tokens
                        unset($_SESSION['token']);
                        unset($_SESSION['token_secret']);
                        redirect(base_url().'login/twitterdashboard/'); // Redirect to twitter page where we are showing user name and image.
                }
                else
                {
                    die("error, try again later!");
                }
        }
        else    // If denied status
        {
                if(isset($_GET["denied"]))
                {
                    redirect(base_url().'login');
                    die();
                }

                //Fresh authentication
                $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
                $request_token = $connection->getRequestToken($OAUTH_CALLBACK);

                //Received token info from twitter
                $_SESSION['token']          = $request_token['oauth_token'];
                $_SESSION['token_secret']   = $request_token['oauth_token_secret'];

                //Any value other than 200 is failure, so continue only if http code is 200
                if($connection->http_code == '200')
                {
                        //redirect user to twitter
                        $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                        return  $twitterlogin_url = $twitter_url;   // Twitter Login Url
                }
                else
                {
                        return $twitterlogin_url ='';   
                        die("error connecting to twitter! try again later!");
                }
        }
     }
}
/* End of file twitter.php */
/* Location:  ./application/libraries/twitter.php */
?>