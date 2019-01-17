<?php if($this->session->flashdata('flsh_msg') == 'Login Request')
{
//echo $this->session->flashdata('next_redirect'); die;
if($this->session->flashdata('next_redirect') != null)
{
$this->session->set_userdata('current_url', $this->session->flashdata('next_redirect'));
//die;
}
?>
<script>/*<![CDATA[*/$("#login_msg").html("<span>Please Login first</span>");document.getElementById("id01").style.display="block";/*]]>*/</script>
<?php } ?>
<?php $this->load->view('home/home-spotlight'); ?>
<?php $this->load->view('home/home-how-works'); ?>
<?php $this->load->view('home/home-category'); ?>
<?php //$this->load->view('home/home-experts'); ?>
<?php $this->load->view('home/home-job-signup'); ?>
<?php //$this->load->view('home/home-recent-article'); ?>
<?php $this->load->view('home/home-faq'); ?>