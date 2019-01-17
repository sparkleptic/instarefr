<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
/*
 * 
 *    My_Controller Created for global functions will be used in all conrollers. 
 *
 */
class MY_Controller extends CI_Controller {

    public $social_user;

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library(array('form_validation', 'session', 'email'));
        $this->load->model('UserModel', 'LoginModel'); // Load Model
        /*  Fb Login API details. appId and secret keys. */
        
        $fb_config = array(
            'appId' => '1460430350907084',  // Your FB appId  
            'secret' => 'c2d1bfe8687b4cb0c21196a7923ea6f8' // Your EB Secret Key
        );

        $this->load->library('Facebook', $fb_config);   // Load Facebook Library
        $this->load->helper('url'); 
        //$this->session->set_userdata('last_page', current_url());
        
    }

    /*  
     *  Function is used to login with facebook, google and twitter.     
     */

    public function social_login() 
    {
        $login_array = array();
        
        /*  FB LOGIN SCRIPT STARTS HERE!     */
        $social_user = $this->facebook->getUser();    // Get Facebook User
        if ($social_user != 0) {
            
                try {
                $data['user_profile'] = $this->facebook
      ->api('/me?'.http_build_query(array( 'access_token' => '186133581730756|3jtpjHn4_uwX4gqjMw53oOYxbfM', 'fields' => 'id,name,email,first_name,last_name,birthday,about,gender,location,picture.type(large)' )));
                // print_r($data['user_profile']); die;
                /*  Create array to save values to register user with you in db. */
                $fblogin_id = $data['user_profile']['id'];
                $fb_email = ''; $location = "";
                if(!empty($data['user_profile']['email']))
                {
                    $fb_email = $data['user_profile']['email'];
                }
                if(!empty($data['user_profile']['location']['name']))
                {
                    $location = $data['user_profile']['location']['name'];
                }
                $data['user'] = array(
                    'insta_user_social_id' => $fblogin_id,
                    'insta_user_login_type' =>'facebook',      // If Login with Fb then loginType = 1
                    
                    'insta_user_email_facebook' => $fb_email
                );
                $data['user_meta'] = array(
                    'name' => $data['user_profile']['name'],
                    'first_name' => $data['user_profile']['first_name'],
                    'last_name' => $data['user_profile']['last_name'],
                    'gender' => $data['user_profile']['gender'],
                    'profile_pic' => $data['user_profile']['picture']['data']['url'],
                    'location' =>  $location,
                    'email' =>  $data['user_profile']['email'],
                    'resume' => '',
                    'company_id' => '',
                    'company_name' => '',
                    'phone' => '',
                    'skills' => '',
                    'experience' => '',
                    'total_updated_round' => 1
                    
                );


                /*  Call facebooklogin function to login/register user and redirect after login */
                $fbuser = $this->facebooklogin($data, $fblogin_id);
                if ($fbuser == 1) { //If user registered or login redirect to dashboard 
                   if (strpos($this->session->current_url, 'filter_job') !== false) {
                            $this->session->set_userdata('current_url', base_url()."find-a-job/");
                        }
                    redirect($this->session->current_url); // Redirect to fbdashboard function.
                } 
            } catch (FacebookApiException $e) {
                $social_user = null;
            }
            $fb_login_url = ''; //  Return blank if already login with fb.
        } else {
            $fb_login_url = $this->facebook->getLoginUrl(array('scope'=>'email')); // Return FB login link.
            $this->session->set_userdata('facebook_login_url', $fb_login_url);
        }
        $login_array = array($fb_login_url);
        /*  FB LOGIN SCRIPT ENDS HERE!   */

        /*  Login With Google Starts     */

        if ($social_user == 0) {
            $this->load->library('Google'); /*  Load Google Library  */
            $googleobj = new Google();
            $new_googleobj = $googleobj->googlelog();

            if (isset($_SESSION['google_access_token']) && $_SESSION['google_access_token']) {
                $googleuser = $new_googleobj; //get user info 
                if ($googleuser) {
                    
                    $usersesn['email'] = $googleuser->email;
                    $usersesn['googleid'] = $googleuser->id;
                    $usersesn['name'] = $googleuser->name;
                    $usersesn['gender'] = $googleuser->gender; 
                    $usersesn['profile_pic'] = $googleuser->picture; 
                    $usersesn['id'] = $googleuser->id;
                    $usersesn['familyName'] = $googleuser->familyName;
                    $usersesn['givenName'] = $googleuser->givenName;
                    
                      // Created session og Google loged in user
                    /*  Create array to save values to register user with you in db. */
                    

                    $data['user'] = array(
                    'insta_user_social_id' => $googleuser->id,
                    'insta_user_login_type' =>'google',
                    'insta_user_email_google' => $googleuser->email
                    );
                    $data['user_meta'] = array(
                        'name' => $googleuser->name,
                        'first_name' => $googleuser->familyName,
                        'last_name' => $googleuser->givenName,
                        'gender' => $googleuser->gender,
                        'profile_pic' => $googleuser->picture,
                        'location' => '',
                        'email' => $googleuser->email,
                        'resume' => '',
                        'company_id' => '',
                        'company_name' => '',
                        'phone' => '',
                        'skills' => '',
                        'experience' => '',
                        'total_updated_round' => 1
                    );
                     // $this->session->set_userdata('user_session', $data);
                    /*  Call google_login function to login/register user and redirect after login */
                   $google_user = $this->google_login($data, $googleuser->id);
                    if ($google_user == 2) {
                        if (strpos($this->session->current_url, 'filter_job') !== false) {
                            $this->session->set_userdata('current_url', base_url()."find-a-job/");
                        }
                        redirect($this->session->current_url); // Redirect to fbdashboard function.
                    }
                }   
                $googlelogin_url = '';  //  Return blank if already login with Google.
            } else {
                $googlelogin_url = $new_googleobj; //  Return Google Login URL.
                $this->session->set_userdata('google_login_url', $googlelogin_url);
            }
            /*      Login With Google ENDs   */
            
        } 
        else {
            $googlelogin_url = '';  //  Return blank if already login with fb.
        }
        array_push($login_array, $googlelogin_url); // Push google login url in array.
        
        
        
        /*  API details */
        $baseURL = base_url();    // Set Base url
        $callbackURL = base_url();    // Set call back url
        $linkedinApiKey = '781no8badn1ja5';             // API key
        $linkedinApiSecret = '85iC7XEBOo45XsaL';        // Secret Key
        $linkedinScope = 'r_basicprofile r_emailaddress';   // Scope to get info about user.
             
        return $login_array;    // Return Login url's array
    }
    /*
     *  Function is used to login with Linkedin.     
     */
    
    public function social_login_linkedin($data)
    {
        $this->load->library('Linkedinlib');    //  Load Linkedin Library
        $linkedinobj = new Linkedinlib();    // New twitter object
        $new_linkedinobj = $linkedinobj->linkedinlogin($data);  // call to linkedinlogin() function and pass data to the function
        if($new_linkedinobj)        // If $new_linkedinobj is executed
        {
            /*  Create array of linkedin Response */
            $linkedinId = (string)$new_linkedinobj->{'id'};
            $firstname = (string)$new_linkedinobj->{'first-name'};
            $last_name = (string)$new_linkedinobj->{'last-name'};
            $email = (string)$new_linkedinobj->{'email-address'};
            $pic = (string)$new_linkedinobj->{'picture-url'};
            $loc = (string)$new_linkedinobj->{'location'}->{'name'};

            

                $data['user'] = array(
                    'insta_user_social_id' => $linkedinId,
                    'insta_user_login_type' =>'linkedin',
                    'insta_user_email_linkedin' => $email
                );
                $data['user_meta'] = array(
                    'name' => $firstname.' '.$last_name,
                    'first_name' => $firstname,
                    'last_name' => $last_name,
                    'gender' => '',
                    'profile_pic' => $pic,
                    'location' => $loc,
                    'email' => $email,
                    'resume' => '',
                    'company_id' => '',
                    'company_name' => '',
                    'phone' => '',
                    'skills' => '',
                    'experience' => '',
                    'total_updated_round' => 1
                ); 
                

            /*  Call linkedin_login function to login/register user and redirect after login */
            $linkedinUser = $this->linkedin_login($data, $linkedinId);
            if ($linkedinUser == 4) {
                if (strpos($this->session->current_url, 'filter_job') !== false) {
                    $this->session->set_userdata('current_url', base_url()."find-a-job/");
                }
                redirect($this->session->current_url); // Redirect to fbdashboard function.
            }
        }
    }
   public function facebooklogin($data, $fbid) {
    $getfbuser = $this->LoginModel->userAlreadyExists($fbid,'facebook',$data['user']['insta_user_email_facebook']);
    //print_r($getfbuser); 
        if (count($getfbuser['user']) == 0) { //echo "1"; die;
            $user_id = $this->LoginModel->addUser($data['user'],$data['user']['insta_user_email_facebook']);   // Call your model to save user info if new user
           
            if ($user_id != false) {
                $user_meta = array();
                foreach ($data['user_meta'] as $key => $value) {
                   $new['insta_user_id'] = $user_id;
                   $new['insta_user_meta_key'] = $key;
                   $new['insta_user_meta_value'] = $value;
                   array_push($user_meta,$new);
                }
                $user_meta_id = $this->LoginModel->add_UserMeta($user_meta);

                 // Create array which you need for your session stroage.
                $usersesn['user_id']= $user_id;
                $usersesn['social_id']= $data['user']['insta_user_social_id'];
                $usersesn['name'] = $data['user_meta']['name'];
                $usersesn['first_name'] =  $data['user_meta']['first_name'];
                $usersesn['last_name'] = $data['user_meta']['last_name'];
                $usersesn['gender'] = $data['user_meta']['gender'];
                $usersesn['profile_pic'] = $data['user_meta']['profile_pic'];
                $usersesn['email']= $data['user_meta']['email'];
                 $usersesn['phone'] = $data['user_meta']['phone'];
                $usersesn['location'] = $data['user_meta']['location'];
                $usersesn['resume'] = $data['user_meta']['resume'];
                $usersesn['company_id'] = $data['user_meta']['company_id']; 
                $usersesn['company_name'] = $data['user_meta']['company_name'];
                $usersesn['skills'] = $data['user_meta']['skills'];
                $usersesn['experience'] = $data['user_meta']['experience']; 
                // $usersesn['why_you_get_refer'] = $data['user_meta']['why_you_get_refer'];    
                 $this->session->set_userdata('user_session', $usersesn);
            }

                return 1;   // Return 1 to set the redirections where you want to redirect user after login.
            
        } else { //echo "2"; die;
            $user_id = $getfbuser['user']->insta_user_id; 
            $usersesn['user_id']=  $user_id;

             $data['user_meta'] = json_decode($getfbuser['user_meta']);
            // print_r( $data['user_meta']); die;
            $usersesn['social_id']= $getfbuser['user']->insta_user_social_id;
            $usersesn['name'] = $data['user_meta']->name;
            $usersesn['first_name'] =  $data['user_meta']->first_name;
            $usersesn['last_name'] = $data['user_meta']->last_name;
            $usersesn['gender'] = $data['user_meta']->gender;
            $usersesn['profile_pic'] = $data['user_meta']->profile_pic;
            $usersesn['email']= $data['user_meta']->email;
            $usersesn['location'] = $data['user_meta']->location;
             $usersesn['phone'] = $data['user_meta']->phone;
            $usersesn['resume'] = $data['user_meta']->resume;
            $usersesn['company_id'] = $data['user_meta']->company_id;
           $usersesn['company_name'] =  $data['user_meta']->company_name;
            $usersesn['skills'] = $data['user_meta']->skills;
            $usersesn['experience'] = $data['user_meta']->experience;
            // $usersesn['why_you_get_refer'] = $data['user_meta']->why_you_get_refer;     
             $this->session->set_userdata('user_session', $usersesn);    // Create your Login User session

            $social_user = 0;   // Set Social_user to 0
            
            return 1;   // Return 1 to set the redirections where you want to redirect user after login.
        }
    }

    /*  Function is used for the insert the new user loggdin with Google     */

    public function google_login($data, $googleId) {
        $getuser = $this->LoginModel->userAlreadyExists($googleId,'google',$data['user']['insta_user_email_google']);  // Call your model to check if user already register with you.
        /* NOTE : I am checking user availability with the Google id. You may also check using email if you have login check with user email */
        if (count($getuser['user']) == 0) {
            $user_id = $this->LoginModel->addUser($data['user'],$data['user']['insta_user_email_google']);   // Call your model to Insert new user
            if ($user_id != false) {
                $user_meta = array();
                foreach ($data['user_meta'] as $key => $value) {
                   $new['insta_user_id'] = $user_id;
                   $new['insta_user_meta_key'] = $key;
                   $new['insta_user_meta_value'] = $value;
                   array_push($user_meta,$new);
                }
                $user_meta_id = $this->LoginModel->add_UserMeta($user_meta);
                $usersesn['user_id']=  $user_id;
                $usersesn['social_id']= $data['user']['insta_user_social_id'];
                $usersesn['name'] = $data['user_meta']['name'];
                $usersesn['first_name'] =  $data['user_meta']['first_name'];
                $usersesn['last_name'] = $data['user_meta']['last_name'];
                $usersesn['gender'] = $data['user_meta']['gender'];
                $usersesn['profile_pic'] = $data['user_meta']['profile_pic'];
                $usersesn['email']= $data['user_meta']['email'];
                 $usersesn['phone'] = $data['user_meta']['phone'];
                $usersesn['location'] = $data['user_meta']['location'];
                $usersesn['resume'] = $data['user_meta']['resume'];
                $usersesn['company_id'] = $data['user_meta']['company_id']; 
                $usersesn['company_name'] = $data['user_meta']['company_name'];
                $usersesn['skills'] = $data['user_meta']['skills'];
                $usersesn['experience'] = $data['user_meta']['experience'];
               // $usersesn['why_you_get_refer'] = $data['user_meta']['why_you_get_refer'];   
                 $this->session->set_userdata('user_session', $usersesn);
            }
        
                return 2;   // Return 2 to set the redirections where you want to redirect user after login.
         
        } 
        else 
        {
            $user_id = $getuser['user']->insta_user_id; 
            $usersesn['user_id']=  $user_id;
            $data['user_meta'] = json_decode($getuser['user_meta']);       
            $usersesn['social_id']= $getuser['user']->insta_user_social_id;
            $usersesn['name'] = $data['user_meta']->name;
            $usersesn['first_name'] =  $data['user_meta']->first_name;
            $usersesn['last_name'] = $data['user_meta']->last_name;
            $usersesn['gender'] = $data['user_meta']->gender;
            $usersesn['profile_pic'] = $data['user_meta']->profile_pic;
            $usersesn['email']= $data['user_meta']->email;
             $usersesn['phone'] = $data['user_meta']->phone;
            $usersesn['location'] = $data['user_meta']->location;
            $usersesn['resume'] = $data['user_meta']->resume;
            $usersesn['company_id'] = $data['user_meta']->company_id;
           $usersesn['company_name'] =  $data['user_meta']->company_name;
            $usersesn['skills'] = $data['user_meta']->skills;
            $usersesn['experience'] = $data['user_meta']->experience;
            // $usersesn['why_you_get_refer'] = $data['user_meta']->why_you_get_refer;     
             $this->session->set_userdata('user_session', $usersesn);
           
            return 2;   // Return 1 to set the redirections where you want to redirect user after login.
        }
    }

    /*  Function is used for the insert the new user loggdin with LinkedIn   */
    public function linkedin_login($data, $linkedinId)
    {
        
        $getuser = $this->LoginModel->userAlreadyExists($linkedinId,'linkedin',$data['user']['insta_user_email_linkedin']);  // Call your model to check if user already register with you.
        /* NOTE : I am checking user availability with the Google id. You may also check using email if you have login check with user email */
        
        if (count($getuser['user']) == 0) {
            $user_id = $this->LoginModel->addUser($data['user'],$data['user']['insta_user_email_linkedin']);    // Call your model to save user info if new user
            if ($user_id != false) {
                $user_meta = array();
                foreach ($data['user_meta'] as $key => $value) {
                   $new['insta_user_id'] = $user_id;
                   $new['insta_user_meta_key'] = $key;
                   $new['insta_user_meta_value'] = $value;
                   array_push($user_meta,$new);
                }
                $user_meta_id = $this->LoginModel->add_UserMeta($user_meta);
                $usersesn['user_id']=  $user_id;
                $usersesn['social_id']= $data['user']['insta_user_social_id'];
                $usersesn['name'] = $data['user_meta']['name'];
                $usersesn['first_name'] =  $data['user_meta']['first_name'];
                $usersesn['last_name'] = $data['user_meta']['last_name'];
                $usersesn['gender'] = $data['user_meta']['gender'];
                $usersesn['profile_pic'] = $data['user_meta']['profile_pic'];
                $usersesn['email']= $data['user_meta']['email'];
                 $usersesn['phone'] = $data['user_meta']['phone'];
                $usersesn['location'] = $data['user_meta']['location'];
                $usersesn['resume'] = $data['user_meta']['resume'];
                $usersesn['company_id'] = $data['user_meta']['company_id']; 
                $usersesn['company_name'] = $data['user_meta']['company_name'];
                $usersesn['skills'] = $data['user_meta']['skills'];
                $usersesn['experience'] = $data['user_meta']['experience'];
               // $usersesn['why_you_get_refer'] = $data['user_meta']['why_you_get_refer'];   
                 $this->session->set_userdata('user_session', $usersesn);
            }
            return 4;   // Return 1 to set the redirections where you want to redirect user after login.
        } 
        else 
        {
            $user_id = $getuser['user']->insta_user_id; 
            $usersesn['user_id']=  $user_id;
             $data['user_meta'] = json_decode($getuser['user_meta']);
       
            $usersesn['social_id']= $getuser['user']->insta_user_social_id;
            $usersesn['name'] = $data['user_meta']->name;
            $usersesn['first_name'] =  $data['user_meta']->first_name;
            $usersesn['last_name'] = $data['user_meta']->last_name;
            $usersesn['gender'] = $data['user_meta']->gender;
            $usersesn['profile_pic'] = $data['user_meta']->profile_pic;
            $usersesn['email']= $data['user_meta']->email;
             $usersesn['phone'] = $data['user_meta']->phone;
            $usersesn['location'] = $data['user_meta']->location;
            $usersesn['resume'] = $data['user_meta']->resume;
            $usersesn['company_id'] = $data['user_meta']->company_id;
           $usersesn['company_name'] =  $data['user_meta']->company_name;
            $usersesn['skills'] = $data['user_meta']->skills;
            $usersesn['experience'] = $data['user_meta']->experience; 
            //$usersesn['why_you_get_refer'] = $data['user_meta']->why_you_get_refer;  
            $this->session->set_userdata('user_session', $usersesn);
            return 4;   // Return 1 to set the redirections where you want to redirect user after login.
        }

    }

    public function google_ads()
    {
        // $this->db->select("insta_google_ads"); 
        // $this->db->from('insta_google_ads');   
        // $this->db->limit(1);
        // $query = $this->db->get();
        // return $query->result();

         $this->db->select("insta_google_ads"); 
        $this->db->from('insta_google_ads'); 
        $this->db->where('insta_google_ads_status=',1);        
        $this->db->order_by('insta_google_ads_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file My_Controller.php */
/* Location: ./application/core/My_Controller.php */