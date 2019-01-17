<!-- <link href="<?php //echo CSS_PATH; ?>dcalendar.picker.css" rel="stylesheet"> -->
<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<?php  if(!empty($job_details[0])) { $job = $job_details[0]; }  ?> 
<!-- Current Page Info-->

<?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
<!-- POST JOB SECTION -->
<div class="post-job">
  <div class="container">
  <?php $this->load->view('common/common-msg'); ?>
          <div id="content" class="col-lg-9 col-md-9 col-sm-9 col-xs-12 no-padding-left">
              <!-- <h2 class="section-title"><?php //if(!empty($job)) { echo "UPDATE A JOB HERE"; }else { echo "POST A JOB HERE"; } ?></h2> -->
              <!-- <span class="green-border"></span> -->
             
              <div class="job-details-form">
                   <?php if(!empty($job->insta_job_id)) {
                    $action = 'action="'.base_url().'job/update_job"';
                  }else{
                    $action = 'action="'.base_url().'job/post"';
                  } ?>
                  <form id="job-form" method="post" <?php echo $action; ?> enctype="multipart/form-data">

                      <div class="input clearfix">
                          <label>Your Email</label>
                          <input class="col-md-12 col-xs-12 col-sm-12 post-job-input-text" type="email" name="insta_job_application_email" id="insta_job_application_email" placeholder="you@yourdomain.com" value="<?php if(!empty($job->insta_job_application_email)) echo $job->insta_job_application_email; else echo  $this->session->user_session['email'];  ?>"  required/>
                      </div>
                          
                      <div class="input clearfix">
                          <label>Job Title</label>
                          <input class="col-md-12 col-xs-12 col-sm-12 post-job-input-text" type="text" name="insta_job_title" id="insta_job_title" value="<?php if(!empty($job->insta_job_title)) echo $job->insta_job_title; ?>"   required>
                      </div>

                      <div class="input clearfix">
                          <label>Location</label>
                          <input class="col-md-12 col-xs-12 col-sm-12 post-job-input-text" type="text" name="insta_job_location" id="insta_job_location"  value="<?php if(!empty($job->insta_job_location)) echo $job->insta_job_location; ?>" required>
                          <p class="optional-desc">Leave this blank if the location is not important</p>
                      </div>

                      <!-- <div class="input clearfix">
                          <label>Job Type</label>
                          <div class="style-select">
                              <select class="col-md-12 col-xs-12 col-sm-12 post-job-input-text">
                                  <option>Job Type1</option>
                                  <option>Job Type2</option>
                                  <option>Job Type3</option>
                                  <option>Job Type4</option>
                                  <option>Job Type5</option>
                              </select>
                          </div>
                      </div> -->

                      <div class="input clearfix">
                          <label>Category <span>(Optional)</span></label>
                          <div class="style-select">
                              <select class="col-md-12 col-xs-12 col-sm-12 post-job-input-text" name="insta_job_category" id="insta_job_category">
                              <?php 
                                 echo '<option class="level-0">Select</option>';
                                 foreach($category as $val)
                                 {
                                     $selected = "";
                                    if(!empty($job->insta_job_category) && $job->insta_job_category == $val->insta_job_category)
                                    { 
                                      $selected = 'selected="selected"';
                                    }
                                    echo '<option value="'.$val->insta_job_category.'" '.$selected.'>'.$val->insta_job_category.'</option>';
                                 }
                              ?>
                              </select>
                          </div>
                      </div>
                      
                      <div class="input clearfix">
                          <label>Experience <span>(Optional)</span></label>
                          <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                              <div class="col-md-6 col-xs-12 col-sm-6 no-padding min-exp">
                                  <span class="optional-desc">Minimum Experience</span>
                                  <div class="">
                                      <!-- <select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text">
                                          <option>1 Year</option>
                                          <option>2 Years</option>
                                          <option>3 Years</option>
                                          <option>4 Years</option>
                                          <option>5 Years</option>
                                      </select> -->
                                      <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="35" step="1" id="insta_job_min_experience" name="insta_job_min_experience" value="<?php if(!empty($job->insta_job_min_experience)) echo $job->insta_job_min_experience; else echo 0; ?>">
                                  </div>
                              </div>
                              <div class="col-md-6 col-xs-12 col-sm-6 no-padding max-exp">
                                  <span class="optional-desc">Maximum Experience</span>
                                  <div class="">
                                      <!-- <select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text">
                                          <option>1 Year</option>
                                          <option>2 Years</option>
                                          <option>3 Years</option>
                                          <option>4 Years</option>
                                          <option>5 Years</option>
                                      </select> -->
                                       <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="35" step="1" id="insta_job_max_experience" name="insta_job_max_experience" value="<?php if(!empty($job->insta_job_max_experience)) echo $job->insta_job_max_experience; else echo 0; ?>">
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="input clearfix">
                          <label>Job Tags</label>
                          <input class="col-md-12 col-xs-12 col-sm-12 post-job-input-text" type="text" name="insta_job_tags" id="insta_job_tags" placeholder="e.g. PHP, Social Media, Management" value="<?php if(!empty($job->insta_job_tags)) echo $job->insta_job_tags; ?>"  required>
                          <p class="optional-desc">Comma seperated tags, such as required tags or technologies, for this job.</p>
                      </div>

                       

                      <div class="input clearfix">
                          <label class="input-file-label">Job Banner Image<span class="optional"> (Optional)</span></label>
                          <div class="clearfix">
                              <div class="pull-left">
                                  <label class="btn-default btn-file input-file">
                                   <?php if(!empty($job->insta_job_featured_image)) {  ?>
                                        <img height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$job->insta_job_featured_image; ?>">
                                   <?php } ?>
                                      Choose File <input type="file" data-file_types="jpg|jpeg|gif|png" name="insta_job_featured_image" id="insta_job_featured_image" style="display: none;">
                                  </label>
                              </div>
                              <p class="optional-desc pull-left">
                                  Used for the Job Spotlight display, Maximum file size: 2 MB.
                              </p>
                          </div>
                      </div>

                      <div class="input clearfix">
                          <label>Description <span>(Optional)</span></label>
                          <textarea id="insta_job_description" class="col-xs-12 col-sm-12 col-md-12"   name="insta_job_description"><?php if(!empty($job->insta_job_description)) echo $job->insta_job_description; ?></textarea>
                      </div>

                      <div class="input clearfix">
                          <label>Closing Date <span>(Optional)</span></label>
                          <input  class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="text" name="insta_job_closing_date" id="insta_job_closing_date" placeholder="yyyy-mm-dd"  value="<?php if(!empty($job->insta_job_closing_date)) echo $job->insta_job_closing_date; ?>">
                      </div>

                    <!-- PREVIEW BUTTON -->
                   <?php if(!empty($job->insta_job_id)) {
                      echo '<input type="hidden" name="insta_job_id" value="'.$job->insta_job_id.'">';
                      echo '<input type="hidden" name="insta_user_id" value="'.$job->insta_user_id.'">';
                     }else {
                       echo '<input type="hidden" name="insta_user_id" value="'.$this->session->user_session['user_id'].'">';
                      } ?>
                     
                    
                     <input type="hidden" name="insta_company_id" value="<?php echo $this->session->user_session['company_id']; ?>">
                    <input type="submit" class="preview-button preview-button-margin" value="PUBLISH">
                    

                  </form>
              </div>
          </div>
         <?php $this->load->view('common/inner-sidebar'); ?>
      </div>
  </div>
</div>





 <script>
  // When the browser is ready...
  $(function() {
    var max_exp = $('#insta_job_max_experience').val();
   console.log(max_exp);
    // Setup form validation on the #register-form element
    $("#job-form").validate({
   
        // Specify the validation rules
        rules: {
            insta_job_title: "required",
            insta_job_location: "required",
            insta_job_application_email: {
                required: true,
                email: true
            },
            insta_job_tags: "required",
            insta_job_category: "required",
            insta_job_location: "required",
            insta_job_featured_image :  {
               
                extension: "jpg|jpeg|png|gif"
            },
            insta_job_min_experience : "required",
            insta_job_max_experience : "required",
            // password: {
            //     required: true,
            //     minlength: 5
            // },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            insta_job_title: "Please enter your job title",
            insta_job_location: "Please enter your job location",
            insta_job_application_email: "Please enter a valid email address",
             insta_job_min_experience : "Please select job experience",
            insta_job_max_experience : "Please select job experience",
            // password: {
            //     required: "Please provide a password",
            //     minlength: "Your password must be at least 5 characters long"
            // },
            insta_job_tags: "Please enter your job's required tags",
            insta_job_category : "Please enter your job category",
            agree: "Please accept our policy",
            insta_job_featured_image : "you can upload image type jpeg,jpg,png and gif"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
</script> 
<script>

$('#insta_job_closing_date').datepicker({

  dateFormat: 'yy-mm-dd'
  
});
</script>
<script>
  tinymce.init({
  selector: '#insta_job_description'
  });
  tinymce.init({
  selector: '#company_description'
  });
</script> 