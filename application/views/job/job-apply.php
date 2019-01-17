<div id="primary" class="content-area container" role="main">
<div id="main" class="site-main">
<form class="job-manager-application-form job-manager-form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/job/add_apply_job/"><br>
<?php $job_detail = $job_detail[0]; ?>
<?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
	<h2 class="modal-title">Apply</h2>
	<input type="hidden" value="<?php echo $this->session->user_session['user_id']; ?>" name="insta_user_id">
	<input type="hidden" value="<?php echo $job_detail->insta_job_id; ?>" name="insta_job_id">
	<input type="hidden" value="0" name="insta_job_apply_status">
			<br>
		<fieldset class="fieldset-application_message">
			<label for="application_message">Message</label>
			<div class="field required-field">
				<textarea cols="150" rows="3" class="input-text" name="insta_job_apply_message" id="insta_job_apply_message" placeholder="Your cover letter/message sent to the employer" maxlength="" required=""></textarea>
			</div>
		</fieldset>
		<br>
		<fieldset class="fieldset-application_message">
			<label for="application_message">Why should you get referred</label>
			<div class="field required-field">
				<textarea cols="150" rows="3" class="input-text" name="insta_job_apply_why_get_refer" id="insta_job_apply_why_get_refer" placeholder="Please talk about your relevant experience and skill as per job description" maxlength="" required=""></textarea>
			</div>
		</fieldset>
	
	<br>
	<p>
		<input type="submit" name="wp_job_manager_send_application" value="Send application">
		
	</p>
	<br>
</form>
</div>
</div>