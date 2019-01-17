<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form helper library
		$this->load->helper('security');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('UserModel');

		$this->load->model('JobModel'); // load model 

		$this->load->model('CompanyModel');

		$this->load->model('PointsModel');
	}

	
	public function index()
    {
    	
		$sociallogin = $this->social_login(); // Return Fb and google login urls array from main controller
		$data['login_url'] = $sociallogin[0]; // Login_url is used to get FB Login Url from main controller
		$data['googlelogin'] = $sociallogin[1]; // googlelogin is used to get Google Login Url from main controller

		$this->session->set_userdata('facebook_login_url', $data['login_url']);
		$this->session->set_userdata('google_login_url', $data['login_url']);
		

		$data['page_title']  = "Instarefr";
		$data['page_description']  = "Login with top social media networks in just one-click.";

		$data['main_content'] = 'user/user-login';
		/*  Load Views   */
		$this->load->view($data['main_content'],$data);
		// $this->load->view('template',$data);
	}
        
            
    public function link()
    {   
		$data['data'] = array('lType'=>'initiate','linkedin' => 'Connect to LinkedIn New Login');    // Important array need to pass in linkedin library to trigger the linkedin api.
		$this->social_login_linkedin($data['data']);     // Call social_login_linkedin function and pass data to the function
    }

     public function login_error()
    {   
		$this->session->set_flashdata('next_redirect', $this->session->current_url);
		$this->session->set_flashdata('login_msg', 'Login Error');
		redirect($this->session->current_url);
    }

    public function dashboard()
    {
    	if(isset($this->session->user_session))
		{
	        $data['pagetitle'] = 'One-click Facebook Login'; // Page title
	        
	        /*  Pass session data to the data variable need to print in view. */
	        $data['name'] = $this->session->user_session['name'];
	        $data['screen_name'] = "<strong>Full Name :</strong> ".$this->session->user_session['first_name'] . ' '.$this->session->user_session['last_name'];
	        $data['profile_image_url'] = $this->session->user_session['profile_pic'];
	        $data['gender'] = "<strong>Gender :</strong> ".$this->session->user_session['gender'];
	        // ends here
			$data['applied_jobs'] = $this->JobModel->get_users_applied_jobs($this->session->user_session['user_id']);
	        $data['referred_jobs'] = $this->JobModel->get_users_referred_jobs($this->session->user_session['user_id']);
	        $data['current_points'] = $this->PointsModel->get_users_current_points($this->session->user_session['user_id']);

	        $data['jsonarray']= json_encode($this->session->user_session, JSON_PRETTY_PRINT); // Create JSON format of FB user session to show in Raw Data section
	        $data['company_list'] = $this->CompanyModel->get_company_list();
	        $data['main_content'] = 'user/user-account';
	        $this->load->view('template',$data);
        }else{
			//$this->session->set_flashdata('warning', 'Please Login before posting job.');
			redirect(base_url().'home');
		}	
    }


    public function user_detail($userId)
    {
        
        if(isset($this->session->user_session))
		{
			$data['detail'] = $this->UserModel->get_user_data($userId);
			$data['main_content'] = 'user/user-view';
			$this->load->view('template',$data);

		}else{
			$this->session->set_flashdata('warning', 'Please Login before seen candidate details.');
			redirect(base_url().'home');
		}	
        
    }

	public function update()
	{
		$data[] = $this->input->post();
		//print_r($data); die;
		$user_data = array();
		$usersesn = array();
		if(!empty($_FILES["new_resume"]["name"]))
		{
			$date = strtotime(date('m/d/Y h:i:s a', time()));
			if (!is_dir('./upload/user/'.$this->input->post('user_id').'_user')) 
			{
			     mkdir('./upload/user/'.$this->input->post('user_id').'_user', 0777, TRUE);

			}
			$path = './upload/user/'.$this->input->post('user_id').'_user/';
			//set preferences
			$file_name = $_FILES["new_resume"]['name'];
			$lastDot = strrpos($file_name, ".");
			$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
			//$extension = pathinfo($newfile_name, PATHINFO_EXTENSION);
			$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
	        $config['upload_path'] = $path;
	        $config['allowed_types'] = '*';
	        $config['max_size']    = '1000';
	        $config['file_name'] = $newfile_name;

	        //load upload class library
	        
	        $this->load->library('upload', $config);
            $this->upload->initialize($config);
			$resume = $this->input->post('user_id').'_user/'.$config['file_name'];
			 
	        if (!$this->upload->do_upload('new_resume'))
	        {
	            $upload_error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('error', 'Resume file type is not correct.');
				redirect(base_url().'user/dashboard/');     
	        }
	        else
	        {
	            $new_arr = array();
	    		$new_arr['insta_user_id'] = $this->input->post('user_id');
	    		$new_arr['insta_user_meta_key'] = 'resume';
	    		$new_arr['insta_user_meta_value'] = $resume;
	    		// $resume = $this->input->post('resume');
	    		// unset($resume);
	    		array_push($user_data, $new_arr); 
	        }
	    }else
	    {
	    	$new_arr = array();
    		$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'resume';
    		$new_arr['insta_user_meta_value'] = $this->input->post('resume');
    		$resume = $this->input->post('resume');
    		array_push($user_data, $new_arr); 
	    }
	    $usersesn['resume'] = $resume;

	    if(!empty($_FILES["new_profile_pic"]["name"]))
		{

			$date = strtotime(date('m/d/Y h:i:s a', time()));
			if (!is_dir('./upload/user/'.$this->input->post('user_id').'_user')) 
			{
			     mkdir('./upload/user/'.$this->input->post('user_id').'_user', 0777, TRUE);

			}
			$path = './upload/user/'.$this->input->post('user_id').'_user/';
			
			$file_name = $_FILES["new_profile_pic"]["name"];
			$lastDot = strrpos($file_name, ".");
			$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
			//$extension = pathinfo($newfile_name, PATHINFO_EXTENSION);
			$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
	        $config['upload_path'] = $path;
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size']    = '1000';
	        $config['file_name'] = $newfile_name;
	        $profile_pic = $this->input->post('user_id').'_user/'.$config['file_name'];
	        //load upload class library
	        $this->load->library('upload', $config);
            $this->upload->initialize($config);
			
			 
	        if (!$this->upload->do_upload('new_profile_pic'))
	        {
	            // case - failure
	            $upload_error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('error', 'Profile pic image type is not correct.');
				redirect(base_url().'user/dashboard/');         
	        }
	        else
	        {
	            $new_arr = array();
	    		$new_arr['insta_user_id'] = $this->input->post('user_id');
	    		$new_arr['insta_user_meta_key'] = 'profile_pic';
	    		$new_arr['insta_user_meta_value'] = $profile_pic;
	    		// $profile_pic = $this->input->post('profile_pic');
	    		// unset($profile_pic);	    		
	    		array_push($user_data, $new_arr); 
	        }
	    }else{
	    	$new_arr = array();
    		$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'profile_pic';
    		$new_arr['insta_user_meta_value'] = $this->input->post('profile_pic');
    		$profile_pic = $this->input->post('profile_pic');
    		array_push($user_data, $new_arr); 
	    }
	    $usersesn['profile_pic'] = $profile_pic;

	    $new_arr = array();
		$new_arr['insta_user_id'] = $this->input->post('user_id');
		$new_arr['insta_user_meta_key'] = 'experience';
		$new_arr['insta_user_meta_value'] = $this->input->post('exp_year').".".$this->input->post('exp_month');
		array_push($user_data, $new_arr); 
		$usersesn['experience'] = $new_arr['insta_user_meta_value'];
		
		if(!empty($this->input->post('company')))
		{
			$companyId = $this->CompanyModel->get_company_id('insta_company_name',$this->input->post('company'));
			if($companyId == 0)
			{
				$company = array();
	    		$company['insta_company_name'] = $this->input->post('company');
	    		$comp_field_arr = array('insta_company_tagline','insta_company_description','insta_company_video','insta_company_website','insta_company_google','insta_company_facebook','insta_company_linkedin','insta_company_twitter');
		    	$comp_alias = array();
			    foreach($comp_field_arr as $key)
			    {
			    	$comp_alias[$key] = $this->input->post($key);
			    }
			    $company['insta_company_alias'] = json_encode($comp_alias);

	    		$companyId = $this->CompanyModel->addCompany($company);
			}
			$new_arr = array();
			$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'company_id';
    		$new_arr['insta_user_meta_value'] = $companyId;
    		array_push($user_data, $new_arr); 
    		$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'company_name';
    		$new_arr['insta_user_meta_value'] = $this->input->post('company');
    		array_push($user_data, $new_arr); 
	    	$usersesn['company_id'] = $companyId;
	    	$usersesn['company_name'] = $this->input->post('company');
		}else{
			$new_arr = array();
			$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'company_id';
    		$new_arr['insta_user_meta_value'] = '';
    		array_push($user_data, $new_arr); 
    		$new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'company_name';
    		$new_arr['insta_user_meta_value'] = '';
    		array_push($user_data, $new_arr); 
	    	$usersesn['company_id'] = '';
	    	$usersesn['company_name'] = '';
		}
		
	    $user_keys = array('name','first_name','last_name','email','phone','gender','location','skills','why_you_get_refer');
	    $user_id = $this->input->post('user_id');
	    $usersesn['user_id'] = $user_id;
	    foreach($user_keys as $key)
	    {
	    	if(!empty($this->input->post($key)))
	    	{ 
	    		$new_arr = array();
	    		$new_arr['insta_user_id'] = $this->input->post('user_id');
	    		$new_arr['insta_user_meta_key'] = $key;
	    		$new_arr['insta_user_meta_value'] = $this->input->post($key);
	    		array_push($user_data, $new_arr); 
	    		$usersesn[$key] = $this->input->post($key);
	    	}else{
	    		$new_arr = array();
	    		$new_arr['insta_user_id'] = $this->input->post('user_id');
	    		$new_arr['insta_user_meta_key'] = $key;
	    		$new_arr['insta_user_meta_value'] = '';
	    		array_push($user_data, $new_arr);
	    		$usersesn[$key] = '';
	    	}	
	    	
	    }
	    // echo $this->input->post('email');
	     // echo "<pre>";
	     // print_r($user_data); die;
	    $this->UserModel->update_UserMeta($user_id,$user_data);
	    $this->session->set_userdata('user_session', $usersesn);
	    $this->session->set_flashdata('success', 'Your account details updated successfully.');
	   	redirect(base_url().'user/dashboard');
	}
}