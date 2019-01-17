<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __Construct()
	{
	   parent::__Construct ();
	   $this->load->model('HomeModel'); // load model 
	   $this->load->library('user_agent');
	    $this->load->model('JobModel'); // load model 
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
	public function index()
	{
		if(empty($this->session->user_session['user_id']))
		{
			$sociallogin = $this->social_login(); // Return Fb and google login urls array from main controller
			$data['login_url'] = $sociallogin[0]; // Login_url is used to get FB Login Url from main controller
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
		$data['page_title']  = "Instarefr";
		$data['page_description']  = "Login with top social media networks in just one-click.";
		
		$data['main_content'] = 'home/home';
   		$this->load->view('template',$data);
		//$this->load->view('welcome_message');
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

	public function blog()
	{
		$data['main_content'] = 'common/blog';
   		$this->load->view('template',$data);
	}

	public function fre_que()
	{
		$data['main_content'] = 'common/fre-ask-que';
   		$this->load->view('template',$data);
	}

	public function privacy_policy()
	{

		$data['main_content'] = 'common/privacy-policy';
   		$this->load->view('template',$data);
	}

	public function terms_and_condition()
	{
		$data['main_content'] = 'common/terms-and-condition';
   		$this->load->view('template',$data);
	}

	public function contact_us()
	{
		$data['main_content'] = 'common/contact-us';
   		$this->load->view('template',$data);
	}

	public function add_contact_us()
	{
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
		if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
		    //Send request and receive json data by latitude and longitude
		    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
		    $json = @file_get_contents($url);
		    $data = json_decode($json);
		    $status = $data->status;
		    if($status=="OK"){
		        //Get address from json data
		        $location = $data->results[0]->formatted_address;
		    }else{
		        $location =  '';
		    }
		    //Print address 

			$this->session->set_userdata('my_current_location',$location);

		    echo $location;
		}
	
	}
}
