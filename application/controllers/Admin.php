<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		// Load Model
		$this->load->model('AdminModel');
		$this->load->model('HomeModel');
		$this->load->model('UserModel');
		$this->load->model('JobModel');  
		$this->load->model('CompanyModel');
		$this->load->model('PointsModel');
		//$this->load->library('excel');
	}

	
	public function index()
	{
		$msg = "Welcome , You are on Admin page.";
   		$this->load->view('admin/admin-login', $msg);
		//$this->load->view('welcome_message');
	}

		

	// Check for user login process
	public function admin_login() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in']))
			{
				$data['job_count'] = $this->HomeModel->count_rows('insta_jobs');
				$data['company_count'] = $this->HomeModel->count_rows('insta_company');
				$data['candidate_count'] = $this->HomeModel->count_rows('insta_user');
				$data['job_category_count'] = $this->HomeModel->count_rows('insta_jobs');
				$data['contact_us_count'] = $this->HomeModel->count_rows('insta_contact_us');
				$data['main_content'] = "admin-dashboard";
				$this->load->view('admin/admin-template',$data);
			}else
			{
				$this->load->view('admin/admin-login');
			}
		} else {
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
			$result = $this->AdminModel->login($data);
			if ($result == TRUE) 
			{
				$username = $this->input->post('username');
				$result = $this->AdminModel->read_admin_information($username);
				if ($result != false) 
				{
					$session_data = array(
					'username' => $result[0]->insta_admin_username,
					'email' => $result[0]->insta_admin_email,
					);

					$data['job_count'] = $this->HomeModel->count_rows('insta_jobs');
					$data['company_count'] = $this->HomeModel->count_rows('insta_company');
					$data['candidate_count'] = $this->HomeModel->count_rows('insta_user');
					$data['job_category_count'] = $this->HomeModel->count_rows('insta_jobs');
					$data['contact_us_count'] = $this->HomeModel->count_rows('insta_contact_us');
					$this->session->set_userdata('logged_in', $session_data);
					$data['main_content'] = "admin-dashboard";
					$this->load->view('admin/admin-template',$data);
				}
			} 
			else 
			{
				$data = array(
				'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('admin/admin-login', $data);
			}
		}
	}



	public function listing($type) {
		if($type=="user")
		{
			$data['user_list'] = $this->AdminModel->get_user_list();
			$data['main_content'] = "admin-user-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="job")
		{
			$data['job_list'] = $this->JobModel->get_post_job_list('','','Admin');
			$data['main_content'] = "admin-post-job-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="company")
		{
			$data['company_list'] = $this->CompanyModel->get_company_list('','Admin');
			$data['main_content'] = "admin-company-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="points")
		{
			$data['points_list'] = $this->PointsModel->get_points_rule();
			$data['main_content'] = "admin-points-rule-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="points-transaction")
		{
			$data['candidate_points'] = $this->PointsModel->get_candidates_current_point_list();
			$data['main_content'] = "admin-points-transaction-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="applied-job")
		{
			$data['job_list'] = $this->AdminModel->get_applied_job_users();
			$data['main_content'] = "admin-applied-jobs-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="referred-job")
		{
			$data['job_list'] = $this->AdminModel->get_reffered_job_users();
			$data['main_content'] = "admin-referred-job-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="category")
		{
			$data['category_list'] = $this->JobModel->getCategory('Admin');
			$data['main_content'] = "admin-category-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="contact-us")
		{
			$data['contact_us_list'] = $this->HomeModel->get_contact_us();
			$data['main_content'] = "admin-contact-us-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="admin_users")
		{
			$data['backend_users'] = $this->AdminModel->get_backend_users();
			$data['main_content'] = "admin-backend_users_list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="Google_Ads")
		{
			$data['googleAds_list'] = $this->HomeModel->get_ads_detail();
			$data['main_content'] = "admin-ads-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="payment")
		{
			$data['payment_list'] = $this->PointsModel->get_payment_transaction_list();
			$data['main_content'] = "admin-payment-list";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="article")
		{
			$data['article_list'] = $this->HomeModel->get_article_list();
			$data['main_content'] = "admin-article-list";
			$this->load->view('admin/admin-template',$data);
		}
	}

	public function update($id,$type) {
		if($type=="user")
		{
			$data['user_detail'] = $this->AdminModel->get_user_list($id);
			$data['main_content'] = "admin-update-form";
			$data['type'] = "user";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="job")
		{
			$data['job_detail'] = $this->JobModel->get_post_job_list($id,'insta_job_id','Admin');
			$data['company'] = $this->JobModel->getCompany();
			$data['category'] = $this->JobModel->getCategory();
			$data['main_content'] = "admin-update-form";
			$data['type'] = "job";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="company")
		{
			$data['company_detail'] = $this->CompanyModel->get_company_list($id,'Admin');
			$data['main_content'] = "admin-update-form";
			$data['type'] = "company";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="points")
		{
			$data['point_detail'] = $this->PointsModel->get_points_rule($id,'insta_points_rule_id');
			$data['main_content'] = "admin-points-form";
			$data['type'] = "points";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="category")
		{
			$data['category_detail'] = $this->JobModel->select_rows('insta_job_category','insta_job_category_id',$id);
			$data['main_content'] = "admin-category-form";
			$data['type'] = "category";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="admin_users")
		{
			$data['admin_detail'] = $this->JobModel->select_rows('insta_admin','insta_admin_id',$id);
			$data['main_content'] = "admin-update-form";
			$data['type'] = "admin_users";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'candidate-points')
		{ 
			$data['points'] = $this->PointsModel->get_points_rule();
			$data['candidate_detail'] = $this->UserModel->get_user_data($id);
			$data['candidate_id'] = $data['candidate_detail'][0]->insta_user_id;
			$user_meta = json_decode($data['candidate_detail'][0]->user_meta);
			$data['candidate_name'] = $user_meta->first_name." ".$user_meta->last_name;
			$data['main_content'] = "admin-points-form";
			$data['type'] = "candidate-points-transaction";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="article")
		{
			$data['article_detail'] = $this->HomeModel->get_article_list($id);
			$data['main_content'] = "admin-update-form";
			$data['type'] = "article";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="Google_Ads")
		{
			$data['ads_detail'] = $this->HomeModel->get_ads_detail($id);
			$data['main_content'] = "admin-google-add-form";
			$data['type'] = "Google_Ads";
			$this->load->view('admin/admin-template',$data);
		}
	}


	public function add($type) {

		if($type=="points")
		{
			$data['main_content'] = "admin-points-form";
			$data['type'] = "points";
			$this->load->view('admin/admin-template',$data);
		}else if($type=="category")
		{
			$data['main_content'] = "admin-category-form";
			$data['type'] = "category";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'user')
		{
			$data['main_content'] = "admin-add-form";
			$data['type'] = "user";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'job')
		{
			$data['company'] = $this->CompanyModel->get_company_list();
			$data['user'] = $this->UserModel->get_user_data();
			$data['category'] = $this->JobModel->getCategory('insta_job_category');
			$data['main_content'] = "admin-add-form";
			$data['type'] = "job";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'company')
		{
			$data['main_content'] = "admin-add-form";
			$data['type'] = "company";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'admin_users')
		{
			$data['main_content'] = "admin-add-form";
			$data['type'] = "admin_users";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'Google_Ads')
		{
			$data['main_content'] = "admin-google-add-form";
			$data['type'] = "Google_Ads";
			$this->load->view('admin/admin-template',$data);
		}else if($type == 'article')
		{
			$data['main_content'] = "admin-add-form";
			$data['type'] = "article";
			$this->load->view('admin/admin-template',$data);
		}
	}

	public function add_points_rule() {
		//print_r($this->input->post());
		$point_key = array('insta_points_rule_name','insta_points_rule_amount','insta_points_rule_type','insta_points_rule_status','insta_points_rule_description');
		$point_arr = array();
		foreach($point_key as $key)
		{
	    	$point_arr[$key] = $this->input->post($key);
		}

		$this->PointsModel->addPoints($point_arr);
		$this->session->set_flashdata('success', 'Point rule added successfully.');
		redirect(base_url().'admin/listing/points/');
	}

	public function update_job_status()
	{
		$job = array(); //echo "<pre>"; print_r($this->input->post()); die;
		if(!empty($this->input->post('insta_job_id')))
		{
			if($this->input->post('insta_job_spotlight') == 1 && $this->input->post('insta_job_status') == 0)
			{
				$this->session->set_flashdata('warning', 'This job is in spotlight, you can not disable it.');		
		    	redirect(base_url().'admin/listing/job/');
			}
			if($this->input->post('insta_job_status') == 1 && $this->input->post('insta_job_updated_round') == 1)
			{
				$job['insta_job_status'] = $this->input->post('insta_job_status');
				$job['insta_job_updated_round'] = 0;
				$this->db->where('insta_job_id', $this->input->post('insta_job_id'));
				//$this->db->where('insta_user_id', $this->input->post('insta_user_id'));
			    $this->db->update('insta_jobs', $job);
			    if(!empty($this->input->post('insta_user_id')))	
			    {
			    	$this->PointsModel->points_transaction('Post Job',$this->input->post('insta_user_id'));
			    }				
				$this->session->set_flashdata('success', 'Job status updated successfully.');
				redirect(base_url().'admin/listing/job/');
			}else{

				$job['insta_job_status'] = $this->input->post('insta_job_status');
				$this->db->where('insta_job_id', $this->input->post('insta_job_id'));
				//$this->db->where('insta_user_id', $this->input->post('insta_user_id'));
			    $this->db->update('insta_jobs', $job);
				$this->session->set_flashdata('success', 'Job status updated successfully.');
				redirect(base_url().'admin/listing/job/');
			}
		}else{
			$this->session->set_flashdata('error', 'Sorry! Some error occurred.');
			redirect(base_url().'admin/listing/job/');
		}
		
	}

	// public function add_candidate_points() {
	// 	//print_r($this->input->post()); die;
	// 	$candidate_transaction = array();
	// 	if(!empty($this->input->post('insta_user_id')))
	// 	{
	// 		if(!empty($this->input->post('insta_points_rule_id')))
	// 		{
	// 			$candidate_transaction['insta_points_rule_id'] = $this->input->post('insta_points_rule_id');
	// 		}else{
	// 			$candidate_transaction['insta_points_rule_id'] = 8;
	// 		}
			
	// 		$candidate_transaction['insta_points_user_id'] = $this->input->post('insta_user_id');
	// 		$currrent_points =  intval($this->PointsModel->get_users_current_points($this->input->post('insta_user_id')));

	// 		if($this->input->post('insta_points_rule_type') == 'Debit')
	// 		{
	// 			$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_transaction_amount')), 10);
	// 			$candidate_transaction['insta_points_transaction_current_points'] = $currrent_points - $int;
	// 			$candidate_transaction['insta_points_transaction_amount'] = '- '.$int;
	// 		}else{
	// 			$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_transaction_amount')), 10);
	// 			$candidate_transaction['insta_points_transaction_current_points'] = $currrent_points + $int;
	// 			$candidate_transaction['insta_points_transaction_amount'] = '+ '.$int;
	// 		} 


	// 		$this->db->insert('insta_points_transaction', $candidate_transaction);
	// 		$pointId = $this->db->insert_id();

			

	// 		if($this->db->insert_id())
	// 		{
	// 			$custom_description = array();
	// 			$custom_description['insta_custom_transaction_details'] = $this->input->post('insta_custom_transaction_details');
	// 			$custom_description['insta_points_transaction_id'] = $pointId;

	// 			$this->db->insert('insta_custom_points_description', $custom_description);
				
	// 			$this->session->set_flashdata('success', intval(preg_replace('/[^0-9]+/', '', $data['insta_points_transaction_amount']), 10)." points has been ".$msg.". Your current balance is ".$data['insta_points_transaction_current_points']);

	// 			$user_email = $this->AdminModel->get_usermeta_byKeyId($this->input->post('insta_user_id'),'email'); 
	// 			if($user_email)
	// 			{
	// 				$to = $user_email;
	// 				$sub = "Instarefr Points Transaction";
	// 				$msg = "Hello ".$this->session->user_session['first_name']." ".$this->session->user_session['last_name']." , <br>The points has been ".$msg." according rule `$point_rule_name`. Your current balance is ".$data['insta_points_transaction_current_points'];
	// 				$this->load->model('HomeModel');	
	// 				$this->HomeModel->sendMail($sub, $msg, $to, '');
	// 			}

	// 			$this->session->set_flashdata('success', 'Candidate points transaction updated successfully.');
	// 			redirect(base_url().'admin/listing/points-transaction/');	
				
	// 		}
			
	// 	}
		
	// }

	public function add_candidate_points() {
		//print_r($this->input->post()); die;
		$candidate_transaction = array();
		if(!empty($this->input->post('insta_user_id')))
		{
			if(!empty($this->input->post('insta_points_rule_id')))
			{
				$candidate_transaction['insta_points_rule_id'] = $this->input->post('insta_points_rule_id');
			}else{
				$candidate_transaction['insta_points_rule_id'] = 8;
			}
			
			$candidate_transaction['insta_points_user_id'] = $this->input->post('insta_user_id');
			$currrent_points =  intval($this->PointsModel->get_users_current_points($this->input->post('insta_user_id')));

			if($this->input->post('insta_points_rule_type') == 'Debit')
			{
				$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_transaction_amount')), 10);
				$candidate_transaction['insta_points_transaction_current_points'] = $currrent_points - $int;
				$candidate_transaction['insta_points_transaction_amount'] = '- '.$int;
				$type = "Debited";
			}else{
				$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_transaction_amount')), 10);
				$candidate_transaction['insta_points_transaction_current_points'] = $currrent_points + $int;
				$candidate_transaction['insta_points_transaction_amount'] = '+ '.$int;
				$type = "Credited";
			} 


			$this->db->insert('insta_points_transaction', $candidate_transaction);
			$pointId = $this->db->insert_id();

			

			if($this->db->insert_id())
			{
				$custom_description = array();
				$custom_description['insta_custom_transaction_details'] = $this->input->post('insta_custom_transaction_details');
				$custom_description['insta_points_transaction_id'] = $pointId;

				$this->db->insert('insta_custom_points_description', $custom_description);
				
				$this->session->set_flashdata('success', intval(preg_replace('/[^0-9]+/', '', $candidate_transaction['insta_points_transaction_amount']), 10)." points has been ".$type.". Your current balance is ".$candidate_transaction['insta_points_transaction_current_points']);

				$user_email = $this->AdminModel->get_usermeta_byKeyId($this->input->post('insta_user_id'),'email'); 
				if($user_email)
				{
					$to = $user_email;
					$sub = "Instarefr Points Transaction";
					$msg = "Hello ".$this->session->user_session['first_name']." ".$this->session->user_session['last_name']." , <br>The points has been ".$type.". Your current balance is ".$candidate_transaction['insta_points_transaction_current_points'];
					$this->load->model('HomeModel');	
					$this->HomeModel->sendMail($sub, $msg, $to, '');
				}

				$this->session->set_flashdata('success', 'Candidate points transaction updated successfully.');
				redirect(base_url().'admin/listing/points-transaction/');	
				
			}
			
		}
		
	}

	public function delete($Id,$type) {
		if($type=="user")
		{
			$this->PointsModel->deleteUserTransactions($Id);	
			$this->UserModel->delete_UserMeta($Id);
			$this->UserModel->delete_User($Id);	
			$this->session->set_flashdata('success', 'Candidate deleted successfully.');		
			 redirect(base_url().'admin/listing/user');
		}
		else if($type=="job")
		{
			$this->JobModel->deleteJob($Id);	
			$this->session->set_flashdata('success', 'Job deleted successfully.');			
			redirect(base_url().'admin/listing/job');
		}
		else if($type=="company")
		{
			$this->CompanyModel->deleteCompany($Id);
			$this->session->set_flashdata('success', 'Company deleted successfully.');				
			redirect(base_url().'admin/listing/company');
		}
		else if($type=="points")
		{
			$this->PointsModel->deletePoints($Id);		
			$this->session->set_flashdata('success', 'Points rule deleted successfully.');		
			redirect(base_url().'admin/listing/points/');
		}
		else if($type=="category")
		{
			$this->JobModel->deleteCategory($Id);	
			$this->session->set_flashdata('success', 'Category deleted successfully.');			
			redirect(base_url().'admin/listing/category/');
		}
		else if($type=="admin_uesrs")
		{
			$this->AdminModel->deleteAdmin($Id);	
			$this->session->set_flashdata('success', 'User deleted successfully.');			
			redirect(base_url().'admin/listing/admin_uesrs/');
		}
		else if($type=="contact_us")
		{
			$this->HomeModel->deleteContactUs($Id);	
			$this->session->set_flashdata('success', 'Deleted successfully.');			
			redirect(base_url().'admin/listing/contact-us/');
		}
		else if($type=="Google_Ads")
		{
			$this->HomeModel->deleteGoogleAds($Id);	
			$this->session->set_flashdata('success', 'Deleted successfully.');			
			redirect(base_url().'admin/listing/Google_Ads/');
		}
	}


	public function add_details($type) {
		if($type=="google_ads")
		{
			$ads = array();
			$ads['insta_google_ads'] = urlencode($this->input->post('insta_google_ads'));
			$ads['insta_google_ads_status'] = $this->input->post('insta_google_ads_status');
			$this->db->insert('insta_google_ads', $ads);
			$this->session->set_flashdata('success', 'Google ads script added successfully.');		
			redirect(base_url().'admin/listing/Google_Ads/');
		}
		else if($type=="article")
		{
			$article_fields = array('insta_article_title','insta_article_description',
		    	'insta_article_status');
			$article_arr = array();
			foreach($article_fields as $key)
		    {
		    	$article_arr[$key] = $this->input->post($key);
		    }
		    $articleId = $this->HomeModel->add_article($article_arr);
		    if($articleId)
		    {
		    	$this->session->set_flashdata('success', 'Article added successfully.');	
		    	redirect(base_url().'admin/listing/article/');	
		    }else{
		    	$this->session->set_flashdata('error', 'Sorry! Some error occured.');
		    	redirect(base_url().'admin/add/article/');	
		    }
		}
		else if($type=="user")
		{
			
			$getuser = $this->UserModel->userAlreadyExists('',$this->input->post('insta_user_login_type'),$this->input->post('email'));
			$data[] = $this->input->post();
			if (count($getuser['user']) == 0) 
			{ 
					$user = array();
					$user['insta_user_login_type'] = $this->input->post('insta_user_login_type');
					if($this->input->post('insta_user_login_type') == 'google')
					{
						$user['insta_user_email_google'] = $this->input->post('email');
					}else if($this->input->post('insta_user_login_type') == 'facebook')
					{
						$user['insta_user_email_facebook'] = $this->input->post('email');
					}else if($this->input->post('insta_user_login_type') == 'linkedin')
					{
						$user['insta_user_email_linkedin'] = $this->input->post('insta_user_status');
					}
					$user['insta_user_status'] = $this->input->post('insta_user_status');
					$user_id = $this->UserModel->addUser($user);		
					if($user_id > 0)
					{
							$user_data = array();

						
							if(!empty($_FILES["new_resume"]["name"]))
							{
								$date = strtotime(date('m/d/Y h:i:s a', time()));
								if (!is_dir('./upload/user/'.$user_id.'_user')) 
								{
								     mkdir('./upload/user/'.$user_id.'_user', 0777, TRUE);

								}
								$path = './upload/user/'.$user_id.'_user/';
								//set preferences
								$file_name = $_FILES["new_resume"]['name'];
								$lastDot = strrpos($file_name, ".");
								$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
								$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
								$config = array();
						        $config['upload_path'] = $path;
						        $config['allowed_types'] = '*';
						        $config['max_size']    = '1000';
						        $config['file_name'] = $newfile_name;

						        //load upload class library
						        $this->load->library('upload', $config);
                				$this->upload->initialize($config);
								$resume = $user_id.'_user/'.$config['file_name'];
								 
						        if (!$this->upload->do_upload('new_resume'))
						        {
						            $upload_error = array('error' => $this->upload->display_errors());
						            $this->session->set_flashdata('error', 'Resume file type is not correct.');         
									redirect(base_url().'user/dashboard/');     
						        }
						        else
						        {
						            $new_arr = array();
						    		$new_arr['insta_user_id'] = $user_id;
						    		$new_arr['insta_user_meta_key'] = 'resume';
						    		$new_arr['insta_user_meta_value'] = $resume;
						    		// $resume = $this->input->post('resume');
						    		// unset($resume);
						    		array_push($user_data, $new_arr); 
						        }
						    }else
						    {
						    	$new_arr = array();
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'resume';
								$new_arr['insta_user_meta_value'] = $this->input->post('resume');
								$resume = $this->input->post('resume');
								array_push($user_data, $new_arr); 
						    }
						   

						    if(!empty($_FILES["new_profile_pic"]["name"]))
							{

								$date = strtotime(date('m/d/Y h:i:s a', time()));
								if (!is_dir('./upload/user/'.$user_id.'_user')) 
								{
								     mkdir('./upload/user/'.$user_id.'_user', 0777, TRUE);

								}
								$path = './upload/user/'.$user_id.'_user/';
								
								$file_name = $_FILES["new_profile_pic"]["name"];
								$lastDot = strrpos($file_name, ".");
								$newfile_name1 = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
								//$extension = pathinfo($newfile_name, PATHINFO_EXTENSION);
								$newfile_name1       = $date.'_'.str_replace(' ', '_', $newfile_name1);
								$config = array();
						        $config['upload_path'] = $path;
						        $config['allowed_types'] = 'gif|jpg|png';
						        $config['max_size']    = '1000';
						        $config['file_name'] = $newfile_name1;
						        $profile_pic = $user_id.'_user/'.$config['file_name'];
						        //load upload class library
						        $this->load->library('upload', $config);
                				$this->upload->initialize($config);
								
								 
						        if (!$this->upload->do_upload('new_profile_pic'))
						        {
						            // case - failure
						            $upload_error = array('error' => $this->upload->display_errors());
						            $this->session->set_flashdata('error', 'Profile pic image type is not correct.');
									redirect(base_url().'admin/listing/user');         
						        }
						        else
						        {
						            $new_arr = array();
						    		$new_arr['insta_user_id'] = $user_id;
						    		$new_arr['insta_user_meta_key'] = 'profile_pic';
						    		$new_arr['insta_user_meta_value'] = $profile_pic;
						    		// $profile_pic = $this->input->post('profile_pic');
						    		// unset($profile_pic);	    		
						    		array_push($user_data, $new_arr); 
						        }	
						    }else{
						    	$new_arr = array();
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'profile_pic';
								$new_arr['insta_user_meta_value'] = '';
								array_push($user_data, $new_arr); 
						    }
						    
						    $new_arr = array();
							$new_arr['insta_user_id'] = $user_id;
							$new_arr['insta_user_meta_key'] = 'experience';
							$new_arr['insta_user_meta_value'] = $this->input->post('exp_year').".".$this->input->post('exp_month');
							array_push($user_data, $new_arr); 
							
							
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
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'company_id';
								$new_arr['insta_user_meta_value'] = $companyId;
								array_push($user_data, $new_arr); 
								$new_arr = array();
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'company_name';
								$new_arr['insta_user_meta_value'] = $this->input->post('company');
								array_push($user_data, $new_arr); 
						    	
							}else{
								$new_arr = array();
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'company_id';
								$new_arr['insta_user_meta_value'] = '';
								array_push($user_data, $new_arr); 
								$new_arr = array();
								$new_arr['insta_user_id'] = $user_id;
								$new_arr['insta_user_meta_key'] = 'company_name';
								$new_arr['insta_user_meta_value'] = '';
								array_push($user_data, $new_arr); 
						    	
							}
							
						    $user_keys = array('name','first_name','last_name','email','phone','gender','location','skills','why_you_get_refer');
						    $user_id = $user_id;
						    $usersesn['user_id'] = $user_id;
						    foreach($user_keys as $key)
						    {
						    	if(!empty($this->input->post($key)))
						    	{ 
						    		$new_arr = array();
						    		$new_arr['insta_user_id'] = $user_id;
						    		$new_arr['insta_user_meta_key'] = $key;
						    		$new_arr['insta_user_meta_value'] = $this->input->post($key);
						    		array_push($user_data, $new_arr); 		    		
						    	}else{
						    		$new_arr = array();
						    		$new_arr['insta_user_id'] = $user_id;
						    		$new_arr['insta_user_meta_key'] = $key;
						    		$new_arr['insta_user_meta_value'] = '';
						    		array_push($user_data, $new_arr);		    		
						    	}	
						    	
						    } 
						    $new_arr = array();
				    		$new_arr['insta_user_id'] = $user_id;
				    		$new_arr['insta_user_meta_key'] = 'total_updated_round';
				    		$new_arr['insta_user_meta_value'] = '1';
						    array_push($user_data, $new_arr);	

						    
						    
						    $this->session->set_flashdata('success', 'Candidate added successfully.');
						    $this->UserModel->add_UserMeta($user_data);
						    redirect(base_url().'admin/listing/user/');  
					}else {
						 $this->session->set_flashdata('error', 'Soory! Some Error occured.');
						redirect(base_url().'admin/add/user/');  
					}
					
			}else{
				 $this->session->set_flashdata('info', 'This Candidate already exist.');
				redirect(base_url().'admin/add/user/');  
			}

		}
		else if($type=="job")
		{  
			$job_arr = array();
			//print_r($this->input->post()); 
			if((empty($this->input->post('insta_user_id')) || $this->input->post('insta_user_id') == "Select")  && (empty($this->input->post('insta_company_id')) || $this->input->post('insta_company_id') == "Select"))
			{
				$this->session->set_flashdata('warning', 'Please select any company name.');		
		    	redirect(base_url().'admin/add/job/');    
			}
			// else if($this->input->post('insta_user_id') != "" && $this->input->post('insta_user_id') != "Select" && $this->input->post('insta_company_id') != "" && $this->input->post('insta_company_id') != "Select")
			// {
			// 	$this->session->set_flashdata('warning', 'Please select only one company name or candidate name');		
		 //    	redirect(base_url().'admin/add/job/');  
			// }
			else if($this->input->post('insta_job_spotlight') == 1 && $this->input->post('insta_job_status') == 0)
			{
				 $this->session->set_flashdata('warning', 'Please select enable jobs for spotlight.');		
		    	redirect(base_url().'admin/add/job/');    
			}

			if(!empty($this->input->post('insta_company_id')) && $this->input->post('insta_company_id') != "Select")
			{
				if(!empty($_FILES["insta_job_featured_image"]["name"]))
				{
					$date = strtotime(date('m/d/Y h:i:s a', time()));
					if (!is_dir('./upload/user/company_jobs')) 
					{
					     mkdir('./upload/user/company_jobs', 0777, TRUE);

					}
					$path = './upload/user/company_jobs/';
					
					$file_name = $_FILES["insta_job_featured_image"]["name"];
					$lastDot = strrpos($file_name, ".");
				    $newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
				    $newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
			        $config['upload_path'] = $path;
			        $config['allowed_types'] = 'gif|jpg|png';
			        $config['max_size']    = '1000';
			        $config['file_name'] = $newfile_name;
			        $featured_img = 'company_jobs/'.$config['file_name'];
			        //load upload class library
			        $this->load->library('upload', $config);
					
					 
			        if (!$this->upload->do_upload('insta_job_featured_image'))
			        {
			            // case - failure
			            $upload_error = array('error' => $this->upload->display_errors());
			            $this->session->set_flashdata('error', 'featured image type is not correct.');
						redirect(base_url().'admin/add/job/');             
			        }
			        else
			        {
			            
			    		$job_arr['insta_job_featured_image'] = $featured_img;
			        }
			    }else{
			    	$job_arr['insta_job_featured_image'] = "";
			    }
			    $company['insta_company_status'] = 0;
			    $job_arr['insta_job_status'] = 0;
			    $job_arr['insta_job_min_experience'] = $this->input->post('insta_job_min_experience');
			    $job_arr['insta_job_max_experience'] = $this->input->post('insta_job_max_experience');

			    
			    if(!empty($this->input->post('insta_job_closing_date')))
			    {
		    	if( strtotime($this->input->post('insta_job_closing_date')) < strtotime(date("Y-m-d")) || strtotime($this->input->post('insta_job_closing_date')) == strtotime(date("Y-m-d"))) {
		    		$this->session->set_flashdata('warning', 'You cannot select closing date past than tomorrow.');
					//redirect(base_url().'post-a-job/');
		    	}

		    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime($this->input->post('insta_job_closing_date')));
			    }else{
			    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
			    }	    
			  
			 	
			   
			    $job_fields = array('insta_user_id','insta_job_title','insta_job_application_email','insta_job_description','insta_job_category','insta_job_tags','insta_job_location','insta_job_min_experience','insta_job_max_experience','insta_job_spotlight');

			    foreach($job_fields as $key)
			    {
			    	if(!empty($this->input->post($key)))
			    	{ 
			    		if($key == 'insta_job_spotlight' && $this->input->post($key) == 1)
			    		{
			    			$spotlight = array();
			    			$spotlight['insta_job_spotlight'] = 0;
			    			$this->db->update('insta_jobs', $spotlight);
			    		}
			    		$job_arr[$key] = $this->input->post($key);
			    		   		
			    	}else{	    		
			    		$job_arr[$key] = "";
			    	}	
			    	
			    }
			    $job_arr['insta_company_id'] = $this->input->post('insta_company_id');
			 	if($this->input->post('insta_job_status') == 1)
			    {
			    	$job_arr['insta_job_updated_round'] = 0;
			    }else{
			    	$job_arr['insta_job_updated_round'] = 1;
			    }
			    // echo "<pre>";
			    // print_r($job_arr); die;
			    $jobId = $this->JobModel->addJob($job_arr);
			    $this->session->set_flashdata('success', 'Job added successfully.');		
			    redirect(base_url().'admin/listing/job/');  
			}
			else if(!empty($this->input->post('insta_user_id'))){
				if(!empty($_FILES["insta_job_featured_image"]["name"]))
				{
					$date = strtotime(date('m/d/Y h:i:s a', time()));
					if (!is_dir('./upload/user/'.$this->input->post('insta_user_id').'_user')) 
					{
					     mkdir('./upload/user/'.$this->input->post('insta_user_id').'_user', 0777, TRUE);

					}
					$path = './upload/user/'.$this->input->post('insta_user_id').'_user/';
					
					$file_name = $_FILES["insta_job_featured_image"]["name"];
					$lastDot = strrpos($file_name, ".");
				    $newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
				    $newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
			        $config['upload_path'] = $path;
			        $config['allowed_types'] = 'gif|jpg|png';
			        $config['max_size']    = '1000';
			        $config['file_name'] = $newfile_name;
			        $featured_img = $this->input->post('insta_user_id').'_user/'.$config['file_name'];
			        //load upload class library
			        $this->load->library('upload', $config);
					
					 
			        if (!$this->upload->do_upload('insta_job_featured_image'))
			        {
			            // case - failure
			            $upload_error = array('error' => $this->upload->display_errors());
			            $this->session->set_flashdata('error', 'featured image type is not correct.');
						redirect(base_url().'admin/add/job/');             
			        }
			        else
			        {
			            
			    		$job_arr['insta_job_featured_image'] = $featured_img;
			        }
			    }else{
			    	$job_arr['insta_job_featured_image'] = "";
			    }
			    $company['insta_company_status'] = 0;
			    $job_arr['insta_job_status'] = 0;
			    $job_arr['insta_job_min_experience'] = $this->input->post('insta_job_min_experience');
			    $job_arr['insta_job_max_experience'] = $this->input->post('insta_job_max_experience');

			    
			    if(!empty($this->input->post('insta_job_closing_date')))
			    {
		    	if( strtotime($this->input->post('insta_job_closing_date')) < strtotime(date("Y-m-d")) || strtotime($this->input->post('insta_job_closing_date')) == strtotime(date("Y-m-d"))) {
		    		$this->session->set_flashdata('warning', 'You cannot select closing date past than tomorrow.');
					//redirect(base_url().'post-a-job/');
		    	}

		    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime($this->input->post('insta_job_closing_date')));
			    }else{
			    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
			    }


			    if(!empty($this->input->post('insta_user_id')))
			    {
			    	   $company_id = $this->UserModel->get_usermeta_byKeyId($this->input->post('insta_user_id'),'company_id'); 
					    if($company_id == "")
					    {
					    	$this->session->set_flashdata('warning', 'Company name is not available from this user.');
							redirect(base_url().'admin/add/job/');  
					    }
			    		$job_arr['insta_company_id'] = $company_id;
			    }else{
			    	$this->session->set_flashdata('warning', 'Please select candidate to post this job.');
				    redirect(base_url().'admin/add/job/');  
			    }
			  
			 	
			   
			    $job_fields = array('insta_user_id','insta_job_title','insta_job_application_email','insta_job_description','insta_job_category','insta_job_tags','insta_job_location','insta_job_min_experience','insta_job_max_experience','insta_job_spotlight');

			    foreach($job_fields as $key)
			    {
			    	if(!empty($this->input->post($key)))
			    	{ 
			    		if($key == 'insta_job_spotlight' && $this->input->post($key) == 1)
			    		{
			    			$spotlight = array();
			    			$spotlight['insta_job_spotlight'] = 0;
			    			$this->db->update('insta_jobs', $spotlight);
			    		}
			    		$job_arr[$key] = $this->input->post($key);
			    		   		
			    	}else{	    		
			    		$job_arr[$key] = "";
			    	}	
			    	
			    }

			 	if($this->input->post('insta_job_status') == 1)
			    {
			    	$this->PointsModel->points_transaction('Post Job',$this->input->post('insta_user_id'));
			    	$job_arr['insta_job_updated_round'] = 0;
			    }else{
			    	$job_arr['insta_job_updated_round'] = 1;
			    }
			    // echo "<pre>";
			    // print_r($job_arr); die;
			    $jobId = $this->JobModel->addJob($job_arr);
			     $this->session->set_flashdata('success', 'Job added successfully.');		
			    redirect(base_url().'admin/listing/job/');
			}
			
			
			           
		}
		else if($type=="company")
		{
			$company_arr = array();
			$comp_alias = array();
			if(!empty($_FILES["insta_company_logo"]["name"]))
			{

				$date = strtotime(date('m/d/Y h:i:s a', time()));
				
				$path = './upload/company/';
				
				$file_name = $_FILES["insta_company_logo"]["name"];
				$lastDot = strrpos($file_name, ".");
				$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
				$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
		        $config['upload_path'] = $path;
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size']    = '1000';
		        $config['file_name'] = $newfile_name;
		        $logo = $config['file_name']; 
		        //load upload class library
		        $this->load->library('upload', $config);
				
				 
		        if (!$this->upload->do_upload('insta_company_logo'))
		        {
		            // case - failure
		            $upload_error = array('error' => $this->upload->display_errors());
		           $this->session->set_flashdata('success', 'Company logo image type is not correct.');	
		        }
		        else
		        {
		            $comp_alias['insta_company_logo'] = $logo;    		   		
		    	}
		    }else{
		    	$comp_alias['insta_company_logo'] = '';
		    }
		    $company_arr['insta_company_name'] = $this->input->post('insta_company_name');	
		    $company_arr['insta_company_status'] = $this->input->post('insta_company_status');	
		    $comp_field_arr = array('insta_company_tagline','insta_company_description','insta_company_video','insta_company_website','insta_company_google','insta_company_facebook','insta_company_linkedin','insta_company_twitter');
		    
		    foreach($comp_field_arr as $key)
		    {
		    	$comp_alias[$key] = $this->input->post($key);
		    }
		    $company_arr['insta_company_alias'] = json_encode($comp_alias);
		  
		    $this->CompanyModel->addCompany($company_arr);
		     $this->session->set_flashdata('success', 'Company added successfully.');					
			redirect(base_url().'admin/listing/company');
		}
		else if($type=="admin_users")
		{
		
			$admin_arr = array();
		    $this->db->select("*"); 
			$this->db->from('insta_admin');
			
			$this->db->where('insta_admin_email', $this->input->post('insta_admin_email'));
			$this->db->where('insta_admin_username', $this->input->post('insta_admin_username'));
			$this->db->where('insta_admin_password', $this->input->post('insta_admin_password'));
			$this->db->where('insta_admin_type', $this->input->post('insta_admin_type'));

			$query = $this->db->get();
			$row = $query->result();
			
			if(!empty($row))
			{
				$this->session->set_flashdata('error', 'Same details already exist.');		
				redirect(base_url().'admin/add/admin_users');
			}
			else{ 
				 $admin_field_arr = array('insta_admin_email','insta_admin_username','insta_admin_password','insta_admin_type','insta_admin_status','insta_admin_name');
		    
			    foreach($admin_field_arr as $key)
			    {
			    	$admin_arr[$key] = $this->input->post($key);
			    }
			    
			  
			    $this->AdminModel->add_admin($admin_arr);	
			    $this->session->set_flashdata('success', 'User added successfully.');		
				redirect(base_url().'admin/listing/admin_users');
			}
		   
		}
		
	}

	public function edit_details($type) { 
		if($type=="google_ads")
		{
			$ads = array();
			$ads['insta_google_ads'] = urlencode($this->input->post('insta_google_ads'));
			$ads['insta_google_ads_status'] = $this->input->post('insta_google_ads_status');
		
			$this->db->where('insta_google_ads_id', $this->input->post('insta_google_ads_id'));
		    $this->db->update('insta_google_ads', $ads);
		    $this->session->set_flashdata('success', 'Google ads script updated successfully.');		
			redirect(base_url().'admin/listing/Google_Ads/');
		    return true;
		} 
		else if($type=="admin_users")
		{ 
			$admin_arr = array();
		    $this->db->select("*"); 
			$this->db->from('insta_admin');
			
			$this->db->where('insta_admin_email', $this->input->post('insta_admin_email'));
			$this->db->where('insta_admin_username', $this->input->post('insta_admin_username'));
			$this->db->where('insta_admin_password', $this->input->post('insta_admin_password'));
			$this->db->where('insta_admin_type', $this->input->post('insta_admin_type'));
			$this->db->where('insta_admin_id', $this->input->post('insta_admin_type'));
			$this->db->where("insta_admin_id !=",$this->input->post('insta_admin_id'));

			$query = $this->db->get();
			$row = $query->result();
			
			if(!empty($row))
			{
				$this->session->set_flashdata('error', 'Same details already exist.');		
				redirect(base_url().'admin/update/'.$this->input->post('insta_admin_id').'/admin_users');
			}
			else{ 
				 $admin_field_arr = array('insta_admin_email','insta_admin_username','insta_admin_password','insta_admin_type','insta_admin_status','insta_admin_name');
		    
			    foreach($admin_field_arr as $key)
			    {
			    	$admin_arr[$key] = $this->input->post($key);
			    }
			    
			   
			    $this->AdminModel->update_admin($admin_arr , $this->input->post('insta_admin_id'));
			    $this->session->set_flashdata('success', 'User Updated successfully.');		
				redirect(base_url().'admin/listing/admin_users');
			}
		   
		}else if($type=="article")
		{
			$article_fields = array('insta_article_title','insta_article_description',
		    	'insta_article_status');
			$article_arr = array();
			foreach($article_fields as $key)
		    {
		    	$article_arr[$key] = $this->input->post($key);
		    }
		    $article = $this->HomeModel->update_article($article_arr,$this->input->post('insta_article_id'));
		    if($article)
		    {
		    	$this->session->set_flashdata('success', 'Article updated successfully.');	
		    	redirect(base_url().'admin/listing/article/');	
		    }else{
		    	$this->session->set_flashdata('error', 'Sorry! Some error occured.');
		    	redirect(base_url().'admin/update/'.$this->input->post('insta_article_id').'/article/');	
		    }

		}else if($type=="user")
		{
			$data[] = $this->input->post();
			
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
		            //print_r($upload_error);
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
					redirect(base_url().'admin/listing/user');         
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
	    		// $profile_pic = $this->input->post('profile_pic');
	    		// unset($profile_pic);	    		
	    		array_push($user_data, $new_arr); 
		    }
		    
		    
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
	    		$new_arr = array();
	    		$new_arr['insta_user_id'] = $this->input->post('user_id');
	    		$new_arr['insta_user_meta_key'] = 'company_name';
	    		$new_arr['insta_user_meta_value'] = $this->input->post('company');
	    		array_push($user_data, $new_arr); 
		    	
			}

			$new_arr = array();
			$new_arr['insta_user_id'] = $this->input->post('user_id');
			$new_arr['insta_user_meta_key'] = 'experience';
			$new_arr['insta_user_meta_value'] = $this->input->post('exp_year').".".$this->input->post('exp_month');
			array_push($user_data, $new_arr); 

		    $user_keys = array('name','first_name','last_name','email','skills','phone','gender','location');
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
		   	$new_arr = array();
		    $new_arr['insta_user_id'] = $this->input->post('user_id');
    		$new_arr['insta_user_meta_key'] = 'total_updated_round';
    		$new_arr['insta_user_meta_value'] = '';
    		array_push($user_data, $new_arr);
		  // echo "<pre>"; print_r($user_data); die;
		    $this->session->set_flashdata('success', 'Candidate Updated successfully.');		
		    $this->UserModel->update_UserMeta($user_id,$user_data);
		    redirect(base_url().'admin/listing/user');
		   
	    
		}
		else if($type=="job")
		{ 
			
			$job_arr = array();
			if($this->input->post('insta_job_spotlight') == 1 && $this->input->post('insta_job_status') == 0)
			{
				$this->session->set_flashdata('warning', 'Please select enable jobs for spotlight.');		
		    	redirect(base_url().'admin/update/'.$this->input->post('insta_job_id').'/job/');    
			}

			else if(empty($this->input->post('insta_company_id')) || $this->input->post('insta_company_id')=='Select')
			{
				$this->session->set_flashdata('warning', 'Please select Company.');		
		    	redirect(base_url().'admin/update/'.$this->input->post('insta_job_id').'/job/');   
			}

			else if(empty($this->input->post('insta_user_id')))
			{
					if(!empty($_FILES["insta_job_featured_image"]["name"]))
					{
						$date = strtotime(date('m/d/Y h:i:s a', time()));
						if (!is_dir('./upload/user/company_jobs')) 
						{
						     mkdir('./upload/user/company_jobs', 0777, TRUE);

						}
						$path = './upload/user/company_jobs/';
						
						$file_name = $_FILES["insta_job_featured_image"]["name"];
						$lastDot = strrpos($file_name, ".");
					    $newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
					    $newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
				        $config['upload_path'] = $path;
				        $config['allowed_types'] = 'gif|jpg|png';
				        $config['max_size']    = '1000';
				        $config['file_name'] = $newfile_name;
				        $featured_img = 'company_jobs/'.$config['file_name'];
				        //load upload class library
				        $this->load->library('upload', $config);
						
						 
				        if (!$this->upload->do_upload('insta_job_featured_image'))
				        {
				            // case - failure
				            $upload_error = array('error' => $this->upload->display_errors());
				            $this->session->set_flashdata('error', 'featured image type is not correct.');
							redirect(base_url().'admin/add/job/');             
				        }
				        else
				        {
				            
				    		$job_arr['insta_job_featured_image'] = $featured_img;
				        }
					}
					    $company['insta_company_status'] = 0;
					    // $job_arr['insta_job_min_experience'] = $this->input->post('job_min_exp_month').'.'.$this->input->post('job_min_exp_year');
					    // $job_arr['insta_job_max_experience'] = $this->input->post('job_max_exp_month').'.'.$this->input->post('job_max_exp_year');
					    // $job_arr['insta_job_status'] = $this->input->post('insta_job_status');
					    $job_fields = array('insta_user_id','insta_company_id',
					    	'insta_job_title','insta_job_application_email','insta_job_description','insta_job_closing_date','insta_job_category','insta_job_tags','insta_job_location','insta_job_status','insta_job_spotlight');
					   
					    foreach($job_fields as $key)
					    {
					    	if($key == 'insta_job_spotlight' && $this->input->post($key) == 1)
				    		{
				    			$spotlight = array();
				    			$spotlight['insta_job_spotlight'] = 0;
				    			$this->db->update('insta_jobs', $spotlight);
				    		}
					    	$job_arr[$key] = $this->input->post($key);    		
					    }
					    $job_arr['insta_job_min_experience'] = $this->input->post('insta_job_min_experience');
				        $job_arr['insta_job_max_experience'] = $this->input->post('insta_job_max_experience');

				        if(!empty($this->input->post('insta_job_closing_date')))
					    {
					    	if( strtotime($this->input->post('insta_job_closing_date')) < strtotime(date("Y-m-d")) || strtotime($this->input->post('insta_job_closing_date')) == strtotime(date("Y-m-d"))) {
					    		$this->session->set_flashdata('warning', 'You cannot select closing date past than tomorrow.');
								//redirect(base_url().'post-a-job/');
					    	}

					    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime($this->input->post('insta_job_closing_date')));
					    }else{
					    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
					    }

					    if($this->input->post('insta_job_updated_round') == 1 && $this->input->post('insta_job_status') == 1)
					    {			    	
					
					    	$job_arr['insta_job_updated_round'] = 0;
					    }

					  
					   //print_r($job_arr); die;
				        $this->session->set_flashdata('success', 'Job updated successfully.');		
					   $status = $this->JobModel->updateJob($job_arr, $this->input->post('insta_job_id'));
					   redirect(base_url().'admin/listing/job');
			}else if(!empty($this->input->post('insta_user_id')))
			{
					if(!empty($_FILES["insta_job_featured_image"]["name"]))
					{
						$date = strtotime(date('m/d/Y h:i:s a', time()));
						if (!is_dir('./upload/user/'.$this->input->post('insta_user_id').'_user')) 
						{
						     mkdir('./upload/user/'.$this->input->post('insta_user_id').'_user', 0777, TRUE);

						}
						$path = './upload/user/'.$this->input->post('insta_user_id').'_user/';
						
						$file_name = $_FILES["insta_job_featured_image"]["name"];
						
						$lastDot = strrpos($file_name, ".");
						$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
						$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
				        $config['upload_path'] = $path;
				        $config['allowed_types'] = 'gif|jpg|png';
				        $config['max_size']    = '1000';
				        $config['file_name'] = $newfile_name;
				        $featured_img = $this->input->post('insta_user_id').'_user/'.$config['file_name'];
				        //load upload class library
				        $this->load->library('upload', $config);
							
						 
				        if (!$this->upload->do_upload('insta_job_featured_image'))
				        {
				            // case - failure
				            $upload_error = array('error' => $this->upload->display_errors());
				            $this->session->set_flashdata('error', 'job image type not correct.');	      
				        }
				        else
				        {
				            
				    		$job_arr['insta_job_featured_image'] = $featured_img;
				        }
					}
					    $company['insta_company_status'] = 0;
					    // $job_arr['insta_job_min_experience'] = $this->input->post('job_min_exp_month').'.'.$this->input->post('job_min_exp_year');
					    // $job_arr['insta_job_max_experience'] = $this->input->post('job_max_exp_month').'.'.$this->input->post('job_max_exp_year');
					    // $job_arr['insta_job_status'] = $this->input->post('insta_job_status');
					    $job_fields = array('insta_user_id','insta_company_id',
					    	'insta_job_title','insta_job_application_email','insta_job_description','insta_job_closing_date','insta_job_category','insta_job_tags','insta_job_location','insta_job_status','insta_job_spotlight');
					   
					    foreach($job_fields as $key)
					    {
					    	if($key == 'insta_job_spotlight' && $this->input->post($key) == 1)
				    		{
				    			$spotlight = array();
				    			$spotlight['insta_job_spotlight'] = 0;
				    			$this->db->update('insta_jobs', $spotlight);
				    		}
					    	$job_arr[$key] = $this->input->post($key);    		
					    }
					    $job_arr['insta_job_min_experience'] = $this->input->post('insta_job_min_experience');
				        $job_arr['insta_job_max_experience'] = $this->input->post('insta_job_max_experience');

				        if(!empty($this->input->post('insta_job_closing_date')))
					    {
					    	if( strtotime($this->input->post('insta_job_closing_date')) < strtotime(date("Y-m-d")) || strtotime($this->input->post('insta_job_closing_date')) == strtotime(date("Y-m-d"))) {
					    		$this->session->set_flashdata('warning', 'You cannot select closing date past than tomorrow.');
								//redirect(base_url().'post-a-job/');
					    	}

					    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime($this->input->post('insta_job_closing_date')));
					    }else{
					    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
					    }

					    if($this->input->post('insta_job_updated_round') == 1 && $this->input->post('insta_job_status') == 1)
					    {
					    	
					    	$this->PointsModel->points_transaction('Post Job',$this->input->post('insta_user_id'));
					    	$job_arr['insta_job_updated_round'] = 0;
					    }

					  
					   //print_r($job_arr); die;
				        $this->session->set_flashdata('success', 'Job updated successfully.');		
					   $status = $this->JobModel->updateJob($job_arr, $this->input->post('insta_job_id'));
					   redirect(base_url().'admin/listing/job');
			}
		}	
		else if($type=="company")
		{
			$company_arr = array();
			$comp_alias = array();
			if(!empty($_FILES["insta_company_logo"]["name"]))
			{

				$date = strtotime(date('m/d/Y h:i:s a', time()));
				
				$path = './upload/company/';
				
				$file_name = $_FILES["insta_company_logo"]["name"];
				$lastDot = strrpos($file_name, ".");
				$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
				$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
		        $config['upload_path'] = $path;
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size']    = '1000';
		        $config['file_name'] = $newfile_name;
		        $logo = $config['file_name']; 
		        //load upload class library
		        $this->load->library('upload', $config);
				
				 
		        if (!$this->upload->do_upload('insta_company_logo'))
		        {
		            // case - failure
		            $upload_error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata('error', 'Company logo image type is not correct.');	          
		        }
		        else
		        {
		            $comp_alias['insta_company_logo'] = $logo;    		   		
		    	}
		    }else{
		    	$comp_alias['insta_company_logo'] = '';
		    }
		    $company_arr['insta_company_name'] = $this->input->post('insta_company_name');	
		    $company_arr['insta_company_status'] = $this->input->post('insta_company_status');	
		    $comp_field_arr = array('insta_company_tagline','insta_company_description','insta_company_video','insta_company_website','insta_company_google','insta_company_facebook','insta_company_linkedin','insta_company_twitter');
		    
		    foreach($comp_field_arr as $key)
		    {
		    	$comp_alias[$key] = $this->input->post($key);
		    }
		    $company_arr['insta_company_alias'] = json_encode($comp_alias);
		   
		    $this->CompanyModel->updateCompany($company_arr,$this->input->post('insta_company_id'));	
		    $this->session->set_flashdata('success', 'Company updated successfully.');			
			redirect(base_url().'admin/listing/company');
		}else if($type=="points")
		{
			
			$point_arr = array();
			//print_r($this->input->post());
			if($this->input->post('insta_points_rule_type') == 'Debit')
			{
				$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_rule_amount')), 10);
				$point_arr['insta_points_rule_amount'] = '- '.$int;
			}else{
				$int = intval(preg_replace('/[^0-9]+/', '', $this->input->post('insta_points_rule_amount')), 10);
				$point_arr['insta_points_rule_amount'] = '+ '.$int;
			} 
		    $point_key = array('insta_points_rule_name','insta_points_rule_type','insta_points_rule_description');
			
			foreach($point_key as $key)
			{
				if(!empty($this->input->post($key)))
				{
					
					 $point_arr[$key] = $this->input->post($key);
				}			   
			}
			$point_arr['insta_points_rule_status'] = $this->input->post('insta_points_rule_status');
			$point_arr['insta_points_rule_updated_date'] = date("Y-m-d H:i:s");
			// echo "<pre>";
			// print_r($point_arr); die;


			$this->PointsModel->update_Point_Rule($point_arr,$this->input->post('insta_points_rule_id'));
			$this->session->set_flashdata('success', 'Points updated successfully.');		    			
			redirect(base_url().'admin/listing/points/');
		}else if($type == "category")
		{   
			$cat_arr = array();
			if(!empty($_FILES["insta_job_category_icon"]["name"]))
			{

				$date = strtotime(date('m/d/Y h:i:s a', time()));
				
				$path = './upload/category/';
				
				$file_name = $_FILES["insta_job_category_icon"]["name"];
				$lastDot = strrpos($file_name, ".");
				$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
				$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
		        $config['upload_path'] = $path;
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size']    = '1000';
		        $config['file_name'] = $newfile_name;
		        $logo = $config['file_name']; 
		        //load upload class library
		        $this->load->library('upload', $config);
				
				 
		        if (!$this->upload->do_upload('insta_job_category_icon'))
		        {
		            // case - failure
		            $upload_error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata('error', 'Catgory icon image type is not correct.');	    
		        }
		        else
		        {
		            $cat_arr['insta_job_category_icon'] = $logo;    		   		
		    	}
		    }
			  
			    $category_keys = array('insta_job_category','insta_job_category_description','insta_job_category_status');
			    foreach($category_keys as $key)
				{
					if(!empty($this->input->post($key)))
					{
						
						 $cat_arr[$key] = $this->input->post($key);
					}			   
				}
				$cat_arr['insta_job_category_status'] = $this->input->post('insta_job_category_status');
			    $this->JobModel->updateCategory($cat_arr,$this->input->post('insta_job_category_id'));		
			    $this->session->set_flashdata('success', 'Category Updated successfully.');			
				redirect(base_url().'admin/listing/category/');
		}

	}

	// Logout from admin page
	public function add_point() {
		$data['main_content'] = "add-points";
		$this->load->view('admin/admin-template',$data);
	}


	public function add_job_category()
	{
		$cat_arr = array();
		if(!empty($_FILES["insta_job_category_icon"]["name"]))
		{

			$date = strtotime(date('m/d/Y h:i:s a', time()));
			
			$path = './upload/category/';
			
			$file_name = $_FILES["insta_job_category_icon"]["name"];
			$lastDot = strrpos($file_name, ".");
			$newfile_name = str_replace(".", "_", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
			$newfile_name       = $date.'_'.str_replace(' ', '_', $newfile_name);
	        $config['upload_path'] = $path;
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size']    = '1000';
	        $config['file_name'] = $newfile_name;
	        $logo = $config['file_name']; 
	        //load upload class library
	        $this->load->library('upload', $config);
			
			 
	        if (!$this->upload->do_upload('insta_job_category_icon'))
	        {
	            // case - failure
	            $upload_error = array('error' => $this->upload->display_errors());
	           $this->session->set_flashdata('error', 'Category icon image type is not correct.');	 
	        }
	        else
	        {
	            $cat_arr['insta_job_category_icon'] = $logo;    		   		
	    	}
	    }else{
	    	$cat_arr['insta_job_category_icon'] = '';
	    }
	    $category_keys = array('insta_job_category','insta_job_category_description','insta_job_category_status');
	    foreach($category_keys as $key)
		{
			if(!empty($this->input->post($key)))
			{
				
				 $cat_arr[$key] = $this->input->post($key);
			}			   
		}
		$this->session->set_flashdata('success', 'Category added successfully.');		
	    $this->JobModel->add_job_category($cat_arr);			
		redirect(base_url().'admin/listing/category/');
	}

	// Logout from admin page
	public function logout() {
		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('admin/admin-login', $data);
	}
}