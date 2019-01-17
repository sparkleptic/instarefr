<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	function __Construct(){
	   parent::__Construct ();
	   $this->load->model('CompanyModel'); // load model 
	   $this->load->model('JobModel');
	   $location = "";
	   if(!empty($this->session->my_current_location))
	   {
	   	 $location = $this->session->my_current_location;
	   }
	   $this->data['meta_details'] = array("title"=>"Companies","keyword"=>"Job, job search, referral, instarefer, job referral, jobs, openings, current openings, referme, referhire, roundone, hire, bonus, referral bonus, Employee, Employee bonus, Earn, Earn bonus, Social hiring, social network hiring, Post Job, Analyst Job, Finance Job, IT Job, Developer Jobs,  get referred, $location","description"=>"See all the companies where you can get referred even if you don’t know anyone there.");
	}

	
	public function index()
	{
		$data['meta'] = $this->data["meta_details"];
		$data['company_list'] = $this->CompanyModel->get_company_list();
   		$data['main_content'] = "company/company-list";
		$this->load->view('template',$data);
	}

	public function jobs($companyId,$companyName) 
	{		
		$data['meta'] = $this->data["meta_details"];
		$data['company_detail'] = $this->CompanyModel->get_company_list($companyId);
		$data['job_detail'] = $this->JobModel->get_post_job_list($companyId,'insta_company_id');
		$data['main_content'] = "company/company-jobs";
		$this->load->view('template',$data);
	}

	public function company($companyId) 
	{
		$data['meta'] = $this->data["meta_details"];		
		$data['company_detail'] = $this->CompanyModel->get_company_list($companyId);
		$data['job_detail'] = $this->JobModel->get_post_job_list($companyId,'insta_company_id');
		$data['main_content'] = "company/company-jobs";
		$this->load->view('template',$data);
	}
	
}
