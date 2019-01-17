<div class="refer-table-container">
	<div class="container">
	<?php $this->load->view('common/common-msg'); ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<!-- <h3 class="section-title page-heading">REFER AND EARN</h3> -->
				<!-- <span class="green-border"></span> -->

				<div id="content-top-wrap">
        <!-- Find Job Form -->
        <div class="find-job-section">
            <div class="">
            	<form class="find-job-form" action="<?php echo base_url(); ?>job/refer_and_earn/" method="post">
                    <div class="row">
                        <ul class="col-md-12 col-sm-12 col-xs-12 no-list-style find-job-form-ul">
                            <li class="no-padding form-group has-feedback col-md-5 col-sm-5 col-xs-12">
                                 <img src="<?php echo IMAGE_PATH; ?>job-title-icon.png" alt="job-title" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                                <input list="title_company_skills" type="text" class="form-control find-job-input find-job-input-text input-left-radius" id="jobKeyword" onkeyup="doSearch('title_company_skills','refer_earn');" name="title_company_skills" placeholder="Job Title, Tags" autocomplete="off">
                                <div id="test"></div>
                                <datalist id="title_company_skills">
                                                                    </datalist>
                            </li>

                            <li class="no-padding form-group has-feedback col-md-5 col-sm-5 col-xs-12">
                                <img src="<?php echo IMAGE_PATH; ?>place-icon.png" alt="job-location" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                                <input list="location" type="text" name="location" class="form-control find-job-input find-job-input-text" id="locationKeyword" onkeyup="doSearch('location','refer_earn');" value="<?php if(!empty($location)) { echo $location; } else if(!empty($this->session->my_current_location)) { echo $this->session->my_current_location; }  ?>" placeholder="City, State or Zip" autocomplete="off">
                                <div id="test1"></div>
                                <datalist id="location">
                                                                      </datalist>
                            </li>
                            <li class="no-padding form-group has-feedback col md-2 col-sm-2 col-xs-12">
                                <input type="submit" name="title_company_skills_submit" class="find-job-btn form-control trans find-job-input" value="FIND" onkeyup="doSearch('location');">
                                <i class="header-form-submit-icon get-job-submit-icon glyphicon glyphicon-search form-control-feedback"></i>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
				<?php if( !empty($job_list) ) { ?>
				<div class="table-head-item refer-table-heading clearfix">
					<div class="refer-col-1 fl-left refer-table-head">Title</div>
					<div class="refer-col-2 fl-left refer-table-head text-center">Company</div>
					<div class="refer-col-3 fl-left refer-table-head text-center">Location</div>
					<div class="refer-col-4 fl-left refer-table-head text-center">Date Posted</div>
					<div class="refer-col-5 fl-left refer-table-head text-center">Listing Expires</div>
					<div class="refer-col-6 fl-left refer-table-head text-center">Applications</div>
				</div>

				<div class="refer-table-contents">
				<!-- Refer Tabel Row -->
				<?php
					foreach( $job_list as $val ) { ?>
					<div class="refer-table-row">
						<div class="table-row-item refer-table-row-top refer-table-job clearfix">
							<div class="refer-col-1 col-text fl-left refer-table-cell">
								<div class="visible-xs table-xs-title">Title</div>
								<div class="table-content">
									<a class="insta-link" href="<?php echo base_url().'single-job/'.$val->insta_job_id.'/' ; ?>"><?php echo $val->insta_job_title; ?></a>
								</div>
							</div>
							
							<div class="refer-col-2 col-img fl-left refer-table-cell text-center">
								<div class="visible-xs table-xs-title">Company</div>
								<div class="table-content">
									<a  class="insta-link" href="<?php echo base_url().'company-jobs/'.$val->insta_company_id.'/'.$val->company; ?>">
									<?php if( !empty($val->insta_company_logo) ) {
										echo '<img class="c-logo img-responsive" src="'.COMPANY_LOGO_PATH.''.$val->insta_company_logo.'" alt="Job Logo">';
									} else {
										echo '<div class="company-alt">'.$val->company.'</div>';
									} ?>
									</a>
								</div>
							</div>
							
							<div class="refer-col-3 col-text fl-left refer-table-cell refer-and-date-color">
								<div class="visible-xs table-xs-title">Location</div>
								<div class="table-content">
									<i class="glyphicon glyphicon-map-marker fl-left"></i><div class="job-location-cell"><?php echo $val->insta_job_location; ?></div>
								</div>
							</div>
							
							<div class="refer-col-4 col-text fl-left refer-table-cell refer-and-date-color text-center">
								<div class="visible-xs table-xs-title">Date Posted</div>
								<div class="table-content">
									<?php echo $val->insta_job_created_on; ?>
								</div>
							</div>
							
							<div class="refer-col-5 col-text fl-left refer-table-cell refer-and-date-color text-center">
								<div class="visible-xs table-xs-title">Listing Expires</div>
								<div class="table-content">
									<?php echo $val->insta_job_closing_date; ?>
								</div>
							</div>
							
							<div class="refer-col-6 col-text fl-left refer-table-cell refer-and-date-color text-center">
								<div class="visible-xs table-xs-title">Applications</div>
								<div class="table-content">
									<a href="javascript:void(0);" class="job-item-time-link transition" onclick="show_users_row('<?php echo $val->insta_job_id; ?>')"><?php if(!empty($val->apply_users)) echo count($val->apply_users); else echo 0; ?></a>
								</div>
							</div>
						</div>

						<!-- Candidate Wrap Begin -->
						<div class="refer-table-row-bottom refer-table-candidate" id="<?php echo $val->insta_job_id; ?>">
						<?php if(!empty($val->apply_users))
						{ //echo "<pre>"; print_r($val->apply_users);  ?>
							<div class="candidate-inner-wrap">
								<!--<div class="candidate-top">
								<div class="candidate-filter clearfix">
								<div class="style-select">
								<select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text">
								<option>All Dates</option>
								<option>2 Years</option>
								<option>3 Years</option>
								<option>4 Years</option>
								<option>5 Years</option>
								</select>
								</div>
								<div class="style-select">
								<select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text">
								<option>Job Title</option>
								<option>1 Year</option>
								<option>2 Years</option>
								<option>3 Years</option>
								<option>4 Years</option>
								<option>5 Years</option>
								</select>
								</div>
								</div>      
								</div>-->
								<div class="candidate-bottom">
									<div class="candidate-bottom-inner">
										<div class="candidate-row-heading clearfix">
											<div class="referc-col-1 fl-left refer-table-cell">Candidates</div>
											
											<div class="referc-col-1 fl-left refer-table-cell text-center">Experience</div>
											<div class="referc-col-1 fl-left refer-table-cell text-center">Applied On</div>
											<div class="referc-col-1 fl-left refer-table-cell text-center">Why me</div>
											<div class="referc-col-1 fl-left refer-table-cell text-right">Actions</div>
										</div>
										<?php  foreach($val->apply_users as $users) { 
											if(!empty($users)) {
										//$users = json_encode($users); $users = json_decode($users); ?>
										<div class="candidate-row-desc clearfix">
											<div class="referc-col-1 fl-left refer-table-cell">
												<div class="visible-xs table-xs-title">Candidates</div>
												<div class="table-content">
													<?php if(!empty($users->apply_user_profile_pic)) {
														if(strpos($users->apply_user_profile_pic, "https://") !== false) { ?>
															<img class="alignleft img-responsive avatar-photo" alt="candidate-avatar" height="100" width="100" alt="" src="<?php echo $users->apply_user_profile_pic; ?>">
														<?php } else { ?>
															<img class="alignleft img-responsive avatar-photo" alt="candidate-avatar" height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$users->apply_user_profile_pic; ?>">
														<?php }
													} else { ?>
														<img class="alignleft img-responsive avatar-photo" height="100" width="100" alt="candidate-avatar" src="<?php echo IMAGE_PATH; ?>user-pic.jpg">
													<?php } ?>
													<p class="candidate-name"><?php echo $users->apply_user_name; ?></p>
													<p class="candidate-email"><?php echo $users->apply_user_email; ?></p>
													<p class="candidate-resume"><?php echo '<a href="'.USER_UPLOAD_PATH.''.$users->apply_user_resume.'">Resume</a>'; ?></p>
												</div>
											</div>
						
										

											

											<div class="referc-col-1 fl-left refer-table-cell text-center">
												<div class="visible-xs table-xs-title">Experience</div>
												<div class="table-content">
													<p class="candidate-job-title"><?php echo $users->apply_user_experience; ?> year</p>
													
												</div>
											</div>

											<div class="referc-col-1 fl-left refer-table-cell text-center">
												<div class="visible-xs table-xs-title">Applied On</div>
												<div class="table-content">
													<p class="candidate-job-title"><?php echo $users->insta_job_apply_date; ?></p>
													
												</div>
											</div>


											<div class="referc-col-1 fl-left refer-table-cell">
												<div class="visible-xs table-xs-title">Why me</div>
												<div class="table-content">
													<?php if(!empty($users->insta_job_apply_why_get_refer))
													{

													 if (strlen($users->insta_job_apply_why_get_refer) > 200) {
														echo '<p class="candidate-job-desc show_'.$users->insta_job_apply_id.'">'.strip_tags(substr($users->insta_job_apply_why_get_refer ,0, 200)).'..'; 
														$var = "show_".$users->insta_job_apply_id;
														echo  '<a class="show-more" href="javascript:void(0);" onclick="read_more(\''.$var.'\')">Show More</a></p>';
														echo '<p class="candidate-job-desc show_'.$users->insta_job_apply_id.'" style="display:none;">'.strip_tags($users->insta_job_apply_why_get_refer);
														$var = "show_".$users->insta_job_apply_why_get_refer;
														echo '<a class="show-more" href="javascript:void(0);" onclick="read_more(\''.$var.'\')">Show Less</a>
														</p> '; 
													} else {
														echo '<p class="candidate-job-desc" id="show_more'.$users->insta_job_apply_id.'">'.$users->insta_job_apply_why_get_refer.'</p>';  
													} } ?>
												</div>
											</div>

											<div class="referc-col-1 fl-left refer-table-cell text-right referc-action">
												<div class="table-content">
													<?php echo '<a href="'.base_url().'refer_candidate/'.$users->insta_job_apply_id.'/" onclick="return refer_confirm();" class="candidate-refer-link transition">Refer</a>'; ?>
												</div>
											</div>
										</div>
										<?php } } ?>
									</div>
								</div>
							</div>
							<?php } else { echo "Applied jobs not available"; } ?>
						</div>
						<!-- Candidate Wrap End -->
					</div>
					<?php } ?>
				
				</div>
				<?php }else { echo "</br></br><div class='small-title'>Currently there are no applications for your company. You may check again later. Post/forward a job opening of your company and get 100 points.</div>"; } ?>
			</div>
		</div>
	</div>
</div>
<script>
function show_users_row(id) {
	$('#'+id).toggle();
}

function refer_confirm() {
	refer=confirm("Do you want to refer this user?");
	console.log(refer);
	if(refer!=true) {
		return false;
	}
}

function read_more(id) {
	console.log(id);
	$('.'+id).toggle();
	//$('#apply_div_'+id).css( "height: 225px !important;");
}
</script>
