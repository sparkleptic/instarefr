<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __Construct()
	{
	   parent::__Construct ();
	   $this->load->model('HomeModel'); // load model 
	   $this->load->library('user_agent');
	   $this->load->model('JobModel'); // load model 
	   $location = "";
	   if(!empty($this->session->my_current_location))
	   {
	   	 $location = $this->session->my_current_location;
	   }
	   $this->data['meta_details'] = array("title"=>"InstaRefr","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"InstaRefr is a unique platform which connects the job seekers with the employees who are willing to refer them in their companies. In today's world, there are a number of ways through which companies hire. Yet, Employee Referral Program is considered to be the most powerful and effective way to hire best talents. InstaRefr aims to use technology as a medium to help people make full use of employee referral program. Now Job seekers, don't lose an opportunity of getting a job just because you are unaware of current job openings in your dream company or you don't know anyone who can refer you. And employees, don't lose a golden chance to get referral bonus just because you do not know anyone to refer.");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($type="")
	{    
		$data['meta'] = $this->data["meta_details"];
		$google_ads = $this->google_ads();
		if(!empty($google_ads[0]->insta_google_ads))
		{
			
			$this->session->set_userdata('google_ads', urldecode($google_ads[0]->insta_google_ads));
		}
	
		if(empty($this->session->user_session['user_id']))
		{
			$sociallogin = $this->social_login(); // Return Fb and google login urls array from main controller
			$data['login_url'] = $sociallogin[0]; // Login_url is used to get FB Login Url from main controller
			if(empty($data['login_url']))
			{
				$data['login_url'] = $this->facebook->getLoginUrl(array('scope'=>'email'));
			}
			$data['googlelogin'] = $sociallogin[1]; // googlelogin is used to get Google Login Url from main controller

			$this->session->set_userdata('facebook_login_url', $data['login_url']);
			$this->session->set_userdata('google_login_url', $data['googlelogin']);
		}
		$data['job_spotlight'] = $this->JobModel->get_job_spotligh(1);
		$data['job_list'] = $this->JobModel->get_post_job_list();		
		$data['job_tags'] = $this->JobModel->get_post_job_tags();
		$data['job_category'] = $this->JobModel->getCategory('insta_job_category');
		$data['job_location'] = $this->JobModel->get_jobs_column_value('insta_job_location');
		$data['company'] = $this->JobModel->getCompany();
		$data['article_list'] = $this->HomeModel->get_article_list('',1);
		$data['page_title']  = "Instarefr";
		$data['page_description']  = "Login with top social media networks in just one-click.";
		
		$data['main_content'] = 'home/home';
   		$this->load->view('template',$data);
   		
		//$this->load->view('welcome_message');
	}

	public function set_login_url()
	{
		// if(empty($this->session->facebook_login_url))
		// {
		// 	$fb_login_url = $this->facebook->getLoginUrl(array('scope'=>'email'));
		// 	$this->session->set_userdata('facebook_login_url', $fb_login_url);
		// }
		// if(empty($this->session->google_login_url))
		// {
		// 	 $this->load->library('Google'); 
		// 	$googleobj = new Google();
		// 	$new_googleobj = $googleobj->googlelog();
  //       	$googlelogin_url = $new_googleobj; 
		// 	$this->session->set_userdata('google_login_url', $googlelogin_url);
		// }		
		//  redirect($this->session->current_url);
		$data = array();
		$sociallogin = $this->social_login(); // Return Fb and google login urls array from main controller
		$data['login_url'] = $sociallogin[0]; // Login_url is used to get FB Login Url from main controller
		if(empty($data['login_url']))
		{
			$data['login_url'] = $this->facebook->getLoginUrl(array('scope'=>'email'));
		}
		$data['googlelogin'] = $sociallogin[1]; // googlelogin is used to get Google Login Url from main controller

		$this->session->set_userdata('facebook_login_url', $data['login_url']);
		$this->session->set_userdata('google_login_url', $data['googlelogin']);
		// print_r($data);
		echo json_encode($data);
	}

	public function redirect_index()
	{
		$data['main_content'] = 'home/home';
   		$this->load->view('template',$data);
	}

	public function redirect_404()
	{
		
		//$this->router->show_404();
	}

	public function back_404()
	{
		echo $this->agent->referrer();
		//redirect($this->agent->referrer());
	}

	public function blog($id="")
	{
		$data['meta'] = $this->data["meta_details"];
		if(!empty($id))
		{
			$data['article'] = $this->HomeModel->get_article_list($id);
			$data['main_content'] = 'common/blog';
   		   $this->load->view('template',$data);
		}else{
			$data['article'] = $this->HomeModel->get_article_list('',1);
			$data['main_content'] = 'common/blog';
   		   $this->load->view('template',$data);
		}
		
	}

	public function fre_que()
	{
		$data['meta'] = $this->data["meta_details"];
		$data['main_content'] = 'common/fre-ask-que';
   		$this->load->view('template',$data);
	}

	public function privacy_policy()
	{
		$data['meta'] = $this->data["meta_details"];
		$data['main_content'] = 'common/privacy-policy';
   		$this->load->view('template',$data);
	}

	public function terms_and_condition()
	{  
		$data['meta'] = $this->data["meta_details"];
		$data['main_content'] = 'common/terms-and-condition';
   		$this->load->view('template',$data);
	}

	public function contact_us()
	{
		$data['meta'] = $this->data["meta_details"];
		$data['main_content'] = 'common/contact-us';
   		$this->load->view('template',$data);
	}

	public function add_contact_us()
	{
		$data['meta'] = $this->data["meta_details"];
		$data = array();
		$contact_field_arr = array('insta_contact_us_name','insta_contact_us_email','insta_contact_us_phone','insta_contact_us_message');
		foreach($contact_field_arr as $key)
		{
			if(!empty($this->input->post($key)))
			{
				$data[$key] = $this->input->post($key);
			}else{
				$data[$key] = '';
			}
			
		}
		$this->HomeModel->add_contact_us($data);
		//$this->session->set_flashdata('success', 'Your message has been sent successfully.');
		echo 1;
   		//redirect(base_url().'contact-us/');
	}

	public function get_location()
	{
		if(!empty($_POST['country']))
		{
			$this->session->set_userdata('my_current_location',$_POST['country']);
			echo $_POST['country'];
		}
		else if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
		    //Send request and receive json data by latitude and longitude
		    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
		    $json = @file_get_contents($url);
		    $data = json_decode($json);
		    $status = $data->status;

		    if($status=="OK"){
		        //Get address from json data
		        $location = $data->results[4]->formatted_address;
		        $this->session->set_userdata('my_current_location',$location);
		    }else{
		        $location =  0;
		        $this->session->set_userdata('my_current_location',0);
		    }
		    //Print address 

		    echo $location;
		}
	
	}
}
