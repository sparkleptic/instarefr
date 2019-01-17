<?php
class AdminModel extends CI_Model {

 	// Read data using username and password
	public function login($data) {
		$condition = "insta_admin_username =" . "'" . $data['username'] . "' AND " . "insta_Admin_password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('insta_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}


	public function add_admin($data)
	{
		$this->db->insert('insta_admin', $data);
		$adminId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $adminId;
		}
		else
		{
			return false;
		}
	} 

	public function get_backend_users()
	{
		$this->db->select('*'); 
		$this->db->from('insta_admin');
		$this->db->order_by("insta_admin_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	} 


	// Read data from database to show data in admin page
	public function read_admin_information($username) {

		$condition = "insta_admin_username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('insta_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function get_user_list($userId="") {
		 $this->db->select("*"); 
  		 $this->db->from('insta_user');
  		 if($userId!="")
  		 {
  		 	$this->db->where('insta_user_id', $userId);  
  		 }  	
  		 $this->db->order_by('insta_user_id','DESC');	 
  		 $query = $this->db->get();
  		 $row['user'] = $query->result();
  		 if($row['user'])
  		 {
  		 	$c = array();
  		 	foreach($row['user'] as $key=>$arr)
  		 	{
  		 		$query = $this->db->get_where('insta_user_meta', array('insta_user_id =' => $arr->insta_user_id));
  		 		if ($query->num_rows())
			    {
			        $user_meta = $query->result_array(); 
			        $row['user_meta'] = array();
			        foreach($user_meta as $key)
			        {			        		        	
			        	$new['user_meta'][$key['insta_user_meta_key']] = $key['insta_user_meta_value'];
			        }
			       
			       $SQL = 'select insta_user_id from (select insta_user_id as insta_user_id from insta_jobs  union all  select insta_user_id from insta_job_apply union all  select insta_job_refer_by_user_id from insta_job_refer union all  select insta_user_id from insta_payment_process union all select insta_user_id from insta_payment) a where insta_user_id = "'.$arr->insta_user_id.'"';
	        		$query = $this->db->query($SQL);
	        		$foreign = $query->result_array();
	        		if(count($foreign) > 0)
	        		{
	        			$new['user_meta']['user_can_delete'] = 'NO';	        			
	        		}else{
	        			$new['user_meta']['user_can_delete'] = 'Yes';
	        		}

			        $row1['user_meta'][$arr->insta_user_id] = $new['user_meta'];
			        array_push($c, json_encode($row1['user_meta'][$arr->insta_user_id]));
			    }		       
	        		
  		 	}
  		 	$row['user_meta'] = $c; 
  		 	//echo "<pre>"; print_r($row['user_meta']); die;
  		 	return $row;
  		  } else {
		 	return false;
		 }		
	}

	function get_company_name($compnay_id)
	{
		return $query = $this->db->get_where('insta_company', array('insta_company_id =' => $compnay_id))->row()->insta_company_name;
		
	}

	function get_usermeta_byKeyId($user_id,$user_meta_key)
	{
		//return $query = $this->db->get_where('insta_user_meta', array('insta_user_meta_key =' => $user_meta_key,'insta_user_id =' => $user_id))->row()->insta_user_meta_value;
		$this->db->select("insta_user_meta_value"); 
		$this->db->from('insta_user_meta');
		$this->db->where('insta_user_meta_key =', $user_meta_key);
		$this->db->where('insta_user_id =', $user_id);
		$query = $this->db->get();
		$row = $query->result();
		if(count($row) > 0)
		{
			return $row[0]->insta_user_meta_value;
		}else{
			return '';
		}
		//print_r($row); die;
	}

	

	function get_company_list()
	{
		$this->db->select("*"); 
		$this->db->from('insta_company');
		$query = $this->db->get();
		return $query->result();
	}	

	public function update_admin($data , $adminId)
	{
		$this->db->where('insta_admin_id', $adminId);
	    $this->db->update('insta_admin', $data);
	    return true;
	}

	 
	public function deleteAdmin($adminId)
	{
		$this->db->where('insta_admin_id =', $adminId);
		$this->db->delete('insta_admin');
	}

	function get_applied_job_users()
	{ 
		$this->load->model('JobModel');
		//$apply_job_list = $this->select_rows('insta_job_apply');
		$this->db->distinct();
		$this->db->select('insta_job_id');
		$this->db->from('insta_job_apply');
		$this->db->order_by("insta_job_apply_id", "DESC");
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
				
				$joblist = $this->JobModel->select_rows('insta_jobs','insta_job_id',$val->insta_job_id);
				$job = $joblist[0];

					$new_arr[$i]['apply_list'] = $this->JobModel->select_rows('insta_job_apply','insta_job_id',$val->insta_job_id);
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

	function get_reffered_job_users()
	{ 
		$this->load->model('JobModel');
		$apply_user_list = $this->JobModel->select_rows('insta_job_refer');

		if(count($apply_user_list) > 0)
		{   
			$i=0; $new_arr = array();
				
			$this->load->model('CompanyModel');	
			foreach($apply_user_list as $val)
			{
				//echo "<pre>"; print_r($val); die;
				$new_arr[$i]['insta_job_refer_date'] = $val->insta_job_refer_date;

				$applied_job = $this->JobModel->select_rows('insta_job_apply','insta_job_apply_id',$val->insta_job_apply_id);
				if(!empty($applied_job))
				{

				
				$new_arr[$i]['insta_job_id'] = $applied_job[0]->insta_job_id;
				$new_arr[$i]['applied_user_id'] = $applied_job[0]->insta_user_id;

				$user_name = $this->AdminModel->get_usermeta_byKeyId($val->insta_job_refer_by_user_id,'first_name').' '.$this->AdminModel->get_usermeta_byKeyId($val->insta_job_refer_by_user_id,'last_name') ;
				$new_arr[$i]['referred_user_name'] = $user_name;

				$new_arr[$i]['insta_job_apply_status'] = $applied_job[0]->insta_job_apply_status;
				$new_arr[$i]['insta_job_apply_date'] = $applied_job[0]->insta_job_apply_date;
				$user_name = $this->AdminModel->get_usermeta_byKeyId($applied_job[0]->insta_user_id,'first_name').' '.$this->AdminModel->get_usermeta_byKeyId($applied_job[0]->insta_user_id,'last_name');
				$new_arr[$i]['applied_user_name'] = $user_name;


				$joblist = $this->JobModel->select_rows('insta_jobs','insta_job_id',$applied_job[0]->insta_job_id);
				$new_arr[$i]['insta_company_id'] = $joblist[0]->insta_company_id;
				$new_arr[$i]['insta_job_title'] = $joblist[0]->insta_job_title;
				$new_arr[$i]['insta_job_tags'] = $joblist[0]->insta_job_tags;
				//$new_arr[$i]['insta_job_skills'] = $joblist[0]->insta_job_skills;
				$new_arr[$i]['insta_job_created_on'] = $joblist[0]->insta_job_created_on;
				$user_name = $this->AdminModel->get_usermeta_byKeyId($joblist[0]->insta_user_id,'first_name').' '.$this->AdminModel->get_usermeta_byKeyId($joblist[0]->insta_user_id,'last_name');
				$new_arr[$i]['job_posted_by'] = $user_name;
				$new_arr[$i]['job_posted_by_user_id'] = $joblist[0]->insta_user_id;

				
				
				$comp_name = $this->AdminModel->get_company_name($joblist[0]->insta_company_id);
				$new_arr[$i]['insta_company_name'] = $comp_name;

				

				$comp_logo = $this->CompanyModel->get_company_metadata($joblist[0]->insta_company_id,'logo');
				$new_arr[$i]['insta_company_logo'] = $comp_logo;

				
				$i++;
			}
				
			} 
			 // echo "<pre>";
			 // print_r($new_arr); die;
			return $new_arr;
		} 
	}


}
?>