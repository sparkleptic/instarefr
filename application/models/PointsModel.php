<?php
class PointsModel extends CI_Model {

	function get_points_rule($pointId="",$field="")
	{
		$this->db->select("*"); 
		$this->db->from('insta_points_rule');
		if($pointId!="" && $field!="")
  		{
  		 	$this->db->where($field, $pointId);  
  		} 
  		$this->db->order_by("insta_points_rule_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	}

	function get_points_transaction($userId)
	{
		$this->db->select("*"); 
		$this->db->from('insta_points_transaction');
		if($userId!="")
  		{
  		 	$this->db->where('insta_points_user_id', $userId);  
  		} 
  		$this->db->order_by('insta_points_transaction_id', 'DESC'); 
		$query = $this->db->get();
		$row = $query->result();
		
		if(count($row)>0)
		{
			$key = 0; $tags = array();
			foreach($row as $new)
			{

				$rules = $this->get_points_rule($new->insta_points_rule_id,'insta_points_rule_id');
				$row[$key]->rule_name = $rules[0]->insta_points_rule_name;

				if($rules[0]->insta_points_rule_name == 'Custom')
				{
					if (strpos($new->insta_points_transaction_amount, '+') !== false) {
					    $row[$key]->rule_type = 'Credit';
					}else{
					    $row[$key]->rule_type = 'Debit';
					}
					$row[$key]->rule_description = $rules[0]->insta_points_rule_description;
				}
				else
				{
					$row[$key]->rule_type = $rules[0]->insta_points_rule_type;
					$row[$key]->rule_description = $rules[0]->insta_points_rule_description;
				}

				
				
				$key++;
			}
			// echo "<pre>";
			// print_r($row); 
			// $rest = substr($str, 0, -3); 
			// $rest = substr($str, -4);
			// die;
			return $row;
		}
		else{
			return false;
		}

	}

	function get_candidates_current_point_list()
	{
		$this->db->select("*"); 
		$this->db->from('insta_user');
		if(!empty($userId))
		{ 
			$this->db->where('insta_user_id =', $userId);
		}
		$query = $this->db->get();
		$row['user_points'] = $query->result();  

		if(!empty($row['user_points']))
		{
			$i = 0; 
			foreach($row['user_points'] as $val)
			{   
				$this->load->model('AdminModel');	
				$this->db->select("insta_points_transaction_current_points"); 
				$this->db->from('insta_points_transaction');
				$this->db->where('insta_points_user_id', $val->insta_user_id);
				$this->db->order_by("insta_points_transaction_id", "DESC");
				$this->db->limit(1);
				$query = $this->db->get();
				$points = $query->result();
				if(count($points) > 0)
				{
					 $row['user_points'][$i]->current_point = $points[0]->insta_points_transaction_current_points;
				}else{
					 $row['user_points'][$i]->current_point = 0;
				}
				
					$row['user_points'][$i]->candidate_name = $this->AdminModel->get_usermeta_byKeyId($val->insta_user_id,'first_name')." ".$this->AdminModel->get_usermeta_byKeyId($val->insta_user_id,'last_name');
				
				

			    $i++;
			}	
		}
		//echo "<pre>"; print_r($row['user_points']); die;
		return $row['user_points']; 
	}

	public function addPoints($data)
	{
		$this->db->insert('insta_points_rule', $data);
		$pointId = $this->db->insert_id();
		if($this->db->insert_id())
		{
			return $pointId;
		}
		else
		{
			return false;
		}
	}

	public function update_Point_Rule($data,$pointId)
	{
		$this->db->where('insta_points_rule_id', $pointId);
	    $this->db->update('insta_points_rule', $data);
	    return true;
	} 

	public function  deletePoints($pointId)
	{
		$this->db->where('insta_points_rule_id =', $pointId);
		$this->db->delete('insta_points_rule');
	}

	public function  deleteUserTransactions($userId)
	{
		$this->db->where('insta_points_user_id =', $userId);
		$this->db->delete('insta_points_transaction');
	}

	public function  get_users_current_points($userId)
	{
		$this->db->select("insta_points_transaction_current_points"); 
		$this->db->from('insta_points_transaction');
		$this->db->where('insta_points_user_id', $userId);
		$this->db->order_by("insta_points_transaction_id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$points = $query->result();
		if(count($points) > 0)
		{
			return $points[0]->insta_points_transaction_current_points;
		}else{
			return 0;
		}
		
		
	}

	public function points_transaction($point_rule_name , $userId)
	{
		$this->db->select("*"); 
		$this->db->from('insta_points_rule');
		$this->db->where('insta_points_rule_name', $point_rule_name);
  		$this->db->where('insta_points_rule_status', 1);
  		$this->db->order_by("insta_points_rule_id", "DESC");
		$this->db->limit(1);  
  		$query = $this->db->get();
		$points_rule = $query->result();
		if(count($points_rule) > 0)
		{
			$this->load->model('AdminModel');
			$rule = $points_rule[0];
			
			if($rule->insta_points_rule_type == "Debit")
			{
				$msg = "deducted";	
			}else if($rule->insta_points_rule_type == "Credit"){
				$msg = "added";	
			}
			$this->db->select("insta_points_transaction_current_points"); 
			$this->db->from('insta_points_transaction');
			$this->db->where('insta_points_user_id', $userId);
			$this->db->order_by("insta_points_transaction_id", "DESC");
			$this->db->limit(1);
			$query = $this->db->get();
			$points_transaction = $query->result();


			if(count($points_transaction) > 0)
			{
				$transaction = $points_transaction[0];
					$rule_point = intval(preg_replace( '/\s+/', '', $rule->insta_points_rule_amount ));
					$user_total_points = $transaction->insta_points_transaction_current_points;

					if($point_rule_name == 'Apply Job' || $point_rule_name == 'Refer User')
					{
						$debit_point = intval(preg_replace('/[^0-9]+/', '', $rule->insta_points_rule_amount), 10);
						if($user_total_points < $debit_point)
						{
							return 0; exit;	
						}else{
							
							$current_point =  $rule_point + $user_total_points; 
							$data = array('insta_points_rule_id' => $rule->insta_points_rule_id,'insta_points_user_id' => $userId,'insta_points_transaction_amount' => $rule->insta_points_rule_amount,'insta_points_transaction_current_points' => $current_point);
						}
					}
					else{
						$current_point =  $rule_point + $user_total_points; 
						$data = array('insta_points_rule_id' => $rule->insta_points_rule_id,'insta_points_user_id' => $userId,'insta_points_transaction_amount' => $rule->insta_points_rule_amount,'insta_points_transaction_current_points' => $current_point);
					}

				
			}else{
				if($point_rule_name == 'Apply Job' || $point_rule_name == 'Refer User')
				{
					return 0; exit;
				}else{
					
					$current_point = intval(preg_replace('/[^0-9]+/', '', $rule->insta_points_rule_amount), 10);
					$data = array('insta_points_rule_id' => $rule->insta_points_rule_id,'insta_points_user_id' => $userId,'insta_points_transaction_amount' => $rule->insta_points_rule_amount,'insta_points_transaction_current_points' => $current_point);
				}
			}

			if(!empty($data))
			{
				//print_r($data);
				$this->db->insert('insta_points_transaction', $data);
				$pointId = $this->db->insert_id();
				if($this->db->insert_id())
				{
					if($point_rule_name != 'Invite Friend')
					{
						$this->session->set_flashdata('success', intval(preg_replace('/[^0-9]+/', '', $data['insta_points_transaction_amount']), 10)." points has been ".$msg.". Your current balance is ".$data['insta_points_transaction_current_points']);
					}

					$user_email = $this->AdminModel->get_usermeta_byKeyId($userId,'email'); 
					// if($user_email)
					// {
					// 	$to = $user_email;
					// 	$sub = "Instarefr Points Transaction";
					// 	$msg = "Hello ".$this->session->user_session['first_name']." ".$this->session->user_session['last_name']." , <br>The points has been ".$msg." according rule `$point_rule_name`. Your current balance is ".$data['insta_points_transaction_current_points'];
					// 	$this->load->model('HomeModel');	
					// 	$this->HomeModel->sendMail($sub, $msg, $to, '');
					// }
					
					return $pointId;
				}
				else
				{
					return 0;
				}
			}
		}
		
	}

	public function get_payment_transaction_list()
	{
		$this->db->select('*');
		$this->db->from('insta_payment');
		$this->db->order_by("insta_payment_id", "DESC");
		$query = $this->db->get();
		$row['payment_list'] = $query->result();
		if(count($row['payment_list']) > 0)
		{
			$i = 0;
			foreach($row['payment_list'] as $payment)
			{
				$first_name = $this->AdminModel->get_usermeta_byKeyId($payment->insta_user_id,'first_name'); 
				$last_name = $this->AdminModel->get_usermeta_byKeyId($payment->insta_user_id,'last_name'); 
				$row['payment_list'][$i]->insta_user_name = $first_name.' '.$last_name; 
				$currrent_points =  intval($this->PointsModel->get_users_current_points($payment->insta_user_id));
				$row['payment_list'][$i]->insta_user_current_points = $currrent_points; 
				$i++;
			}
			return $row['payment_list'];
			
		}
		
	}
}
?>