<!-- Current Page Info-->
<div class="manage-job-table-container">
	<div class="container">
		<div class="row">
			<!-- Recent Jobs In Your Area -->
			<div class="recent-jobs-section">
				<div class="container">
					
					<?php $this->load->view('common/common-msg'); ?>
					
					<div class="row">
						<section id="content" class="spotlight-right col-md-9 col-sm-9 col-xs-12">
						<?php if(is_array($job_list) && !empty($job_list)) { ?>
							<div class="recent-jobs" id="recent-jobs">
								<ul id="gallery" class="clearfix job-list">
								<?php foreach($job_list as $val) { ?>
									<li class="job-list-item" id="job-list-item1">
										<div class="clearfix">
											<div class="job-item-div0 pull-left job-list-item-image">
											<?php if(!empty($val->insta_job_featured_image)) {
												echo '<img class="img-responsive job-logo" src="'.USER_UPLOAD_PATH.''.$val->insta_job_featured_image.'" alt="Job Logo">';
											} else {
												echo '<img class="img-responsive job-logo" src="'.IMAGE_PATH.'NoImageAvailable.png" alt="Job Logo">';
											} ?>
											</div>
											<div class="job-item-div1">
												<a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-link transition"><?php echo $val->insta_job_title; ?> - </a>
												<p class="job-item-text"><?php echo $val->company; ?></p>
											</div>
											<div class="job-item-div2">
												<i class="glyphicon glyphicon-map-marker"></i>
												<span><?php echo $val->insta_job_location; ?></span>
											</div>
											<div class="job-item-div3">
												<a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-time-link transition">VIEW JOB</a>
											</div>
										</div>
									</li>
								<?php }  ?>
								</ul>
							</div>
							
							<div class="pagination clearfix"></div>
						<?php } else {
							echo "Job Listing not available..";
						} ?>
						</section><!--spotlight-right section ends-->
						
						<?php $this->load->view('common/inner-sidebar'); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
