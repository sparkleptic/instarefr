<?php
class HomeModel extends CI_Model {
 
		function getUser()
		{
		  $this->db->select("insta_user_id,Insta_user_registered_date"); 
		  $this->db->from('insta_user');
		  $query = $this->db->get();
		  return $query->result();
		}


		public function add_contact_us($data)
		{
			$this->db->insert('insta_contact_us', $data);
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

		public function get_contact_us()
		{
			$this->db->select('*'); 
			$this->db->from('insta_contact_us');
			$query = $this->db->get();
			return $query->result();
		}

		public function count_rows($table,$where_field="",$where_value="")
		{
			$this->db->select('*');
			$this->db->from($table);
			if($where_field!="" && $where_value!="")
			{
				$this->db->where($where_field,$where_value);
			}			
			$query = $this->db->get();
			return $query->num_rows();   
		}

		public function add_article($data)
		{
			$this->db->insert('insta_article', $data);
			$articleId = $this->db->insert_id();
			if($this->db->insert_id())
			{
				return $articleId;
			}
			else
			{
				return false;
			}
		}

		public function get_article_list($articleId="",$status="")
		{
			$this->db->select('*'); 
			$this->db->from('insta_article');
			if($articleId != "")
			{
				$this->db->where('insta_article_id',$articleId);
			}
			if($status != "")
			{
				$this->db->where('insta_article_status',$status);
			}
			$query = $this->db->get();
			return $query->result();
		}

		

		public function get_ads_detail($adsId="")
		{
			$this->db->select('*'); 
			$this->db->from('insta_google_ads');
			if($adsId != "")
			{
				$this->db->where('insta_google_ads_id',$adsId);
			}
			$query = $this->db->get();
			return $query->result();
		}

		public function update_article($data , $articleId)
		{
			$this->db->where('insta_article_id', $articleId);
		    $this->db->update('insta_article', $data);
		    return true;
		} 

		public function deleteContactUs($contactId)
		{
			$this->db->where('insta_contact_us_id =', $contactId);
			$this->db->delete('insta_contact_us');
		} 

		public function deleteGoogleAds($adsId)
		{
			$this->db->where('insta_google_ads_id =', $adsId);
			$this->db->delete('insta_google_ads');
		} 

		

		public function sendMail($sub="", $msg="", $to="", $from="invites@instarefr.com")
		{  //echo $to; die;
			if(empty($to) && empty($from) && empty($msg) && empty($sub)) 
			{
				$this->session->set_flashdata('warning', 'Sorry! mail process not working now.');
			}else{
				$config = array(
				    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
				    'smtp_host' => 'smtp.sendgrid.net',
				    'smtp_port' => 25,
				    'smtp_user' => 'himanshuintranet',
				    'smtp_pass' => 'TechAdmin@811',
				    'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example
				    'mailtype' => 'html', //plaintext 'text' mails or 'html'
				    'smtp_timeout' => '4', //in seconds
				    'charset' => 'iso-8859-1',
				    'wordwrap' => TRUE
				);	

				// $SmtpServer="smtp.sendgrid.net";
				// $SmtpPort="25"; //default
				// $SmtpUser="himanshuintranet";
				// $SmtpPass="TechAdmin@811";

				  /*$this->load->library('email', $config);
			
			      $this->email->set_newline("\r\n");
			      $this->email->from($from); // change it to yours
			      $this->email->to($to);// change it to yours
			      $this->email->subject($sub);
			      $this->email->message($msg);
			      if($this->email->send())
				  {
					//echo 'Email sent.';
				  }
				  else
				  {
					show_error($this->email->print_debugger());
				  }*/

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <invites@instarefr.com>' . "\r\n";
				//$headers .= 'Cc: myboss@example.com' . "\r\n";

				mail($to,$sub,$msg,$headers);
			}
		}
	
 
}
?>
