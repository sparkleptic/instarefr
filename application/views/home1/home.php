<?php 
if($this->session->flashdata('flsh_msg') == 'Login Request') 
{
	//echo $this->session->flashdata('next_redirect'); die;
	if($this->session->flashdata('next_redirect') != null)
	{
		$this->session->set_userdata('current_url', $this->session->flashdata('next_redirect'));
		//die;
	}
?>
<script>
	$('#login_msg').html('<span>Please Login first</span>');
	document.getElementById('id01').style.display='block';
</script>
<?php } ?>
<!-- spotlight section begins -->
<?php $this->load->view('home/home-spotlight'); ?>
<!--spotlight section ends-->
<!-- how-it-works section begins -->
<?php $this->load->view('home/home-how-works'); ?>
<!-- how-it-works section ends -->
<!-- Category section begins -->
<?php $this->load->view('home/home-category'); ?>
<!-- Category section ends -->
<!-- Expert section begins -->
<?php $this->load->view('home/home-experts'); ?>
<!-- Expert section ends -->
<!-- Expert section begins -->
<?php $this->load->view('home/home-job-signup'); ?>
<!-- Expert section ends -->
<!-- Rceent Article begins -->
<?php //$this->load->view('home/home-recent-article'); ?>
<!-- Recent Article ends -->
<!-- FAQ begins -->
<?php $this->load->view('home/home-faq'); ?>
<!-- FAQ ends -->
