<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	function __Construct(){
	   parent::__Construct ();
	   // Load form helper library
		$this->load->helper('form');

		// Load form helper library
		$this->load->helper('security');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');
	   $this->load->model('JobModel'); // load model 
	   $this->load->model('HomeModel'); // load model 
	   $this->load->model('PointsModel');
	   $location = "";
	   if(!empty($this->session->my_current_location))
	   {
	   	 $location = $this->session->my_current_location;
	   }
	  $this->data['meta_details'] = array("title"=>"Find a Job","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"Employees from top companies and startups are referring great candidates in their company. Don’t miss a chance to get an internal referral.");
	}

	
	
	
	public function index()
	{
		$this->data["meta_details"]['title'] = "Post Job";
		$data['meta'] = $this->data["meta_details"];
		if(isset($this->session->user_session))
		{
			if(empty($this->session->user_session['company_id']))
			{
				$this->session->set_flashdata('warning', 'Please select your company before post job.');
				redirect(base_url().'user/dashboard');
			}
			$data['company'] = $this->JobModel->getCompany();
			$data['category'] = $this->JobModel->getCategory('insta_job_category');
			$data['main_content'] = 'job/job-post';
			$this->load->view('template',$data);
		}else{

			$this->session->set_flashdata('next_redirect', $this->session->current_url);
			$this->session->set_flashdata('login_msg', 'Login Request');
			redirect($this->session->current_url);
		}	
	}


	

	public function find($category="")
	{
		$data['meta'] = $this->data["meta_details"];
		if(!empty($category))
		{
			$data['jobs'] = $this->JobModel->get_filter_post_job('category_submit',$category);
		}else{
			$data['jobs'] = $this->JobModel->get_post_job_list();
		}
		$data['category'] = $category;
		$data['job_list'] = $this->JobModel->get_post_job_list();
		$data['job_tags'] = $this->JobModel->get_post_job_tags();
		$data['job_category'] = $this->JobModel->getCategory('insta_job_category');
		$data['job_location'] = $this->JobModel->get_jobs_column_value('insta_job_location');
		$data['company'] = $this->JobModel->getCompany();
		$data['main_content'] = 'job/job-find';
		$this->load->view('template',$data);	
	}

	public function post()
	{ 
		$data['meta'] = $this->data["meta_details"];
		if(isset($this->session->user_session))
		{  
			if(empty($this->session->user_session['company_id']))
			{
				$this->session->set_flashdata('warning', 'Please select your company before post job.');
				redirect(base_url().'user/dashboard');
			}
		    $job_arr = array();
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
            	$this->upload->initialize($config);
				
				 
		        if (!$this->upload->do_upload('insta_job_featured_image'))
		        {
		            // case - failure
		            $upload_error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata('error', 'featured image type is not correct.');
					redirect(base_url().'post-a-job/');             
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
					redirect(base_url().'post-a-job/');
		    	}
		    	$job_arr['insta_job_closing_date'] = $this->input->post('insta_job_closing_date');
		    }else{
		    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
		    }
		   
		    $job_fields = array('insta_user_id','insta_company_id',
		    	'insta_job_title','insta_job_application_email','insta_job_description','insta_job_category','insta_job_tags','insta_job_location');

		    foreach($job_fields as $key)
		    {
		    	if(!empty($this->input->post($key)))
		    	{ 
		    		if($key == "insta_job_tags") 
		    		{
		    			if (strpos($this->input->post($key), ',') !== false)
		    			{
		    				$tags = preg_replace('/\s*,\s*/', ',', $this->input->post($key));
		    				$tags = str_replace(',', ', ', $tags);
		    				$job_arr[$key] = $tags;
		    			}else{
		    				$job_arr[$key] = $this->input->post($key);
		    			}		    			
		    		}
		    		else if($key == "insta_company_id" && $this->input->post('insta_company_id')=='other')
		    		{ 
		    			$company = array();
		    			$company['insta_company_name'] = $this->input->post('insta_company_name');
		    			
		    			$compId = $this->JobModel->addCompany($company);
		    			$job_arr[$key] = $compId;
		    		}else{
		    			$job_arr[$key] = $this->input->post($key);
		    		}	    		
		    	}else{	    		
		    		$job_arr[$key] = "";
		    	}	
		    	
		    }
		    $job_arr['insta_job_updated_round'] = 1;
		    $job_arr['insta_company_id'] = $this->session->user_session['company_id'];
		    //print_r($job_arr); die;
		    $jobId = $this->JobModel->addJob($job_arr);
		    if($jobId > 0)
		    {
		    	$user_id = $this->session->user_session['user_id'];
				//$this->PointsModel->points_transaction('Post Job',$user_id);
				$this->session->set_flashdata('success', 'Your Job is now with moderator for approval. Once done your points will  be credited to your account.');
		    	redirect(base_url().'manage-job/');
		    }
		}else{
			$this->session->set_flashdata('warning', 'Please Login before posting job.');
			redirect(base_url().'home/');
		}	
	    
	}


	public function update_job()
	{ 
		$data['meta'] = $this->data["meta_details"];
		if(isset($this->session->user_session))
		{
			if($this->session->user_session['user_id'] == $this->input->post('insta_user_id'))
			{
		    $job_arr = array();
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
            	$this->upload->initialize($config);
				
				 
		        if (!$this->upload->do_upload('insta_job_featured_image'))
		        {
		            // case - failure
		            $upload_error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata('error', 'featured image type is not correct.');
					redirect(base_url().'manage-job/'.$this->input->post('insta_job_id').'/');       
		        }
		        else
		        {
		            
		    		$job_arr['insta_job_featured_image'] = $featured_img;
		        }
		    }

		    if(!empty($this->input->post('insta_job_closing_date')))
		    {
		    	if( strtotime($this->input->post('insta_job_closing_date')) < strtotime(date("Y-m-d")) || strtotime($this->input->post('insta_job_closing_date')) == strtotime(date("Y-m-d"))) {
		    		$this->session->set_flashdata('warning', 'You can not select closing date past than tomorrow.');
		    		//  echo $this->input->post('insta_job_closing_date'); die;
					redirect(base_url().'manage-job/'.$this->input->post('insta_job_id').'/');
		    	}
		    	$job_arr['insta_job_closing_date'] = $this->input->post('insta_job_closing_date');
		    }else{
		    	$job_arr['insta_job_closing_date'] = date("Y-m-d", strtotime('+2 months'));
		    }

		    $job_fields = array('insta_user_id','insta_company_id',
		    	'insta_job_title','insta_job_application_email','insta_job_description','insta_job_category','insta_job_tags','insta_job_location','insta_job_min_experience','insta_job_max_experience');

		   foreach($job_fields as $key)
		    {
		    	if(!empty($this->input->post($key)))
		    	{ 
		    		if($key == "insta_job_tags") 
		    		{
		    			if (strpos($this->input->post($key), ',') !== false)
		    			{
		    				$tags = preg_replace('/\s*,\s*/', ',', $this->input->post($key));
		    				$tags = str_replace(',', ', ', $tags);
		    				$job_arr[$key] = $tags;
		    			}else{
		    				$job_arr[$key] = $this->input->post($key);
		    			}		    			
		    		}
		    		else{
		    			$job_arr[$key] = $this->input->post($key);
		    		}
		    		
		    		    		
		    	}
		    }
            
		    $this->JobModel->updateJob($job_arr ,$this->input->post('insta_job_id'));
		    $this->session->set_flashdata('success', 'Job details updated Successfully.');
			redirect(base_url().'manage-job');
		 }else{
			$this->session->set_flashdata('warning', 'Sorry! You can manage only your posted jobs.');
			redirect(base_url().'manage-job');
			}	

		}else{
			$this->session->set_flashdata('warning', 'Please Login before update job detail.');
			redirect(base_url().'home');
		}	
	    
	}

	public function manage($jobId="",$type="")
	{
		$this->data["meta_details"]['title'] = "Manage Job";
		$data['meta'] = $this->data["meta_details"];
		if(isset($this->session->user_session))
		{
			if($jobId != "" && $type == "edit")
			{
				$data['company'] = $this->JobModel->getCompany();
				$data['category'] = $this->JobModel->getCategory('insta_job_category');
				$data['job_details'] = $this->JobModel->get_post_job_list($jobId,'insta_job_id','manage');
				if($this->session->user_session['user_id'] == $data['job_details'][0]->insta_user_id)
				{
					$data['main_content'] = 'job/job-post';
					$this->load->view('template',$data);
				}else{
					$this->session->set_flashdata('warning', 'Sorry! You can manage only your posted job.');
					$data['job_list'] = $this->JobModel->get_post_job_list($this->session->user_session['user_id'],'insta_user_id','manage');
					$data['main_content'] = 'job/job-list';
					$this->load->view('template',$data);	
				}
				
			}else{
				$data['job_list'] = $this->JobModel->get_post_job_list($this->session->user_session['user_id'],'insta_user_id','manage');
				$data['main_content'] = 'job/job-list';
				$this->load->view('template',$data);			
			}
		}else{
			$this->session->set_flashdata('next_redirect', $this->session->current_url);
			$this->session->set_flashdata('login_msg', 'Login Request');
			redirect($this->session->current_url);
		}	
		
	}


	// public function manage()
	// {
	// 	$data['job_list'] = $this->JobModel->get_post_job_list($this->session->user_session['user_id'],'insta_user_id');
	// 	$data['main_content'] = 'job/job-list';
	// 	$this->load->view('template',$data);		
	// }

	public function autosearch()
	{

		$str = array();
		$search = $this->input->post('keyword'); 
		if($search != "" && $this->input->post('keytype') == 'title_company_skills')
		{
			$this->db->select('*');
			$this->db->from('insta_jobs');
			$this->db->where('insta_job_status', 1);
			$this->db->like('insta_job_title', $search);
			
			$query = $this->db->get();
			$row['job_list'] = $query->result();
			if(count($row['job_list']) > 0)
			{
				$skills = array();
				foreach($row['job_list'] as $new)
				{
					array_push($str, $new->insta_job_title);
					//$str .= '<span>'.$new->insta_job_title.'</span><br>';
				}
			}
			
			$this->db->select('*');
			$this->db->from('insta_jobs');
			$this->db->where('insta_job_status', 1);
		    $this->db->like('insta_job_tags', $search);
		   
			$query = $this->db->get();
			$row['job_list'] = $query->result();
			if(count($row['job_list']) > 0)
			{
				$skills = array();
				
				foreach($row['job_list'] as $new)
				{	
					if (strpos($new->insta_job_tags, ',') !== false) 
					{
						if ($new == $search) 
						{	
							array_push($str, $new->insta_job_tags);
							
						}else{ 
							$skills = explode(',', $new->insta_job_tags);
							foreach($skills as $val)
							{
								if(!empty($val))
								{ 
									if (strpos($val, $search) !== false) 
									{
										array_push($str, $val);
								   		
									}else{
										//$str .= '<span>'.$val.'</span><br>';
										//break;
									}
								}
								
							}
							array_push($str, $new->insta_job_tags);
							
							
						}
					}else{
						array_push($str, $new->insta_job_tags);
						
					}
					
				}
			}
			
			if(empty($this->input->post('searchType')) || $this->input->post('searchType') != "refer_earn")
			{
				$this->db->select('*');
				$this->db->from('insta_company');
				$this->db->where('insta_company_status', 1);
			    $this->db->like('insta_company_name', $search);
				$query = $this->db->get();
				$row['comp_list'] = $query->result();
				if(count($row['comp_list'])>0)
				{
					$skills = array();
					foreach($row['comp_list'] as $new)
					{
						array_push($str, $new->insta_company_name);
						//$str .= '<span>'.$new->insta_company_name.'</span><br>';				
					}
				}
			}
			
			$result = array_unique($str);
			echo json_encode($result);
			exit;
		}else if($search != "" && $this->input->post('keytype') == 'location')
		{	
			$str = array();
			$this->db->select('*');
			$this->db->from('insta_jobs');
		    $this->db->like('insta_job_location', $search);
			$query = $this->db->get();
			$row['job_list'] = $query->result();
			if(count($row['job_list'])>0)
			{
				$skills = array();
				foreach($row['job_list'] as $new)
				{	//echo $new->insta_job_location;
					if (strpos($new->insta_job_location, ',') !== false) 
					{
						if ($new == $search) 
						{	
							array_push($str, $new->insta_job_location);
							
						}else{ 
							$skills = explode(',', $new->insta_job_location);
							foreach($skills as $val)
							{
								if(!empty($val))
								{ 
									if (strpos($val, $search) !== false) 
									{
										array_push($str, $val);
								   		
									}else{
										//$str .= '<span>'.$val.'</span><br>';
										//break;
									}
								}
								
							}
							array_push($str, $new->insta_job_location);
							
						}
					}else{  
						array_push($str, $new->insta_job_location);
						
					}
					
				}
			}
			$result = array_unique($str);
			echo json_encode($result);
			exit;

		}
		else{
			exit;
		}
		
			
		
	}

	public function single_job($jobId)
	{
		$data['meta'] = $this->data["meta_details"];
		$data['job_detail'] = $this->JobModel->get_post_job_list($jobId,'insta_job_id','single');
		if(!empty($data['job_detail']))
		{
			$this->load->model('CompanyModel');
			$data['company_detail'] = $this->CompanyModel->get_company_list($data['job_detail'][0]->insta_company_id,'Admin');
			$data['related_jobs'] = $this->JobModel->get_related_jobs($jobId,$data['job_detail'][0]->insta_job_min_experience,$data['job_detail'][0]->insta_job_max_experience,$data['job_detail'][0]->insta_job_tags,$data['job_detail'][0]->insta_company_id);
			$data['main_content'] = 'job/single-job';
			$this->load->view('template',$data);
		}else{
			$data['error_msg'] = "Sorry! Job not found";
			$data['main_content'] = 'common/error';
			$this->load->view('template',$data);
		}	
	}

	public function filter_job()
	{
		$data['meta'] = $this->data["meta_details"];
		if(!empty($this->input->get()))
		{
			$data['job_list'] = $this->JobModel->get_post_job_list();
			$data['jobs'] = $this->JobModel->get_post_job_list();
			$data['job_tags'] = $this->JobModel->get_post_job_tags();
			$data['job_category'] = $this->JobModel->getCategory('insta_job_category');
			$data['job_location'] = $this->JobModel->get_jobs_column_value('insta_job_location');
			$data['company'] = $this->JobModel->getCompany();
			$data['experience'] = $this->input->get('experience');
			
				if($this->input->get('experience') != "" && $this->input->get('experience') != 'Experience')
				{
					$arr['exp'] = $this->input->get('experience');
					$data['experience'] = $this->input->get('experience');
				}else{
					$data['experience'] = $this->input->get('experience');
				}
				if(!empty($this->input->get('title_company_skills')))
				{
					$arr['text'] = $this->input->get('title_company_skills');
					$data['title_company_skills'] = $this->input->get('title_company_skills');
				}

				if(!empty($this->input->get('location')))
				{
					$arr['location'] = $this->input->get('location');
					$data['location'] = $this->input->get('location');
				}

				if(!empty($this->input->get('category')) && $this->input->get('category') != 'Job Categories')
				{
					$arr['category'] = $this->input->get('category');
					$data['category'] = $this->input->get('category');
				}else{
					$data['category'] = $this->input->get('category');
				}
				if(!empty($arr))
				{
					$data['jobs'] = $this->JobModel->get_filter_post_job('all',$arr);
				}
				
			
			if($data['jobs'] == "Not available")
			{
				$data['error_msg'] = "There are no listings matching your search.";
			}
			$data['main_content'] = 'job/job-find';
			$this->load->view('template',$data);
		}else{
			$data['main_content'] = 'job/job-find';
			$this->load->view('template',$data);
		}
			
	}

	public function tags_job_list($tag)
	{
		$data['meta'] = $this->data["meta_details"];
		$data['job_list'] = $this->JobModel->getjobByTags(urldecode($tag));
		if($data['job_list'] == "Not available")
		{
			$data['error_msg'] = "There are no listings matching your search.";
		}
		$data['main_content'] = 'job/tags-job-list';
		$this->load->view('template',$data);
	}

	public function apply_job($jobId="")
	{   

		$jobId = $this->input->post('jobId'); 
		$closing_date = $this->input->post('closing_date'); 
		
		if(strtotime($closing_date) < strtotime(date("Y-m-d"))) {
    		$this->session->set_flashdata('warning', 'Sorry! you can not apply for this job because closing date is expired.');
    		echo base_url().'single-job/'.$jobId.'/'; exit;
    	}
		if(isset($this->session->user_session))	
		{
			$i=0;
			$user_keys = array('resume','email','skills','experience');
			//print_r($this->session->user_session); die;
			foreach($user_keys as $key)
			{
				if(!empty($this->session->user_session[$key]))
				{
					$i++;
				}else{
					if($key == 'resume')
					{
						$this->session->set_flashdata('info', 'Please upload updated resume before apply for job.');
						echo base_url().'my-account/'; exit;
					}else{
						$this->session->set_flashdata('info', 'Please complete short form My Account before apply for job.');
						echo base_url().'my-account/'; exit;
					}
					
					//redirect(base_url().'my-account/');
				}
			}
			if($i==count($user_keys))
			{
				$data['job_detail'] = $this->JobModel->get_post_job_list($jobId , 'insta_job_id');
				
				if($data['job_detail'][0]->insta_company_id == $this->session->user_session['company_id'])
				{
					$this->session->set_flashdata('warning', "You can not apply for your  current company's jobs.");
					echo base_url().'single-job/'.$jobId.'/'; exit;
					//redirect(base_url().'single-job/'.$jobId.'/');
				}else if($data['job_detail'][0]->insta_user_id == $this->session->user_session['user_id'])
				{
					$this->session->set_flashdata('warning', "You can not apply for jobs which are posted by you.");
					echo base_url().'single-job/'.$jobId.'/'; exit;
					//redirect(base_url().'single-job/'.$jobId.'/');
				}else if( strtotime($data['job_detail'][0]->insta_job_closing_date) < strtotime(date("Y-m-d")) ) {

		    		$this->session->set_flashdata('warning', 'This job deadline is completed, you can not apply.');
		    		echo base_url().'single-job/'.$jobId.'/'; exit;
					//redirect(base_url().'single-job/'.$jobId.'/');
		    	}else{
					$result = $this->JobModel->check_users_apply_job($jobId,$this->session->user_session['user_id']);
					if($result == 0)
					{
						$this->session->set_flashdata('warning', "You have already applied for this job.");
						echo base_url().'single-job/'.$jobId.'/'; exit;
						//redirect(base_url().'single-job/'.$jobId.'/');

					}else{
							echo 1; exit;
							// $data['main_content'] = 'job/job-apply';
							// $this->load->view('template',$data);	
						
					}
				}
				
			}
		}
		else{
			$this->session->set_flashdata('warning', 'Please Login before apply for job.');
			echo 2; exit;
			//echo base_url().'home/'; exit;
			//redirect(base_url().'home');
		}
	}


	public function add_apply_job()
	{ 
		$data['meta'] = $this->data["meta_details"];
		if(!empty($this->session->user_session['user_id']))
		{   
			$result = $this->JobModel->check_users_apply_job($this->input->post('insta_job_id'),$this->input->post('insta_user_id'));
			if($result == 0)
			{
				$this->session->set_flashdata('warning', "You have already applied for this job.");
				redirect(base_url().'single-job/'.$this->input->post('insta_job_id'));

			}else{
				$user_id = $this->session->user_session['user_id'];
				$point_calculation = $this->PointsModel->points_transaction('Apply Job',$user_id);
				if($point_calculation == 0)
				{

					$this->session->set_flashdata('warning', "You do not have sufficient credit point. <a href='".base_url()."points/'>Get Credit Point now.</a>");
					redirect(base_url().'single-job/'.$this->input->post('insta_job_id'));

				}else{
					$apply_key = array('insta_user_id','insta_job_id','insta_job_apply_why_get_refer','insta_job_apply_status');

					foreach($apply_key as $key)
					{
				    	$apply_job_arr[$key] = $this->input->post($key);
					}
					$this->session->set_flashdata('success', 'Thanks ! You have applied successfully.');
					$this->JobModel->add_apply_job($apply_job_arr);
					redirect(base_url().'single-job/'.$this->input->post('insta_job_id'));
				}
			}
		}else{
			$this->session->set_flashdata('warning', 'Please Login before apply for job.');
			redirect(base_url().'home');
		}	
				
		
	}

	public function filter_refer_and_earn()
	{
		$location = "";
	    if(!empty($this->session->my_current_location))
	    {
	   	 $location = $this->session->my_current_location;
	    }
		$data['meta'] = array("title"=>"Refer and Earn","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"Find all the candidates who are interested in your company and claim referral bonus from the company. Now you can refer candidates beyond social and professional network. Find relevant message from the user and reason why they should get referred and only after deciding you get the resume in your inbox.");
		if(!empty($this->session->user_session['user_id']))
		{
			if(empty($this->session->user_session['company_id']))
			{
				$this->session->set_flashdata('warning', 'Please complete short form My Account before apply for job.');
				redirect(base_url().'my-account/');
			}
			else
			{
				$title_and_skill = ""; $location = "";
				if(!empty($this->input->post('title_company_skills')))
				{
					$title_and_skill = $this->input->post('title_company_skills');
				}
				if(!empty($this->input->post('location')))
				{
					$location = $this->input->post('location');
				}
				$data['job_list'] = $this->JobModel->get_refer_earn_list($this->session->user_session['company_id'],'insta_company_id',$title_and_skill,$location);

				$data['main_content'] = 'job/job-refer&earn';
				$this->load->view('template',$data);			
		   		//$this->load->view('job/job-refer&earn', '');
			}			
	   	}else{
			$this->session->set_flashdata('next_redirect', $this->session->current_url);
			$this->session->set_flashdata('login_msg', 'Login Request');
			redirect($this->session->current_url);
		}	
	}


	public function refer_and_earn()
	{
		$location = "";
	    if(!empty($this->session->my_current_location))
	    {
	   	 $location = $this->session->my_current_location;
	    }
		$data['meta'] = array("title"=>"Refer and Earn","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"Find all the candidates who are interested in your company and claim referral bonus from the company. Now you can refer candidates beyond social and professional network. Find relevant message from the user and reason why they should get referred and only after deciding you get the resume in your inbox.");
		if(!empty($this->session->user_session['user_id']))
		{
			if(empty($this->session->user_session['company_id']))
			{
				$this->session->set_flashdata('warning', 'Please complete short form My Account before refer and earn.');
				redirect(base_url().'my-account/');
			}
			else
			{
				$title_and_skill = ""; $location = "";
				if(!empty($this->input->post('title_company_skills')))
				{
					$title_and_skill = $this->input->post('title_company_skills');
				}
				if(!empty($this->input->post('location')))
				{
					$location = $this->input->post('location');
				}
				$data['job_list'] = $this->JobModel->get_refer_earn_list($this->session->user_session['company_id'],'insta_company_id',$title_and_skill,$location);				
				// echo "<pre>";
				// print_r($data['job_list']); die;
				$data['main_content'] = 'job/job-refer&earn';
				$this->load->view('template',$data);			
		   		//$this->load->view('job/job-refer&earn', '');
			}			
	   	}else{
			$this->session->set_flashdata('next_redirect', $this->session->current_url);
			$this->session->set_flashdata('login_msg', 'Login Request');
			redirect($this->session->current_url);
		}	
	}

	public function refer_candidate($apply_id)
	{
	   $location = "";
	   if(!empty($this->session->my_current_location))
	   {
	   	 $location = $this->session->my_current_location;
	   }
		$data['meta'] = array("title"=>"Refer and Earn","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"Find all the candidates who are interested in your company and claim referral bonus from the company. Now you can refer candidates beyond social and professional network. Find relevant message from the user and reason why they should get referred and only after deciding you get the resume in your inbox.");
		if(!empty($this->session->user_session['user_id']))
		{
			$result = $this->JobModel->select_rows('insta_job_refer','insta_job_apply_id',$apply_id);
			if($result != 0)
			{
				$refer['insta_job_apply_id'] = $apply_id;
				$refer['insta_job_refer_by_user_id'] = $this->session->user_session['user_id'];
				$result = $this->JobModel->add_refer_job($refer);
				if($result != 0)
				{
					$apply['insta_job_apply_status'] = 1;
					$result = $this->JobModel->update_apply_job($apply , $apply_id);
					$data['job_list'] = $this->JobModel->get_refer_earn_list($this->session->user_session['company_id'],'insta_company_id');			
					
						
					$this->PointsModel->points_transaction('Refer User',$this->session->user_session['user_id']);   
					$this->JobModel->refer_mail($apply_id);

					$this->session->set_flashdata('success', 'You have referred candidate Successfully.');
					$data['main_content'] = 'job/job-refer&earn';
					$this->load->view('template',$data);	
				}
			}
			else{

				$this->session->set_flashdata('info', 'Sorry! Some error occured, Please try again.');
				$data['main_content'] = 'job/job-refer&earn';
				$this->load->view('template',$data);	

			}
		}else{
			$this->session->set_flashdata('warning', 'Please Login before refer candidate.');
			redirect(base_url().'home');
		}	
	}
}



