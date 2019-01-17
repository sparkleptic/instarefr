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
    $location = "";
    if(!empty($this->session->my_current_location))
    {
     $location = $this->session->my_current_location;
    }
    $this->data['meta_details'] = array("title"=>"Points","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"Invite your friend and earn more points. More points you can get more opportunity you can apply for.");	
	}

	public function index()
	{
    $data['meta'] = $this->data["meta_details"];
    $this->db->select('insta_user_meta_value'); 
      $this->db->from('insta_user_meta');
      $this->db->where('insta_user_meta_key','email');
      $invited_emails = array();
      $query = $this->db->get();
      $emails = $query->result();
      foreach($emails as $exist_email)
      {
        array_push($invited_emails, $exist_email->insta_user_meta_value);
      } 
      $data['invited_emails'] = $invited_emails;
		$data['main_content'] = 'points/points-rule';
		$this->load->view('template',$data);
	}

	public function invite_google_contact()
	{
		$data['meta'] = $this->data["meta_details"];
		if(!empty($this->input->post('google_friend')))
		{
			$contact_emails = $this->input->post('google_friend');
			$email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');

			$msg_url = base_url()."instarefr_invitation/".$email_encoded;


			$subject = 'You have been invited to InstaRefr';
				
			foreach ($contact_emails as $val) 
			{
				if (strpos($val, '=') !== false) {
				    $arr = explode('=', $val);
				    $name = $arr[0];		
				    $to = $arr[1];		
				}else{
					$to = $val;
					$name = "";
				}
			//$message = $msg_url;
			$message = '<!DOCTYPE html>
<html>
<head>
  <title>You have been invited to InstaRefr</title>
</head>
<body>
<div bgcolor="#FAFAFA" lang="EN-IN" link="blue" vlink="purple">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;background:#fafafa;border-collapse:collapse">
  <tbody>
    <tr>
      <td width="100%" valign="top" style="width:100.0%;padding:7.5pt 7.5pt 7.5pt 7.5pt">
        <div align="center">
          <table border="0" cellspacing="0" cellpadding="0" width="600" style="width:450.0pt;border-collapse:collapse"><tbody>
            
            <tr>
              <td width="600" valign="top" style="width:450.0pt;padding:0cm 0cm 0cm 0cm"><div align="center">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                  <tr>
                    <td valign="top" style="background:#fafafa;padding:6.75pt 0cm 6.75pt 0cm"></td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="background:white;padding:6.75pt 0cm 0cm 0cm;background:cover;background-size:cover">
                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:6.75pt 6.75pt 6.75pt 6.75pt;min-width:100%">
                            <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse">
                              <tbody>
                                <tr>
                                  <td valign="top" style="padding:0cm 6.75pt 0cm 6.75pt;min-width:100%">
                                    <p align="center" style="text-align:center"><a href="http://www.instarefr.com/" title="" target="_blank"><span style="text-decoration:none"><img border="0" width="280" src="'.IMAGE_PATH.'insta-1.png" alt="InstaRefr"></span></a></p>
                                  </td>
                                </tr>
                              </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>

                  <tr>
                    <td valign="top" style="border:none;border-bottom:solid #eaeaea 1.5pt;background:white;padding:0cm 0cm 6.75pt 0cm;background:cover;background-size:cover">
                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:6.75pt 0cm 0cm 0cm;min-width:100%">
                            <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                              <tr>
                                <td width="600" valign="top" style="width:450.0pt;padding:0cm 0cm 0cm 0cm;max-width:100%;min-width:100%">
                                  <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse;word-break:break-word"><tbody>
                                    <tr>
                                      <td valign="top" style="padding:0cm 13.5pt 6.75pt 13.5pt">
                                        <h1>Hi '.$name.',</h1>
                                        <p style="margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:150%"><span style="font-family:&quot;Helvetica&quot;,&quot;sans-serif&quot;;color:#202020">'.$this->session->user_session['first_name'].' '.$this->session->user_session['last_name'].' has invited you to become a part of this wonderful community.<br>Employees from top companies are waiting for you.Join us today!</span></p>
                                      </td>
                                    </tr>
                                  </tbody></table>
                                </td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>
                      
                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:6.75pt 6.75pt 6.75pt 6.75pt">
                            <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                              <tr>
                                <td valign="top" style="padding:0cm 6.75pt 0cm 6.75pt;min-width:100%">
                                  <p align="center" style="text-align:center"><a href="http://www.instarefr.com/" title="" target="_blank"><span style="text-decoration:none"><img border="0" width="564" src="'.IMAGE_PATH.'insta-more-than-50.png"></span></a></p>
                                </td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>

                  <tr>
                    <td valign="top" style="background:#fafafa;padding:6.75pt 0cm 6.75pt 0cm;background:cover;background-size:cover">
                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:0cm 13.5pt 13.5pt 13.5pt;min-width:100%">
                            <div align="center">
                            <table border="0" cellspacing="0" cellpadding="0" style="background:#2baadf;border-collapse:collapse"><tbody>
                              <tr>
                                <td style="padding:11.25pt 11.25pt 11.25pt 11.25pt;border-radius:3px">
                                  <p align="center" style="text-align:center;margin:0;"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><a href="'.$msg_url.'" title="Join" target="_blank"><b><span style="color:white;text-decoration:none">Join</span></b></a></span></p>
                                </td>
                              </tr>
                            </tbody></table>
                            </div>
                          </td>
                        </tr>
                      </tbody></table>

                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:6.75pt 6.75pt 6.75pt 6.75pt">
                            <div align="center">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                              <tr>
                                <td style="padding:0cm 6.75pt 0cm 6.75pt;min-width:100%">
                                  <div align="center">
                                  <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                                    <tr>
                                      <td valign="top" style="padding:6.75pt 6.75pt 0cm 6.75pt;min-width:100%">
                                        <div align="center">
                                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody>
                                          <tr>
                                            <td valign="top" style="padding:0cm 0cm 0cm 0cm">
                                              <div align="center">
                                              <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody>
                                                <tr>
                                                  <td valign="top" style="padding:0cm 0cm 0cm 0cm">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse"><tbody>
                                                      <tr>
                                                        <td valign="top" style="padding:0cm 7.5pt 6.75pt 0cm">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                                                            <tr>
                                                              <td style="padding:3.75pt 7.5pt 3.75pt 6.75pt">
                                                                <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width:0cm;border-collapse:collapse"><tbody>
                                                                  <tr>
                                                                    <td width="24" style="width:18.0pt;padding:0cm 0cm 0cm 0cm">
                                                                      <p align="center" style="text-align:center"><a href="http://www.instarefr.com/" target="_blank"><span style="text-decoration:none"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-link.png"></span></a></p>
                                                                    </td>
                                                                  </tr>
                                                                </tbody></table>
                                                              </td>
                                                            </tr>
                                                          </tbody></table>
                                                        </td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>

                                                  <td valign="top" style="padding:0cm 0cm 0cm 0cm">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse"><tbody>
                                                      <tr>
                                                        <td valign="top" style="padding:0cm 7.5pt 6.75pt 0cm">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                                                            <tr>
                                                              <td style="padding:3.75pt 7.5pt 3.75pt 6.75pt">
                                                                <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width:0cm;border-collapse:collapse"><tbody>
                                                                  <tr>
                                                                    <td width="24" style="width:18.0pt;padding:0cm 0cm 0cm 0cm">
                                                                      <p align="center" style="text-align:center"><a href="https://twitter.com/instarefr" target="_blank"><span style="text-decoration:none"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-tw.png"></span></a></p>
                                                                    </td>
                                                                  </tr>
                                                                </tbody></table>
                                                              </td>
                                                            </tr>
                                                          </tbody></table>
                                                        </td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>

                                                  <td valign="top" style="padding:0cm 0cm 0cm 0cm">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse"><tbody>
                                                      <tr>
                                                        <td valign="top" style="padding:0cm 7.5pt 6.75pt 0cm">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                                                            <tr>
                                                              <td style="padding:3.75pt 7.5pt 3.75pt 6.75pt">
                                                                <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width:0cm;border-collapse:collapse"><tbody>
                                                                  <tr>
                                                                    <td width="24" style="width:18.0pt;padding:0cm 0cm 0cm 0cm">
                                                                      <p align="center" style="text-align:center"><a href="https://www.facebook.com/instarefr/" target="_blank"><span style="text-decoration:none"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-fb.png"></span></a></p>
                                                                    </td>
                                                                  </tr>
                                                                </tbody></table>
                                                              </td>
                                                            </tr>
                                                          </tbody></table>
                                                        </td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>

                                                  <td valign="top" style="padding:0cm 0cm 0cm 0cm">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse"><tbody>
                                                      <tr>
                                                        <td valign="top" style="padding:0cm 0cm 6.75pt 0cm">
                                                          <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                                                            <tr>
                                                              <td style="padding:3.75pt 7.5pt 3.75pt 6.75pt">
                                                                <table border="0" cellspacing="0" cellpadding="0" align="left" width="0" style="width:0cm;border-collapse:collapse"><tbody>
                                                                  <tr>
                                                                    <td width="24" style="width:18.0pt;padding:0cm 0cm 0cm 0cm">
                                                                      <p align="center" style="text-align:center"><a href="https://www.linkedin.com/company/instarefr.com" target="_blank"><span style="text-decoration:none"><img border="0" width="24" height="24" src="'.IMAGE_PATH.'insta-li.png"></span></a></p>
                                                                    </td>
                                                                  </tr>
                                                                </tbody></table>
                                                              </td>
                                                            </tr>
                                                          </tbody></table>
                                                        </td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>
                                                </tr>
                                              </tbody></table>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody></table>
                                      </div>
                                      </td>
                                    </tr>
                                  </tbody></table>
                                  </div>
                                </td>
                              </tr>
                            </tbody></table>
                            </div>
                          </td>
                        </tr>
                      </tbody></table>

                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td style="padding:7.5pt 13.5pt 18.75pt 13.5pt;min-width:100%">
                            <table border="1" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;border:none;min-width:100%"><tbody>
                              <tr>
                                <td style="border:none;border-top:solid #eeeeee 1.5pt;padding:0cm 0cm 0cm 0cm;min-width:100%"></td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>

                      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;min-width:100%"><tbody>
                        <tr>
                          <td valign="top" style="padding:6.75pt 0cm 0cm 0cm">
                            <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse"><tbody>
                              <tr>
                                <td width="600" valign="top" style="width:450.0pt;padding:0cm 0cm 0cm 0cm;max-width:100%;min-width:100%">
                                  <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="width:100.0%;border-collapse:collapse;word-break:break-word"><tbody>
                                    <tr>
                                      <td valign="top" style="padding:0cm 13.5pt 6.75pt 13.5pt">
                                        <p align="center" style="text-align:center;line-height:150%"><em><span style="font-size:9.0pt;line-height:150%;font-family:&quot;Helvetica&quot;,&quot;sans-serif&quot;;color:#656565">This email was sent to you by your friend. If you do not want to receive future communications from us, please unsubscribe yourself here.</span></em></p>
                                      </td>
                                    </tr>
                                  </tbody></table>
                                </td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>
                </tbody></table>
                </div>
              </td>
            </tr>
          </tbody></table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</body>
</html>';

								
				$this->HomeModel->sendMail($subject, $message, $to, '');
			}
			$this->session->set_flashdata('success', 'Invitation sent successfully.');
			redirect(base_url().'points/');    
		}else{
			redirect(base_url().'points/');   
		}
		// $email = $this->input->post('email');
		// $name = $this->input->post('name');
		// $email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');
		// $msg_url = base_url()."/instarefr_invitation/".$email_encoded;
		
		
		// $to = $email;
		// $subject = 'Invite From Your Friend'.$this->session->user_session['first_name'].' '.$this->session->user_session['last_name'];
		
		// $message = $msg_url;
		
		
		// $this->HomeModel->sendMail($subject, $message, $to, '');
		
		// echo 'invited';
	}

	public function points_transaction()
	{
    $data['meta'] = $this->data["meta_details"];
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
    $data['meta'] = $this->data["meta_details"];
		if(isset($_GET["code"]) && !empty($_GET["code"]))
		{
			$data['code'] = $_GET["code"];
			$this->db->select('insta_user_meta_value'); 
			$this->db->from('insta_user_meta');
			$this->db->where('insta_user_meta_key','email');
			$invited_emails = array();
			$query = $this->db->get();
			$emails = $query->result();
			foreach($emails as $exist_email)
			{
				array_push($invited_emails, $exist_email->insta_user_meta_value);
			}	
			$data['invited_emails'] = $invited_emails;		
		}
		$data['main_content'] = 'points/points-rule';
		$this->load->view('template',$data);		
	}

	public function instarefr_invitation($email)
	{
		$data['meta'] = $this->data["meta_details"];
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
		$data['meta'] = $this->data["meta_details"];
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
			$phone = ""; $name = "";
			if(!empty($this->session->user_session['phone']))
			{
				$phone = $this->session->user_session['phone'];
			}
			if(!empty($this->session->user_session['first_name']))
			{
				$name = $this->session->user_session['first_name'];
				if(!empty($this->session->user_session['last_name']))
				{
					$name .= ' '.$this->session->user_session['last_name'];
				}
			}
			$response = $this->InstamojoModel->paymentRequestCreate(array(
	        "purpose" => "Instarefr Points ".$arr[0],
	        "amount" => $arr[1],
	        "send_email" => false,
	        "email" => $this->session->user_session['email'],
	        "buyer_name" => $name,
	        "phone" => $phone,
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
			 //echo "<pre>";
			 //print_r($response); die;
			 if($response['status'] == 'Credit' || $response['status'] == 'Completed')
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
              $currrent_points =  intval($this->PointsModel->get_users_current_points($val->insta_user_id));
              if(empty($currrent_points))
              {
                $currrent_points = 0;
              }
              $transaction_arr['insta_current_points'] = $currrent_points + $transaction_arr['insta_payment_points'];
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
							$candidate_transaction['insta_points_transaction_amount'] = '+'. $transaction_arr['insta_payment_points'];
							$this->db->insert('insta_points_transaction', $candidate_transaction);
							$pointId = $this->db->insert_id();
							if(!empty($pointId))
							{
								$custom_description = array();
								$custom_description['insta_custom_transaction_details'] = 'Purchased';
								$custom_description['insta_points_transaction_id'] = $pointId;

								$this->db->insert('insta_custom_points_description', $custom_description);

                if(!empty($this->session->user_session['email']))
                {
                 $to = $this->session->user_session['email'];
                 $sub = "Instarefr Points";
                 $msg = "Hello ".$this->session->user_session['first_name']." ".$this->session->user_session['last_name']." , <br>The points has been credited in your account.Now your current balance is ".$transaction_arr['insta_current_points'].".";
                 $this->load->model('HomeModel');  
                 $this->HomeModel->sendMail($sub, $msg, $to, '');
                }
								
								$this->session->set_flashdata('success', $transaction_arr['insta_payment_points']." points has been credited successfully. Now your current balance is ".$transaction_arr['insta_current_points']);

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