<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *  Logout controller 
 *  Company : tecHindustan Solutions Pvt. Ltd.
 *  Created by : Aman Dhiman
 *  
 */

class Logout extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://projects.viaquotes.com/SocialLogin/logout
	 *	
	 *  Index function is used to destroy FB and Google Login sessions
         */
	public function index()
	{

            $this->load->helper('cookie');
      
            
            $current_url = $this->session->current_url;
            delete_cookie('_ga');

            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time()-1000);
                    setcookie($name, '', time()-1000, '/');
                }
            }

            $this->session->sess_destroy();
            
            // $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
            // $this->output->set_header("Pragma: no-cache");

            $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
            $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
            $this->output->set_header("Pragma: no-cache");  
              
            /*  DEstroy FB session  */
            unset($_SESSION['fb_978900922179232_code']);
            unset($_SESSION['fb_978900922179232_access_token']);
            unset($_SESSION['fb_978900922179232_code']);
            
            /*  Destroy Google session */
            unset($_SESSION['google_access_token']);
            /*  Destroy Twitter Session */
            // $this->session>un_set('_ga');
            
            unset($_SESSION['token']);      
            unset($_SESSION['token_secret']);
            unset($this->session->user_session);

            //$data['main_content'] = 'home/home';
            //$this->load->view('template',$data);
            //echo $this->session->user_session['user_id']; die;
            // if(empty($this->session->user_session['user_id']))
            // {
            //       $sociallogin = $this->social_login(); // Return Fb and google login urls array from main controller
            //       $data['login_url'] = $sociallogin[0]; // Login_url is used to get FB Login Url from main controller
            //       $data['googlelogin'] = $sociallogin[1]; // googlelogin is used to get Google Login Url from main controller

            //       $this->session->set_userdata('facebook_login_url', $data['login_url']);
            //       $this->session->set_userdata('google_login_url', $data['googlelogin']);
            // }
            //  if(empty($this->session->user_session))
            // {
            //      if(!empty($current_url))
            //       {
            //          redirect($current_url);
            //       }else{
            //          redirect(base_url());
            //       } 
            //       //redirect(base_url().'/home'); 
            // }else{
            //      redirect(base_url().'/logout'); 
            // }
            redirect(base_url());
            
            
	}
}
/* End of file Logout.php */
/* Location: ./application/controller/Logout.php */