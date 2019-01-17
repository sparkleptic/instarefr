<?php
class CompanyModel extends CI_Model {
 
 	function get_company_list($companyId="",$type="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_company');
		if($type != 'Admin')
  		{
  		 	$this->db->where('insta_company_status', 1);  
  		} 
		if($companyId!="")
  		{
  		 	$this->db->where('insta_company_id', $companyId);  
  		} 
  		else{
  			$this->db->order_by('insta_company_id','DESC');	 
  		}
		$query = $this->db->get();
		return $query->result();
	}


	function get_company_id($field, $value)
	{
		$this->db->select("insta_company_id"); 
		$this->db->from('insta_company');
		if($field!="" && $value!="")
  		{
  		 	$this->db->where($field, $value);  
  		} 
		$query = $this->db->get();
		$result = $query->result();
		if(count($result) > 0)
		{
			return $result[0]->insta_company_id;
		}else{
			return 0;
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



	function deleteCompany($companyId="")
	{
		$this->db->where('insta_company_id =', $companyId);
		$this->db->delete('insta_company');
	}

	function updateCompany($data,$companyId)
	{
		$this->db->where('insta_company_id', $companyId);
	    $this->db->update('insta_company', $data);
	    return true;
	} 

	function get_company_metadata($companyId="",$key="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_company');
		$this->db->where('insta_company_id', $companyId);
		$query = $this->db->get();
		$row = $query->result();
		$new = json_decode($row[0]->insta_company_alias);
		if(count($new) > 0)
		{
			if(!empty($new->insta_company_logo))
			{
				return $new->insta_company_logo; 
			}else{
				return "";
			}
			
		}
		
	}	
 
}
?>