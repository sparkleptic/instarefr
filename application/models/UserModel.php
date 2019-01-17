<?php
class UserModel extends CI_Model {
 
	public function addUser($data,$email="")
	{
		$this->db->insert('insta_user', $data);
		$userId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			if(!empty($_COOKIE['instarefr_invited_email'])) {
				// if(in_array($_COOKIE['instarefr_invited_email'], array_column($data, 'insta_user_email_facebook'))) {
				// 	$this->load->model('PointsModel');
				// 	$this->PointsModel->points_transaction('Mail to Us',$data[0]['insta_user_id']);
				// }
				
				// if($email == $_COOKIE['instarefr_invited_email']) {
				// 	$this->load->model('PointsModel');
				// 	$this->PointsModel->points_transaction('Invite Friend',$data[0]['insta_user_id']);
				// }
				$this->db->select("insta_user_id"); 
				$this->db->from('insta_user_meta');
				$this->db->where('insta_user_meta_key =', 'email');
				$this->db->where('insta_user_meta_value =', $_COOKIE['instarefr_invited_email']);
				
				$query = $this->db->get();
				$row['user'] = $query->result();  
				if(count($row['user']) > 0)
				{
					//echo "<pre>"; print_r($row['user']); 
					$this->load->model('PointsModel'); //die;
				    $this->PointsModel->points_transaction('Invite Friend',$row['user'][0]->insta_user_id);
				}
				
				// $user_id = $this->db->get_where('insta_user_meta', array('insta_user_meta_key =' => 'email','insta_user_meta_value =' => $_COOKIE['instarefr_invited_email']))->row()->insta_user_id;
				// $this->load->model('PointsModel');
				// $this->PointsModel->points_transaction('Invite Friend',$user_id);

			}

			return $userId;
		}
		else
		{
			return false;
		}
	}

	public function add_UserMeta($data)
	{
		$this->db->insert_batch('insta_user_meta', $data);
		$userId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			
			return $userId;
		}
		else
		{
			return false;
		}
	}

	public function get_user_data($userId="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_user');
		if(!empty($userId))
		{ 
			$this->db->where('insta_user_id =', $userId);
		}
		$query = $this->db->get();
		$row['user'] = $query->result();  

		

		if(!empty($row['user'])){
			$i = 0;
			foreach($row['user'] as $val)
			{ 
				$query = $this->db->get_where('insta_user_meta', array('insta_user_id =' => $val->insta_user_id));
			
				if ($query->num_rows())
			    {
			        $user_meta = $query->result_array(); 
			        $row1['user_meta'] = array();
			        foreach($user_meta as $key)
			        {
			        	if($key['insta_user_meta_key'] == 'company')
			        	{
			        		$this->load->model('CompanyModel');
							$company = $this->CompanyModel->get_company_list($key['insta_user_meta_value']);
							//print_r($company[0]->insta_company_name); die;
							if(!empty($company[0]))
							{
								$row1['user_meta']['company_name'] = $company[0]->insta_company_name;
							}
							
			        	}
			        	$row1['user_meta'][$key['insta_user_meta_key']] = $key['insta_user_meta_value'];
			        }
			        $row1['user_meta'] = json_encode($row1['user_meta']);
			        $row['user'][$i]->user_meta = $row1['user_meta'];
			       // array_merge($row['user'][$i], $row['user_meta']);
			    }
			    $i++;
			}			

		}
		//echo "<pre>"; print_r($row);
		return $row['user']; 
	}


	public function userAlreadyExists($loginId,$loginType,$loginEmail)
	{
		if(!empty($loginEmail))
		{ 
			$this->db->where('insta_user_email_facebook =', $loginEmail);
			$this->db->or_where('insta_user_email_google =', $loginEmail);
			$this->db->or_where('insta_user_email_linkedin =', $loginEmail);
			$query = $this->db->get('insta_user');	
			$row['user'] = $query->row(); 
			
		} 
		if(empty($row['user']) && $loginId != "")
		{ 
			$this->db->where('insta_user_social_id =', $loginId);
			$this->db->where('insta_user_login_type =', $loginType);
			$query = $this->db->get('insta_user');	
			$row['user'] = $query->row();  //godwithme@123
		}
		//echo $this->db->last_query(); die;
		if(!empty($row['user'])){
			$query = $this->db->get_where('insta_user_meta', array('insta_user_id =' => $row['user']->insta_user_id));
			
			if ($query->num_rows())
		    {
		        $user_meta = $query->result_array(); 
		        $row['user_meta'] = array();
		        foreach($user_meta as $key)
		        {
		        	if($key['insta_user_meta_key'] == 'company')
		        	{
		        		$this->load->model('CompanyModel');
						$company = $this->CompanyModel->get_company_list($key['insta_user_meta_value']);
						if(!empty($company))
						{
							$row['user_meta']['company_name'] = $company[0]->insta_company_name;
						}else{
							$row['user_meta']['company_name'] = '';
						}
						
		        	}
		        	$row['user_meta'][$key['insta_user_meta_key']] = $key['insta_user_meta_value'];
		        }
		        $row['user_meta'] = json_encode($row['user_meta']);
		    }

		}
		
		return $row; 
	}

	// function get_usermeta_byKeyId($user_id,$user_meta_key)
	// {
	// 	return $query = $this->db->get_where('insta_user_meta', array('insta_user_meta_key =' => $user_meta_key,'insta_user_id =' => $user_id))->row()->insta_user_meta_value;
		
	// }

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

	public function  delete_User($user_id)
	{
		$this->db->where('insta_user_id =', $user_id);
		$this->db->delete('insta_user');
	}

	public function  delete_UserMeta($user_id)
	{
		$this->db->where('insta_user_id =', $user_id);
		$this->db->delete('insta_user_meta');
	}

	public function  update_UserMeta($user_id,$user_data)
	{
		$total_updated_round = $this->get_usermeta_byKeyId($user_id,'total_updated_round');
		if($total_updated_round == 1)
		{
			$this->load->model('PointsModel');
			$this->PointsModel->points_transaction('Complete My Account',$user_id);
		}
		$this->delete_UserMeta($user_id);
		$this->add_UserMeta($user_data);
	} 
}
?>