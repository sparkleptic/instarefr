<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Points extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		// Load Model
		$this->load->model('PointsModel'); 
		$this->load->model('InstamojoModel'); 
		$this->load->model('HomeModel'); 		
	}

	public function index()
	{
		$data['main_content'] = 'points/points-rule';
		$this->load->view('template',$data);
	}

	public function invite_google_contact()
	{
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');
		$msg_url = base_url()."/instarefr_invitation/".$email_encoded;
		
		
		$to = $email;
		$subject = 'Invite From Your Friend'.$this->session->user_session['first_name'].' '.$this->session->user_session['last_name'];
		
		$message = $msg_url;
		
		
		$this->HomeModel->sendMail($subject, $message, $to, '');
		
		echo 'invited';
	}

	public function points_transaction()
	{
		if(isset($this->session->user_session))
		{
			$user_id = $this->session->user_session['user_id'];
			$data['points_list'] = $this->PointsModel->get_points_transaction($user_id);
			$data['main_content'] = 'points/points-list';
			$this->load->view('template',$data);
		}else{
			$data['main_content'] = 'points/points-rule';
			$this->load->view('template',$data);
		}
	}

	public function invite_friends()
	{
		if(isset($_GET["code"]) && !empty($_GET["code"]))
		{
			$data['code'] = $_GET["code"];			
		}
		$data['main_content'] = 'points/points-rule';
		$this->load->view('template',$data);		
	}

	public function instarefr_invitation($email)
	{
		// echo "gjkjfskjdfkjsdfkj";
		if($email != "")
		{
			$email_decoded = base64_decode(strtr($email, '-_', '+/'));
			if(filter_var($email_decoded, FILTER_VALIDATE_EMAIL)){
				$cookie_name = "instarefr_invited_email";
				$cookie_value = $email_decoded;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			}
		}
		if(empty($this->session->user_session['user_id']))
		{
			$this->session->set_flashdata('login_msg', 'Login Request');
		}
		
		redirect(base_url().'home/');     
	}

	public function send_invite_mail()
	{
		//print_r($this->input->post('emails'));
		if(!empty($this->input->post('emails')))
		{
			$emails = $this->input->post('emails');
			$send_invitation_emails = array();
			foreach($emails as $email) 
			{ 
				$email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');
				$this->load->model('HomeModel');	
				$to = $email; 
				$to = 'jaiswal.damini.11@gmail.com';
				$sub = 'Instarefr Invitation';
				$msg = base_url()."points/instarefr_invitation?email=".$email_encoded;
				$this->HomeModel->sendMail($sub, $msg, $to, '');
				$send_invitation_emails['insta_invitation_emails'] = $email;
				$send_invitation_emails['insta_invitation_status'] = 1;
				$this->db->insert('insta_invitations', $send_invitation_emails);
				$insertId = $this->db->insert_id();
				
			}
			$this->session->set_flashdata('success', 'Invitation sent successfully.');
			$data['main_content'] = 'points/points-rule';
			$this->load->view('template',$data);
		}
		
	}

	public function buy_now()
	{
		if(empty($this->session->user_session))
		{
			$this->session->set_flashdata('login_msg', 'Login Request');
			redirect($this->session->current_url);
		}else{
			$arr = explode('-', $this->input->post('buy_points'));
			$response = $this->InstamojoModel->paymentRequestCreate(array(
	        "purpose" => "Instarefr Points ".$arr[0],
	        "amount" => $arr[1],
	        "send_email" => false,
	        "email" => "damini.jaiswal@techinfini.com",
	        "redirect_url" => base_url()."points/instamojo_transaction_status"
	        ));
	       // echo "<pre>"; print_r($response); die;
	        if(!empty($response['longurl']))
	        {
	        	$process_arr = array(); 
	        	$process_arr['insta_payment_transaction_id'] = $response['id'];
	        	$process_arr['insta_user_id'] = $this->session->user_session['user_id'];
	        	$process_arr['insta_payment_process_status'] = 0;
	        	$this->db->insert('insta_payment_process', $process_arr);
				$process_id = $this->db->insert_id();
	        	redirect($response['longurl']);
	        }

	  		
		}
	}

	public function instamojo_transaction_status()
	{
		if(isset($_GET['payment_id']) && isset($_GET['payment_request_id']))
		{
			$response = $this->InstamojoModel->paymentRequestPaymentStatus($_GET['payment_request_id'], $_GET['payment_id']);
			// echo "<pre>";
			// print_r($response);
			if($response['status'] == 'Credit')
			{
				$this->db->select("*"); 
				$this->db->from('insta_payment_process');
				$this->db->where("insta_payment_transaction_id =", $response['id']);
				$query = $this->db->get(); 
				$row['payment_process'] = $query->result();
				$ip = $this->input->ip_address();
				if(count($row['payment_process']) > 0)
				{
					//echo "<pre>"; print_r($row['payment_process']);
					foreach($row['payment_process'] as $val)
					{
						
						if(!empty($response['amount']))
						{
							$transaction_arr = array(); 
							$transaction_arr['insta_user_id'] = $val->insta_user_id;
							$transaction_arr['insta_payment_transaction_id'] = $val->insta_payment_transaction_id;
							$transaction_arr['insta_payment_amount'] = $response['amount'];
							if($response['amount'] == 29.00)
							{
								$transaction_arr['insta_payment_points'] = 50;
							}else if($response['amount'] == 149.00)
							{
								$transaction_arr['insta_payment_points'] = 300;
							}else if($response['amount'] == 199.00)
							{
								$transaction_arr['insta_payment_points'] = 500;
							}
							$transaction_arr['insta_payment_type'] = '';	
							$transaction_arr['insta_payment_user_ip'] = $ip;
						}
						
						$this->db->insert('insta_payment', $transaction_arr);
						$transaction_id = $this->db->insert_id();

						if(!empty($transaction_id))
						{
							$this->db->where('insta_payment_transaction_id =', $val->insta_payment_transaction_id);
							$this->db->delete('insta_payment_process');

							$candidate_transaction = array();
							$candidate_transaction['insta_points_rule_id'] = 8;
							$candidate_transaction['insta_points_user_id'] = $val->insta_user_id;
							$currrent_points =  intval($this->PointsModel->get_users_current_points($val->insta_user_id));
							if(empty($currrent_points))
							{
								$currrent_points = 0;
							}
							$candidate_transaction['insta_points_transaction_current_points'] = $currrent_points + $transaction_arr['insta_payment_points'];
							$candidate_transaction['insta_points_transaction_amount'] = + $transaction_arr['insta_payment_points'];
							$this->db->insert('insta_points_transaction', $candidate_transaction);
							$pointId = $this->db->insert_id();
							if(!empty($pointId))
							{
								$custom_description = array();
								$custom_description['insta_custom_transaction_details'] = 'Purchased';
								$custom_description['insta_points_transaction_id'] = $pointId;

								$this->db->insert('insta_custom_points_description', $custom_description);
								
								$this->session->set_flashdata('success', $transaction_arr['insta_payment_points']." points has been credited successfully. Now your current balance is ".$currrent_points);

									redirect(base_url().'points/');  
							}
						}
					}
					
				}

				$this->session->set_flashdata('warning', 'Your payment status is pending now');

					redirect(base_url().'points/');  
				
			}	

			$this->session->set_flashdata('warning', 'Your payment status is pending now');
				redirect(base_url().'points/');  
			
		}else{

			$this->session->set_flashdata('warning', 'Sorry! some error occurred');
			redirect(base_url().'points/');  
		}


		
	}
}