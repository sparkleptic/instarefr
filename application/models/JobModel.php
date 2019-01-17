<?php
class JobModel extends CI_Model {

	function getCompany()
	{
		$this->db->select("*"); 
		$this->db->from('insta_company');
		$this->db->order_by("insta_company_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	}

	function getCategory($type="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_job_category');
		if($type != 'Admin')
		{
			$this->db->where('insta_job_category_status', 1);
		}		
		$this->db->order_by("insta_job_category_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	}	

	function get_jobs_column_value($field="*")
	{
		$this->db->select($field); 
		$this->db->from('insta_jobs');
		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	} 

	public function add_job_category($data)
	{
		$this->db->insert('insta_job_category', $data);
		$catId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $catId;
		}
		else
		{
			return false;
		}
	}

	public function addCompany($data)
	{
		$this->db->insert('insta_company', $data);
		$compId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $compId;
		}
		else
		{
			return false;
		}
	}

	
	public function addJob($data)
	{
		$this->db->insert('insta_jobs', $data);
		$jobId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			$this->load->model('PointsModel');
			//$this->PointsModel->points_transaction('Post Job');						
			return $jobId;
		}
		else
		{
			return false;
		}
	}  


	public function add_apply_job($data)
	{
		$this->db->insert('insta_job_apply', $data);
		$applyId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $applyId;
		}
		else
		{
			return false;
		}
	} 

	public function update_apply_job($data , $applyId)
	{
		$this->db->where('insta_job_apply_id', $applyId);
	    $this->db->update('insta_job_apply', $data);
	    return true;
	} 



	public function add_refer_job($data)
	{
		$this->db->insert('insta_job_refer', $data);
		$referId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $referId;
		}
		else
		{
			return false;
		}
	} 


	public function select_rows($table,$where_field="",$where_value="")
	{
		if($table != "")
		{
			$this->db->select("*"); 
			$this->db->from($table);
			if($where_field !="" && $where_value != "")
			{
				$this->db->where($where_field, $where_value);
			}

			if($table=='insta_job_apply')
			{
				$this->db->order_by('insta_job_apply_id','DESC');
			}

			$query = $this->db->get();
			$row = $query->result();
			if($row > 0)
			{
				return $row;
			}
			else{
				return 0;
			}
		}		
	}  

	public function get_job_spotligh($limit="")
	{
		
		$this->db->select("*"); 
		$this->db->from('insta_jobs');
		$this->db->where('insta_job_spotlight', 1);
		if(!empty($limit))
		{
			$this->db->limit($limit);
		}		
		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get();
		$row = $query->result();
		if($row > 0)
		{
			return $row;
		}
		else
		{
			return 0;
		}
				
	}  

	//if already applied
	public function check_users_apply_job($jobId,$userId)
	{
		$this->db->select("*"); 
		$this->db->from('insta_job_apply');
		$this->db->where('insta_user_id', $userId);
		$this->db->where('insta_job_id', $jobId);
		$query = $this->db->get();
		$data = $query->result();
		if(count($data) > 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}  


	

	function get_post_job_tags()
	{
		$this->db->select("insta_job_tags"); 
		$this->db->from('insta_jobs');
		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get();
		$row['job_tags'] = $query->result();
		if(count($row['job_tags']) > 0)
		{
			foreach($row['job_tags'] as $val)
			{
				if( strpos( $val->insta_job_tags, ',' ) !== false ) {
					$tag_arr = array();
					$tag_arr = explode(',',$val->insta_job_tags);
					foreach($tag_arr as $v)
					{
						$new[] = $v;
					} 
				}
				else{
					$new[] = $val->insta_job_tags;
				}
    		}
    		
    		$row['job_tags'] = array_unique($new);
    		return $row['job_tags'];
		}else{
			return false;
		}		
		
	}

	function get_post_job_list($Id="",$field="",$type="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_jobs');
		if($type == "" && $type != "Admin")
		{
			$this->db->where('insta_job_closing_date >=', date("Y-m-d"));
			$this->db->where('insta_job_status', 1);
			if(!empty($this->session->my_current_location))
			{
				$location = $this->session->my_current_location;
				$this->db->like('insta_job_location', $location);
			}
			
		}
		if($Id!="" && $field!="")
  		{
  		 	$this->db->where($field, $Id);  
  		}
  		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get();
		$row['job_list'] = $query->result();
		if(count($row['job_list'])>0)
		{
			$key = 0; $tags = array();
			foreach($row['job_list'] as $new)
			{
				$apply_user_list = $this->select_rows('insta_job_apply','insta_job_id',$new->insta_job_id);
				$this->load->model('AdminModel');				
				$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
				$user_name = "";
				if(!empty($new->insta_user_id))
				{
					$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'first_name')." ".$this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'last_name');
				}				
				$this->load->model('CompanyModel');
				$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
				$row['job_list'][$key]->company = $comp_name;
				$row['job_list'][$key]->user = $user_name;
				$row['job_list'][$key]->insta_company_logo = $comp_logo;
				$row['job_list'][$key]->apply_users_count = count($apply_user_list);
				$key++;
			}
			
			return $row['job_list'];
		}
		else{
			return false;
		}
	}


	function get_users_applied_jobs($userId="")
	{ 
		if($userId == "")
		{
			$apply_user_list = $this->select_rows('insta_job_apply');
		}
		else{
			$apply_user_list = $this->select_rows('insta_job_apply','insta_user_id',$userId);
		}
		
		if(count($apply_user_list) > 0)
		{   $i=0; $new_arr = array();
			$this->load->model('AdminModel');	
			$this->load->model('CompanyModel');	
			foreach($apply_user_list as $val)
			{
				
					
				$joblist = $this->select_rows('insta_jobs','insta_job_id',$val->insta_job_id);

				
				$new_arr[$i]['insta_job_id'] = $joblist[0]->insta_job_id;
				$new_arr[$i]['insta_company_id'] = $joblist[0]->insta_company_id;
				$new_arr[$i]['insta_job_title'] = $joblist[0]->insta_job_title;
				$new_arr[$i]['insta_job_tags'] = $joblist[0]->insta_job_tags;
				$new_arr[$i]['insta_job_apply_status'] = $val->insta_job_apply_status;
				//$new_arr[$i]['insta_job_skills'] = $joblist[0]->insta_job_skills;
				$new_arr[$i]['insta_job_apply_status'] = $val->insta_job_apply_status;
				$new_arr[$i]['insta_job_apply_date'] = $val->insta_job_apply_date;
				
				$comp_name = $this->AdminModel->get_company_name($joblist[0]->insta_company_id);
				$new_arr[$i]['insta_company_name'] = $comp_name;

				$comp_logo = $this->CompanyModel->get_company_metadata($joblist[0]->insta_company_id,'logo');
				$new_arr[$i]['insta_company_logo'] = $comp_logo;

				if($new_arr[$i]['insta_job_apply_status'] != 0)
				{
					$referjob = $this->select_rows('insta_job_refer','insta_job_apply_id',$val->insta_job_apply_id);
					if(count($referjob) > 0)
					{
						$new_arr[$i]['insta_job_referred_date'] = $referjob[0]->insta_job_refer_date;
					}
				}else{
					$new_arr[$i]['insta_job_referred_date'] = '-';
				}		

				
				$i++;
				
			} //die;
			// echo "<pre>";
			// print_r($new_arr); die;
			return $new_arr;
		} 
	}


	function get_applied_job_users()
	{ 
		//$apply_job_list = $this->select_rows('insta_job_apply');
		$this->db->distinct();
		$this->db->select('insta_job_id');
		$this->db->from('insta_job_apply');
		$query = $this->db->get();
		$apply_job_list = $query->result();
				
		if(count($apply_job_list) > 0)
		{  
			$i=0; $new_arr = array();
			$this->load->model('AdminModel');	
			$this->load->model('CompanyModel');	
			foreach($apply_job_list as $val)
			{
				//echo $val->insta_job_id; echo "<br>";	
				
				$joblist = $this->select_rows('insta_jobs','insta_job_id',$val->insta_job_id);
				$job = $joblist[0];

					$new_arr[$i]['apply_list'] = $this->select_rows('insta_job_apply','insta_job_id',$val->insta_job_id);
					$j = 0;
					foreach($new_arr[$i]['apply_list'] as $apply)
					{
						$new_arr[$i]['apply_list'][$j]->apply_user_name = $this->AdminModel->get_usermeta_byKeyId($apply->insta_user_id,'first_name').' '.$this->AdminModel->get_usermeta_byKeyId($apply->insta_user_id,'last_name');
						$j++;
					}
					$new_arr[$i]['insta_job_id'] = $job->insta_job_id;
					//$new_arr[$i]['insta_job_post_by'] = $job->insta_user_id;
					$new_arr[$i]['insta_job_post_by'] = $this->AdminModel->get_usermeta_byKeyId($job->insta_user_id,'first_name').' '.$this->AdminModel->get_usermeta_byKeyId($job->insta_user_id,'last_name');
					$new_arr[$i]['insta_company_id'] = $job->insta_company_id;
					$new_arr[$i]['insta_job_title'] = $job->insta_job_title;
					$new_arr[$i]['insta_job_tags'] = $job->insta_job_tags;
					//$new_arr[$i]['insta_job_apply_status'] = $val->insta_job_apply_status;
					//$new_arr[$i]['insta_job_skills'] = $job->insta_job_skills;
					$new_arr[$i]['insta_job_created_on'] = $job->insta_job_created_on;
					//$new_arr[$i]['insta_job_apply_status'] = $val->insta_job_apply_status;
					//$new_arr[$i]['insta_job_apply_date'] = $val->insta_job_apply_date;
					
					$comp_name = $this->AdminModel->get_company_name($job->insta_company_id);
					$new_arr[$i]['insta_company_name'] = $comp_name;

					$comp_logo = $this->CompanyModel->get_company_metadata($job->insta_company_id,'logo');
					$new_arr[$i]['insta_company_logo'] = $comp_logo;

					// if($new_arr[$i]['insta_job_apply_status'] != 0)
					// {
					// 	$referjob = $this->select_rows('insta_job_refer','insta_job_apply_id',$val->insta_job_apply_id);
					// 	if(count($referjob) > 0)
					// 	{
					// 		$new_arr[$i]['insta_job_referred_date'] = $referjob[0]->insta_job_refer_date;
					// 	}
					// }else{
					// 	$new_arr[$i]['insta_job_referred_date'] = '-';
					// }	
						$i++;	

				
				
			
				
			} //die;
			// echo "<pre>";
			// print_r($new_arr); die;
			return $new_arr;
		} 
	}




	function get_users_referred_jobs($userId)
	{ 
		$apply_user_list = $this->select_rows('insta_job_refer','insta_job_refer_by_user_id',$userId);
		if(count($apply_user_list) > 0)
		{   $i=0; $new_arr = array();
			$this->load->model('AdminModel');	
			$this->load->model('CompanyModel');	
			foreach($apply_user_list as $val)
			{
				
				$new_arr[$i]['insta_job_refer_date'] = $val->insta_job_refer_date;

				$applied_job = $this->select_rows('insta_job_apply','insta_job_apply_id',$val->insta_job_apply_id);
				$new_arr[$i]['insta_job_id'] = $applied_job[0]->insta_job_id;
				$new_arr[$i]['applied_user_id'] = $applied_job[0]->insta_user_id;
				$new_arr[$i]['insta_job_apply_status'] = $applied_job[0]->insta_job_apply_status;
				$new_arr[$i]['insta_job_apply_date'] = $applied_job[0]->insta_job_apply_date;
				$user_name = $this->AdminModel->get_usermeta_byKeyId($applied_job[0]->insta_user_id,'first_name')." ".$this->AdminModel->get_usermeta_byKeyId($applied_job[0]->insta_user_id,'last_name');
				$new_arr[$i]['applied_user_name'] = $user_name;


				$joblist = $this->select_rows('insta_jobs','insta_job_id',$applied_job[0]->insta_job_id);
				$new_arr[$i]['insta_company_id'] = $joblist[0]->insta_company_id;
				$new_arr[$i]['insta_job_title'] = $joblist[0]->insta_job_title;
				$new_arr[$i]['insta_job_tags'] = $joblist[0]->insta_job_tags;
				//$new_arr[$i]['insta_job_skills'] = $joblist[0]->insta_job_skills;
				$new_arr[$i]['insta_job_created_on'] = $joblist[0]->insta_job_created_on;
				$user_name = $this->AdminModel->get_usermeta_byKeyId($joblist[0]->insta_user_id,'first_name')." ".$this->AdminModel->get_usermeta_byKeyId($joblist[0]->insta_user_id,'last_name');
				$new_arr[$i]['job_posted_by'] = $user_name;
				$new_arr[$i]['job_posted_by_user_id'] = $joblist[0]->insta_user_id;

				
				
				$comp_name = $this->AdminModel->get_company_name($joblist[0]->insta_company_id);
				$new_arr[$i]['insta_company_name'] = $comp_name;

				

				$comp_logo = $this->CompanyModel->get_company_metadata($joblist[0]->insta_company_id,'logo');
				$new_arr[$i]['insta_company_logo'] = $comp_logo;

				
				$i++;
				
			} //die;
			// echo "<pre>";
			// print_r($new_arr); die;
			return $new_arr;
		} 
	}


	function get_refer_earn_list($Id="",$field="",$title_skill_like="",$location_like="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_jobs');
		$this->db->where('insta_job_status', 1);  
		if($Id!="" && $field!="")
  		{
  		 	$this->db->where($field, $Id);  
  		} 
  		if(!empty($title_skill_like))
  		{
  			$where = '(insta_job_title like "%'.$title_skill_like.'%" or insta_job_tags like "%'.$title_skill_like.'%")';
            $this->db->where($where);
  			// $this->db->like("insta_job_title", $title_skill_like);
  			// $this->db->or_like("insta_job_tags", $title_skill_like);
  		}
  		if(!empty($location_like))
  		{
  			$this->db->like("insta_job_location", $location_like);
  		}
  		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get();
		$row['job_list'] = $query->result();
		if(count($row['job_list'])>0)
		{
			$key = 0; 
			foreach($row['job_list'] as $new)
			{
				$this->load->model('AdminModel');	
				$this->load->model('CompanyModel');	
				//$apply_user_list = $this->select_rows('insta_job_apply','insta_job_id',$new->insta_job_id);

				$this->db->select("*"); 
				$this->db->from('insta_job_apply');
				$this->db->where('insta_job_id', $new->insta_job_id);
				$this->db->where('insta_job_apply_status', 0);
				$this->db->order_by('insta_job_apply_id','DESC');	
				$query = $this->db->get();
				$apply_user_list = $query->result();

				if(count($apply_user_list) > 0)
				{   $i=0;
					foreach($apply_user_list as $val)
					{

						if($val->insta_job_apply_status == 0)
						{
							
							$apply_user_id = $val->insta_user_id;
							
							$apply_user_name = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'name');
							$apply_user_email = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'email');
							$apply_user_resume = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'resume');
							$apply_user_experience = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'experience');
							$apply_user_profile_pic = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'profile_pic');

							$apply_user_id;
							$apply_user_list[$i] = new stdClass;
							$apply_user_list[$i]->apply_user_id = $apply_user_id;
							$apply_user_list[$i]->apply_user_name = $apply_user_name;
							$apply_user_list[$i]->apply_user_email = $apply_user_email;
							$apply_user_list[$i]->apply_user_experience = $apply_user_experience;
							$apply_user_list[$i]->apply_user_resume = $apply_user_resume;
							$apply_user_list[$i]->apply_user_profile_pic = $apply_user_profile_pic;
							$apply_user_list[$i]->apply_user_message = $val->insta_job_apply_message;  
							$apply_user_list[$i]->insta_job_apply_id = $val->insta_job_apply_id;
							$apply_user_list[$i]->insta_job_apply_date = $val->insta_job_apply_date;

							$apply_user_list[$i]->insta_job_apply_why_get_refer = $val->insta_job_apply_why_get_refer;

							

							$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
							$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
							$apply_user_list[$i]->user = $user_name;
							$apply_user_list[$i]->company = $comp_name;
							

							
							$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
							$apply_user_list[$i]->insta_company_logo = $comp_logo;

							$row['job_list'][$key]->apply_users = $apply_user_list;
							$i++;
						}
						else{
							unset($apply_user_list);
						}
					}
				} 
				

				// $this->load->model('AdminModel');	
				// $apply_user_name = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'name');
				// $apply_user_email = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'email');
				// $apply_user_resume = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'resume');
				// $apply_user_profile_pic = $this->AdminModel->get_usermeta_byKeyId($apply_user_id,'profile_pic');
				// $row['job_list'][$key]->apply_user_id = $apply_user_id;
				// $row['job_list'][$key]->apply_user_name = $apply_user_name;
				// $row['job_list'][$key]->apply_user_email = $apply_user_email;
				// $row['job_list'][$key]->apply_user_resume = $apply_user_resume;
				// $row['job_list'][$key]->apply_user_profile_pic = $apply_user_profile_pic;

				$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
				$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
				$row['job_list'][$key]->user = $user_name;
				$row['job_list'][$key]->company = $comp_name;
				

				$this->load->model('CompanyModel');
				$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
				$row['job_list'][$key]->insta_company_logo = $comp_logo;
				
				
				$key++;
			}
			//echo "<pre>"; print_r($row['job_list']); 
			//die;
			return $row['job_list'];
		}
		else{
			return false;
		}
	}


	function get_job_autosearch_keyword($type="",$value="")
	{
		if($type == "insta_job_title")
		{	
			$value = trim($value);
			$this->db->select("insta_job_title");
			$this->db->like("insta_job_title", $value, "after");	
			$query = $this->db->get("insta_jobs");
			$row['auto_keyword'] = $query->result();
			return $row['auto_keyword'];
		}else if($type == "insta_job_tags")
		{   
			$value = trim($value);
			$this->db->select("insta_job_tags");
			$this->db->like("insta_job_tags", $value);
			$query = $this->db->get("insta_jobs");
			$row['auto_keyword'] = $query->result();
			return $row['auto_keyword'];
		}else if($type == "insta_company_name")
		{ 
			$value = trim($value);
			$this->db->select("insta_company_name");
			$this->db->like("insta_company_name", $value, "after");	
			$query1 = $this->db->get("insta_company");
			$row['auto_company'] = $query1->result();
			return $row['auto_company'];

		}else if($type == "insta_job_location")
		{   
			$value = trim($value);
			$this->db->select("insta_job_location");
			$this->db->like("insta_job_location", $value);
			$query = $this->db->get("insta_jobs");
			$row['auto_keyword'] = $query->result();
			return $row['auto_keyword'];
		}
	}

	function getjobByTags($tag)
	{
		$this->db->select("*"); 
		$this->db->from('insta_jobs');
		$this->db->like("insta_job_tags", $tag);
		$this->db->order_by("insta_job_id", "DESC");
  		
		$query = $this->db->get();
		$row['job_list'] = $query->result();
		if(count($row['job_list'])>0)
		{
			$key = 0; $tags = array();
			foreach($row['job_list'] as $new)
			{
				$this->load->model('AdminModel');				
				$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
				$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
				$this->load->model('CompanyModel');
				$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
				$row['job_list'][$key]->company = $comp_name;
				$row['job_list'][$key]->user = $user_name;
				$row['job_list'][$key]->insta_company_logo = $comp_logo;
				$key++;
			}
			return $row['job_list'];
		}
		else{
			return 'Not available';
		}
	}

	// function get_filter_post_job($type="",$value="")
	// { 
		
	// 	if($type == 'all')
	// 	{
	// 		if(!empty($value['text']))
	// 		{ 

	// 			$this->db->select("insta_company_id"); 
	// 		    $this->db->from('insta_company');
	// 			$this->db->where("insta_company_name", $value['text'] , "after");
	// 			$query = $this->db->get();
	// 			$row['comp_list'] = $query->result();
	// 			if(count($row['comp_list'])>0)
	// 			{
	// 				$comp_id = array();
	// 				foreach($row['comp_list'] as $val)
	// 				{
	// 					array_push($comp_id, $val->insta_company_id);
	// 				}
	// 			}
				
				
				
	// 			$this->db->select("*"); 
	// 		    $this->db->from('insta_jobs');	
	// 		    if(!empty($value['location']))
	// 			{   
	// 				$this->db->like('insta_job_location', $value['location']);		
	// 			}
	// 			if(!empty($value['exp']))
	// 			{
	// 				if($value['exp'] > 1)
	// 				{
	// 					$min = $value['exp']-2;
						
	// 				}else{
	// 					$min = $value['exp'];
	// 				}
					
	// 				$max = $value['exp']+2;
					

	// 				$where = '(insta_job_min_experience>="'.$min.'" AND  insta_job_min_experience<="'.$max.'" OR insta_job_max_experience>="'.$min.'" AND  insta_job_max_experience<="'.$max.'")';
	//                 $this->db->where($where);
	// 			}
			    

				
				
	// 			if(!empty($comp_id))
	// 			{
	// 				$where = '(insta_company_id IN ("' . implode("',' ",$comp_id) . '")  or insta_job_title="'.$value['text'].'" or insta_job_tags="'.$value['text'].'")';
 //                     $this->db->where($where);
					
	// 			}else{				
					
	// 				$where = '(insta_job_title="'.$value['text'].'" or insta_job_tags="'.$value['text'].'")';
 //                     $this->db->where($where);
	// 			}	

				
							
				
	// 		}else{
	// 			$this->db->select("*"); 
	// 		    $this->db->from('insta_jobs');	
	// 		    if(!empty(['location']))
	// 			{   
	// 				$this->db->like('insta_job_location', $value['location']);		
	// 			}
	// 		    if(!empty($value['exp']))
	// 			{
	// 				if($value['exp'] > 1)
	// 				{
	// 					$min = $value['exp']-2;
						
	// 				}else{
	// 					$min = $value['exp'];
	// 				}
					
	// 				$max = $value['exp']+2;
					

	// 				$where = '(insta_job_min_experience>="'.$min.'" AND  insta_job_min_experience<="'.$max.'" OR insta_job_max_experience>="'.$min.'" AND  insta_job_max_experience<="'.$max.'")';
	//                 $this->db->where($where);
	// 			}
	// 		}
			
	// 		if(!empty($value['category']))
	// 		{
	// 			$this->db->where("insta_job_category =",  $value['category']);
	// 		}			
			
	// 	}
	// 	// else if($type == 'title_company_skills_submit')
	// 	// {

	// 	// 	if($value['text'] != "")
	// 	// 	{ 

	// 	// 		$this->db->select("insta_company_id"); 
	// 	// 		$this->db->from('insta_company');
	// 	// 		$this->db->where("insta_company_name", $value['text'] , "after");
	// 	// 		$query = $this->db->get();
	// 	// 		$row['comp_list'] = $query->result();
	// 	// 		if(count($row['comp_list'])>0)
	// 	// 		{
	// 	// 			$comp_id = array();
	// 	// 			foreach($row['comp_list'] as $val)
	// 	// 			{
	// 	// 				array_push($comp_id, $val->insta_company_id);
	// 	// 			}
	// 	// 		}
				
				
				
	// 	// 		$this->db->select("*"); 
	// 	// 		$this->db->from('insta_jobs');		
	// 	// 		$this->db->where('insta_job_closing_date >=', date("Y-m-d"));
	// 	// 		$this->db->where('insta_job_status', 1);
	// 	// 		$this->db->where("insta_job_title =", $value['text']);
	// 	// 		if(!empty($comp_id))
	// 	// 		$this->db->or_where_in('insta_company_id' , $comp_id);
	// 	// 		$this->db->where('insta_job_closing_date >=', date("Y-m-d"));
	// 	// 		$this->db->where('insta_job_status', 1);
	// 	// 		$this->db->or_like("insta_job_tags", $value['text']);
	// 	// 	}
	// 	// 	if($value['location'] != "")
	// 	// 	{   
	// 	// 		if(empty($value['text']))
	// 	// 		{
	// 	// 			$this->db->select("*"); 
	// 	// 			$this->db->from('insta_jobs');
	// 	// 		}
				
	// 	// 		$this->db->like('insta_job_location', $value['location']);		
	// 	// 	}
	// 	// 	if(empty($value['text']) && empty($value['location']))
	// 	// 	{
	// 	// 		$this->db->select("*"); 
	// 	// 		$this->db->from('insta_jobs');
	// 	// 	}
			
	// 	// }
	// 	$this->db->where('insta_job_closing_date >=', date("Y-m-d"));
	// 	$this->db->where('insta_job_status', 1);
	// 	$this->db->order_by("insta_job_id", "DESC");
	// 	$query = $this->db->get();


	// 	//echo $sql = $this->db->last_query();
	// 	$row['job_list'] = $query->result();
	// 		if(count($row['job_list'])>0)
	// 		{
	// 			$key = 0; $tags = array();
	// 			foreach($row['job_list'] as $new)
	// 			{
	// 				$this->load->model('AdminModel');				
	// 				$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
	// 				$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
	// 				$this->load->model('CompanyModel');
	// 				$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
	// 				$row['job_list'][$key]->company = $comp_name;
	// 				$row['job_list'][$key]->user = $user_name;
	// 				$row['job_list'][$key]->insta_company_logo = $comp_logo;
	// 				$key++;
	// 			}
	// 			//  echo "<pre>";
	// 			// print_r($row['job_list']);
	// 			return $row['job_list'];
	// 		}
	// 		else{
	// 			return "Not available";
	// 		}
		
	// }


	function get_filter_post_job($type="",$value="")
	{ 
		
		if($type == 'all')
		{
			if(!empty($value['text']))
			{ 

				$this->db->select("insta_company_id"); 
			    $this->db->from('insta_company');
				$this->db->where("insta_company_name", $value['text'] , "after");
				$query = $this->db->get();
				$row['comp_list'] = $query->result();
				if(count($row['comp_list'])>0)
				{
					$comp_id = array();
					foreach($row['comp_list'] as $val)
					{
						array_push($comp_id, $val->insta_company_id);
					}
				}
				
				
				
				$this->db->select("*"); 
			    $this->db->from('insta_jobs');	
			    if(!empty($value['location']))
				{   
					$this->db->like('insta_job_location', $value['location']);		
				}
				if(isset($value['exp']) && $value['exp'] != "")
				{
					if($value['exp'] > 1)
					{
						$min = $value['exp']-2;
						
					}else{
						$min = $value['exp'];
					}
					
					$max = $value['exp']+2;
					

					$where = '(insta_job_min_experience>="'.$min.'" AND  insta_job_min_experience<="'.$max.'" OR insta_job_max_experience>="'.$min.'" AND  insta_job_max_experience<="'.$max.'")';
	                $this->db->where($where);
				}
			    

				
				
				if(!empty($comp_id))
				{
					$where = '(insta_company_id IN ("' . implode("',' ",$comp_id) . '")  or insta_job_title="'.$value['text'].'" or insta_job_tags="'.$value['text'].'")';
                     $this->db->where($where);
					
				}else{				
					
					$where = '(insta_job_title like "%'.$value['text'].'%" or insta_job_tags like "%'.$value['text'].'%")';
                     $this->db->where($where);
				}	

				
							
				
			}else{
				$this->db->select("*"); 
			    $this->db->from('insta_jobs');	
			    if(!empty($value['location']))
				{   
					$this->db->like('insta_job_location', $value['location']);		
				}
			    if(isset($value['exp']) && $value['exp'] != "")
				{
					if($value['exp'] > 1)
					{
						$min = $value['exp']-2;
						
					}else{
						$min = $value['exp'];
					}
					
					$max = $value['exp']+2;
					

					$where = '(insta_job_min_experience>="'.$min.'" AND  insta_job_min_experience<="'.$max.'" OR insta_job_max_experience>="'.$min.'" AND  insta_job_max_experience<="'.$max.'")';
	                $this->db->where($where);
				}

				if(!empty($value['category']))
				{
					$this->db->where("insta_job_category =",  $value['category']);
				}

				if(empty($value['location']) && !empty($this->session->my_current_location))
				{
					$this->db->like('insta_job_location', $this->session->my_current_location);
				}		
			}
			
			$this->db->where('insta_job_closing_date >=', date("Y-m-d"));
			$this->db->where('insta_job_status', 1);
			$this->db->order_by("insta_job_id", "DESC");
			$query = $this->db->get();		
			
		
		
		


		//echo $sql = $this->db->last_query();
		$row['job_list'] = $query->result();
			if(count($row['job_list'])>0)
			{
				$key = 0; $tags = array();
				foreach($row['job_list'] as $new)
				{
					$this->load->model('AdminModel');				
					$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
					$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
					$this->load->model('CompanyModel');
					$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
					$row['job_list'][$key]->company = $comp_name;
					$row['job_list'][$key]->user = $user_name;
					$row['job_list'][$key]->insta_company_logo = $comp_logo;
					$key++;
				}
				//  echo "<pre>";
				// print_r($row['job_list']);
				return $row['job_list'];
			}
			else{
				return "Not available";
			}
		}
		
	}

	function get_related_jobs($jobId,$minExp=0, $maxExp=0, $tags="", $companyId)
	{
		
		$jobids = array();
		$this->db->select("*"); 
		$this->db->from('insta_jobs');
		$this->db->where("insta_job_id !=", $jobId);	
		$this->db->where("insta_company_id =", $companyId);	
		$this->db->where("FIND_IN_SET('$tags',insta_job_tags) !=", 0);	
		$this->db->where('insta_job_min_experience >=', $minExp);
		$this->db->where('insta_job_max_experience <=', $maxExp);
		$this->db->limit(5);
		$this->db->order_by("insta_job_id", "DESC");
		$query = $this->db->get(); 
		$row['job_list'] = $query->result();

		if(count($row['job_list']) > 0)
		{
			foreach($row['job_list'] as $vals) {
				array_push($jobids, $vals->insta_job_id);
			}
		}
		
		if(count($row['job_list']) != 5)
		{
			$limit = 5 - count($row['job_list']);
			$this->db->select("*"); 
			$this->db->from('insta_jobs');
			if(!empty($jobids)){
				$this->db->where_not_in('insta_job_id', $jobids);
			}			
			$this->db->where("insta_job_id !=", $jobId);	
			$this->db->where("FIND_IN_SET('$tags',insta_job_tags) !=", 0);	
			$this->db->where('insta_job_min_experience >=', $minExp);
			$this->db->where('insta_job_max_experience <=', $maxExp);	
			$this->db->limit($limit);
			$this->db->order_by("insta_job_id", "DESC");
			$query = $this->db->get();  

			$new_list['job'] = $query->result();
			
			if(count($new_list['job']) > 0)
			{
				foreach($new_list['job'] as $n_arr) 
				{
					
					array_push($jobids, $n_arr->insta_job_id);
					array_push($row['job_list'], $n_arr);					
				}
			}
		}
		
		if(count($row['job_list']) != 5)
		{
			$limit = 5 - count($row['job_list']);
			$this->db->select("*"); 
			$this->db->from('insta_jobs');
			if(!empty($jobids)){
				$this->db->where_not_in('insta_job_id', $jobids);
			}
			$this->db->where("insta_job_id !=", $jobId);	
			$this->db->where("FIND_IN_SET('$tags',insta_job_tags) !=", 0);	
			$this->db->or_where('insta_job_min_experience >=', $minExp);			
			$this->db->where('insta_job_max_experience <=', $maxExp);
			$this->db->where("insta_job_id !=", $jobId);	
			if(!empty($jobids)){
				$this->db->where_not_in('insta_job_id', $jobids);
			}	
			$this->db->limit($limit);
			$this->db->order_by("insta_job_id", "DESC");
			$query = $this->db->get(); 

			$new_list['job'] = $query->result();
			if(count($new_list['job']) > 0)
			{
				foreach($new_list['job'] as $n_arr) 
				{
					
					array_push($jobids, $n_arr->insta_job_id);
					array_push($row['job_list'], $n_arr);
				}
			}
		}

		
		
		$key = 0;
		foreach($row['job_list'] as $new)
		{
			$this->load->model('AdminModel');
			$comp_name = $this->AdminModel->get_company_name($new->insta_company_id);
			$comp_logo = $this->CompanyModel->get_company_metadata($new->insta_company_id,'logo');
			$user_name = $this->AdminModel->get_usermeta_byKeyId($new->insta_user_id,'name');
			$row['job_list'][$key]->company=$comp_name;
			$row['job_list'][$key]->insta_company_logo=$comp_logo;
			$row['job_list'][$key]->user=$user_name;
			$key++;
			
		}
		return $row['job_list'];
	}	

	public function updateJob($data,$jobId)
	{
		$this->db->where('insta_job_id', $jobId);
	    $this->db->update('insta_jobs', $data);
	    return true;
	} 

	public function updateCategory($data,$categoryId)
	{
		$this->db->where('insta_job_category_id', $categoryId);
	    $this->db->update('insta_job_category', $data);
	    return true;
	} 

	public function  deleteJob($jobId)
	{
		$this->db->where('insta_job_id =', $jobId);
		$this->db->delete('insta_jobs');
	}

	public function deleteCategory($categoryId)
	{
		$this->db->where('insta_job_category_id =', $categoryId);
		$this->db->delete('insta_job_category');
	}

	public function refer_mail($applyId)
	{
		$this->load->model('AdminModel');	
		$this->load->model('HomeModel');
		$applied_detail = $this->select_rows('insta_job_apply','insta_job_apply_id',$applyId);
		if(!empty($applied_detail[0]))
		{
			$apllied_job_detail = $this->select_rows('insta_jobs','insta_job_id',$applied_detail[0]->insta_job_id);
		}
		
		if(!empty($applied_detail[0]) && !empty($apllied_job_detail[0]))
		{
			$job_posted_on = $apllied_job_detail[0]->insta_job_created_on;
			$job_title = $apllied_job_detail[0]->insta_job_title;

			$referred_candidate_email = $this->AdminModel->get_usermeta_byKeyId($applied_detail[0]->insta_user_id,'email');
			$referred_candidate_first_name = $this->AdminModel->get_usermeta_byKeyId($applied_detail[0]->insta_user_id,'first_name');
			$referred_candidate_last_name = $this->AdminModel->get_usermeta_byKeyId($applied_detail[0]->insta_user_id,'last_name');
			$referred_candidate_resume = USER_UPLOAD_PATH.''.$this->AdminModel->get_usermeta_byKeyId($applied_detail[0]->insta_user_id,'resume');
			
			$to = $this->session->user_session['email'];
			$sub = "Instarefr : Jobs";
			$msg = '<!DOCTYPE html>
<html>
  <head>
    <style>
      @media only screen and (max-device-width: 480px) {
        
      }
    </style>
  </head>
  <body>
    <div bgcolor="#FAFAFA" lang="EN-IN" link="blue" vlink="purple">
      <div>
        <p>&nbsp;</p>
        <div align="center">
          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; background: #fafafa; border-collapse: collapse;">
            <tbody>
              <tr>
                <td width="100%" valign="top" style="width: 100.0%; padding: 7.5pt 7.5pt 7.5pt 7.5pt;">
                  <div align="center">
                    <table border="0" cellspacing="0" cellpadding="0" width="600" style="width: 450.0pt; border-collapse: collapse;">
                      <tbody>
                        <tr>
                          <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm;">
                            <div align="center">
                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                <tbody>
                                  <tr>
                                    <td valign="top" style="background: #fafafa; padding: 6.75pt 0cm 6.75pt 0cm;"></td>
                                  </tr>
                                  <tr style="background-color:#fff;">
                                    <td valign="top" style="background: cover; padding: 6.75pt 0cm 0cm 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 6.75pt 6.75pt 6.75pt; min-width: 100%;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td valign="top" style="padding: 0cm 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                      <p align="center" style="text-align: center;"><a href="http://www.instarefr.com/" title="" target="_blank"><span style="text-decoration: none;"><img border="0" width="280" src="'.IMAGE_PATH.'insta-1.png" /></span></a></p>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr style="background-color:#fff;">
                                    <td valign="top" style="border: none; border-bottom: solid #eaeaea 1.5pt; background: cover; padding: 0cm 0cm 6.75pt 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 0cm 0cm 0cm; min-width: 100%;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm; max-width: 100%; min-width: 100%;">
                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse; word-break: break-word;">
                                                        <tbody>
                                                          <tr>
                                                            <td valign="top" style="padding: 0cm 13.5pt 6.75pt 13.5pt;">
                                                              <h1>Hello '.$this->session->user_session['first_name'].' '.$this->session->user_session['last_name'].',</h1>
                                                              <p style="line-height: 150%;"><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #202020;">&nbsp;</span></p>
                                                              <p style="margin-right: 0cm; margin-bottom: 7.5pt; margin-left: 0cm; line-height: 150%;"><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #202020;">Thank you for downloading resume <a href="'.$referred_candidate_resume.'">attached</a> of '.$referred_candidate_first_name.'.<br />Please submit the same to your company HR for further process.<br /><br />In case you need any further information, please contact '.$referred_candidate_email.' or call directly to the candidate.<br /><br /> Good luck!!</span></p>
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top" style="background: cover; padding: 6.75pt 0cm 6.75pt 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 6.75pt 6.75pt 6.75pt; min-width: 100%;">
                                              <div align="center">
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                  <tbody>
                                                    <tr>
                                                      <td style="padding: 0cm 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                        <div align="center">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                            <tbody>
                                                              <tr>
                                                                <td valign="top" style="padding: 6.75pt 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                                  <div align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                            <div align="center">
                                                                              <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                                                                                <tbody>
                                                                                  <tr>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="http://www.instarefr.com" target="_blank"><span style="text-decoration: none;"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-link.png" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://twitter.com/instarefr" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-tw.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://www.facebook.com/instarefr/" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-fb.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 0cm 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://www.linkedin.com/company/instarefr.com" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-li.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                  </tr>
                                                                                </tbody>
                                                                              </table>
                                                                            </div>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </div>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 0cm 0cm 0cm;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm; max-width: 100%; min-width: 100%;">
                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse; word-break: break-word;">
                                                        <tbody>
                                                          <tr>
                                                            <td valign="top" style="padding: 0cm 13.5pt 6.75pt 13.5pt;">
                                                              <p align="center" style="text-align: center; line-height: 150%;"><em><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #656565;">Tip: Connect with your referrer and grow your professional network to explore better opportunities in future</span></em><span style="font-size: 9.0pt; line-height: 150%; font-family: \'Helvetica\',\'sans-serif\'; color: #656565;"></span></p>
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td style="padding: 7.5pt 13.5pt 18.75pt 13.5pt; min-width: 100%;">
                                              <table border="1" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; border: none; min-width: 100%;">
                                                <tbody>
                                                  <tr>
                                                    <td style="border: none; border-top: solid #eeeeee 1.5pt; padding: 0cm 0cm 0cm 0cm; min-width: 100%;"></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>';
			/*$msg = "Hello ".$referred_candidate_first_name." ".$referred_candidate_last_name." , <br>
			<p>Welcome to Instarefr, You are successfully referred for job.<br>
			Referred By :". $this->session->user_session['first_name']. " " .$this->session->user_session['last_name']." <br>Company : ".$this->session->user_session['company_name']."<br>
			Post : ".$job_title."<br>
			Posted on : ".$job_posted_on."</p>";*/
			$this->HomeModel->sendMail($sub, $msg, $to, '');

			
			// $msg = "Hello ".$this->session->user_session['first_name']." ".$this->session->user_session['last_name']." , <br>";
			// $msg .= "<p>Welcome to Instarefr, You have successfully referred to candidate for job.<br>";
			// $msg .= "Referred By :". $this->session->user_session['first_name']. " " .$this->session->user_session['last_name']." <br>Company : ".$this->session->user_session['company_name']."<br>";
			// $msg .= "Post : ".$job_title."<br>";
			// $msg .= "Posted on : ".$job_posted_on."</p>";
			$to = $referred_candidate_email;
			$sub = "Instarefr : Jobs";
			$msg = '<!DOCTYPE html>
<html>
  <head>
    <style>
      @media only screen and (max-device-width: 480px) {
        
      }
    </style>
  </head>
  <body>
    <div bgcolor="#FAFAFA" lang="EN-IN" link="blue" vlink="purple">
      <div>
        <p> </p>
        <div align="center">
          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; background: #fafafa; border-collapse: collapse;">
            <tbody>
              <tr>
                <td width="100%" valign="top" style="width: 100.0%; padding: 7.5pt 7.5pt 7.5pt 7.5pt;">
                  <div align="center">
                    <table border="0" cellspacing="0" cellpadding="0" width="600" style="width: 450.0pt; border-collapse: collapse;">
                      <tbody>
                        <tr>
                          <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm;">
                            <div align="center">
                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                <tbody>
                                  <tr>
                                    <td valign="top" style="background: #fafafa; padding: 6.75pt 0cm 6.75pt 0cm;"></td>
                                  </tr>
                                  <tr style="background-color:#fff;">
                                    <td valign="top" style="background: cover; padding: 6.75pt 0cm 0cm 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 6.75pt 6.75pt 6.75pt; min-width: 100%;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td valign="top" style="padding: 0cm 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                      <p align="center" style="text-align: center;"><a href="http://www.instarefr.com/" title="" target="_blank"><span style="text-decoration: none;"><img border="0" width="280" src="'.IMAGE_PATH.'insta-1.png" /></span></a></p>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr style="background-color:#fff;">
                                    <td valign="top" style="border: none; border-bottom: solid #eaeaea 1.5pt; background: cover; padding: 0cm 0cm 6.75pt 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 0cm 0cm 0cm; min-width: 100%;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm; max-width: 100%; min-width: 100%;">
                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse; word-break: break-word;">
                                                        <tbody>
                                                          <tr>
                                                            <td valign="top" style="padding: 0cm 13.5pt 6.75pt 13.5pt;">
                                                              <h1>Congratulation '.$referred_candidate_first_name.' '.$referred_candidate_last_name.'!</h1>
                                                              <p style="line-height: 150%;"><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #202020;">&nbsp;</span></p>
                                                              <p style="margin-right: 0cm; margin-bottom: 7.5pt; margin-left: 0cm; line-height: 150%;"><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #202020;">'.$this->session->user_session['first_name'].' '.$this->session->user_session['last_name'].' has decided to refer you for "'.$job_title.'" at '.$this->session->user_session['company_name'].'.<br /> Say thank you at '.$this->session->user_session['email'].'.<br /><br /> Follow up with your referrer if any other information required.<br /><br /> Good luck!!</span></p>
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top" style="background: cover; padding: 6.75pt 0cm 6.75pt 0cm; background-size: cover;">
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 6.75pt 6.75pt 6.75pt; min-width: 100%;">
                                              <div align="center">
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                  <tbody>
                                                    <tr>
                                                      <td style="padding: 0cm 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                        <div align="center">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                            <tbody>
                                                              <tr>
                                                                <td valign="top" style="padding: 6.75pt 6.75pt 0cm 6.75pt; min-width: 100%;">
                                                                  <div align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                                                                      <tbody>
                                                                        <tr>
                                                                          <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                            <div align="center">
                                                                              <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                                                                                <tbody>
                                                                                  <tr>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="http://www.instarefr.com" target="_blank"><span style="text-decoration: none;"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-link.png" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://twitter.com/instarefr" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-tw.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 7.5pt 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://www.facebook.com/instarefr/" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-fb.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                    <td valign="top" style="padding: 0cm 0cm 0cm 0cm;">
                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
                                                                                        <tbody>
                                                                                          <tr>
                                                                                            <td valign="top" style="padding: 0cm 0cm 6.75pt 0cm;">
                                                                                              <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                                                                <tbody>
                                                                                                  <tr>
                                                                                                    <td style="padding: 3.75pt 7.5pt 3.75pt 6.75pt;">
                                                                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width: 0cm; border-collapse: collapse;">
                                                                                                        <tbody>
                                                                                                          <tr>
                                                                                                            <td width="24" style="width: 18.0pt; padding: 0cm 0cm 0cm 0cm;">
                                                                                                              <p align="center" style="text-align: center;"><a href="https://www.linkedin.com/company/instarefr.com" target="_blank"><span style="text-decoration: none;"><img src="'.IMAGE_PATH.'insta-li.png" border="0" width="24" height="24" /></span></a></p>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </tbody>
                                                                                              </table>
                                                                                            </td>
                                                                                          </tr>
                                                                                        </tbody>
                                                                                      </table>
                                                                                    </td>
                                                                                  </tr>
                                                                                </tbody>
                                                                              </table>
                                                                            </div>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </div>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td valign="top" style="padding: 6.75pt 0cm 0cm 0cm;">
                                              <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse;">
                                                <tbody>
                                                  <tr>
                                                    <td width="600" valign="top" style="width: 450.0pt; padding: 0cm 0cm 0cm 0cm; max-width: 100%; min-width: 100%;">
                                                      <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width: 100.0%; border-collapse: collapse; word-break: break-word;">
                                                        <tbody>
                                                          <tr>
                                                            <td valign="top" style="padding: 0cm 13.5pt 6.75pt 13.5pt;">
                                                              <p align="center" style="text-align: center; line-height: 150%;"><em><span style="font-family: \'Helvetica\',\'sans-serif\'; color: #656565;">Tip: Connect with your referrer and grow your professional network to explore better opportunities in future</span></em><span style="font-size: 9.0pt; line-height: 150%; font-family: \'Helvetica\',\'sans-serif\'; color: #656565;"></span></p>
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; min-width: 100%;">
                                        <tbody>
                                          <tr>
                                            <td style="padding: 7.5pt 13.5pt 18.75pt 13.5pt; min-width: 100%;">
                                              <table border="1" cellspacing="0" cellpadding="0" width="100%" style="width: 100.0%; border-collapse: collapse; border: none; min-width: 100%;">
                                                <tbody>
                                                  <tr>
                                                    <td style="border: none; border-top: solid #eeeeee 1.5pt; padding: 0cm 0cm 0cm 0cm; min-width: 100%;"></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>';
			$this->HomeModel->sendMail($sub, $msg, $to, '');
		}		
		
	}



}
?>