<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<link href="<?php echo CSS_PATH; ?>dcalendar.picker.css" rel="stylesheet">
      <script src="<?php echo JS_PATH; ?>dcalendar.picker.js"></script>
<script>
	tinymce.init({
	selector: '#job_description'
	});
	tinymce.init({
	selector: '#company_description'
	});
</script> 
<style>
  .error{
    color:red;
  }
</style>
<?php //print_r($job_details); 
$job = $job_details[0]; ?> 
<div id="primary" class="content-area container" role="main">

   <div class="row">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
         <article id="post-3376" class="post-3376 page type-page status-publish hentry">
            <div class="entry-content">
            <br> <h1>Manage Job</h1>
               <!-- <a href="<?php //echo base_url(); ?>manage-job/">Manage Jobs</a>
               <br>
                <a href="<?php //echo base_url(); ?>refer-and-earn/">Refer and Earn</a> -->
               <form action="<?php echo base_url() ?>job/update_job" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data" novalidate>
                 
                  <fieldset class="fieldset-job_title">
                     <label for="job_title">Job Title</label>
                     <div class="field required-field">
                        <input type="text" class="input-text" name="insta_job_title" id="job_title" placeholder="" value="<?php if(!empty($job->insta_job_title)) echo $job->insta_job_title; ?>" maxlength="" required="">
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-application">
                     <label for="application">Application email</label>
                     <div class="field required-field">
                        <input type="text" class="input-text" name="insta_job_application_email" id="application" placeholder="you@yourdomain.com" value="<?php if(!empty($job->insta_job_application_email)) echo $job->insta_job_application_email; ?>" maxlength="" required="">
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-job_location">
                     <label for="job_location">Location <small>(optional)</small></label>
                     <div class="field ">
                        <input type="text" class="input-text" name="insta_job_location" id="job_location" placeholder="e.g. &quot;London&quot;" value="<?php if(!empty($job->insta_job_location)) echo $job->insta_job_location; ?>" maxlength="" required="">
                        <small class="description">Leave this blank if the location is not important</small>				
                     </div>
                  </fieldset>
                 
                  <fieldset class="fieldset-job_tags">
                     <label for="job_tags">Job tags <small>(optional)</small></label>
                     <div class="field">
                        <input type="text" class="input-text" name="insta_job_tags" id="job_tags" placeholder="e.g. PHP, Social Media, Management" value="<?php if(!empty($job->insta_job_tags)) echo $job->insta_job_tags; ?>" maxlength="" required="">
                        <small class="description">Comma separate tags, such as required skills or technologies, for this job.</small>				
                     </div>
                  </fieldset>
                 

                  <field set class="fieldset-company_tagline">
                     <label for="company_tagline">Experience <small></small></label>
                     <div class="field ">
                     
                     Minimum <input type="number" min="0" max="20" step="1" name="insta_job_min_experience" value="<?php if(!empty($job->insta_job_min_experience)) echo $job->insta_job_min_experience; else echo 0; ?>"> Year<br>
                    
                     Maximum : 
                     <input type="number" min="0" max="20" step="1" name="insta_job_max_experience" value="<?php if(!empty($job->insta_job_max_experience)) echo $job->insta_job_max_experience; else echo 0; ?>"> Year
                        
                     </div>
                  </fieldset><br>
                   <fieldset class="fieldset-company_tagline">
                     <label for="company_tagline">Category <?php echo $job->insta_job_category; ?><small></small></label>
                     <div class="field">
                     <span class="select postform-wrapper">
                           <select name="insta_job_category" id="insta_job_category" class="postform" required="">
                           <?php 
                           echo '<option class="level-0">Select</option>';
                           foreach($category as $val)
                           {
                              $selected = "";
                              if(!empty($job->insta_job_category) && $job->insta_job_category == $val->insta_job_category)
                              { 
                                $selected = 'selected="selected"';
                              }
                              echo '<option class="level-0" value="'.$val->insta_job_category.'"" '.$selected.'>'.$val->insta_job_category.'</option>';
                           }
                          ?>
                         </select>
                      </span>
                     </div>
                  </fieldset><br>
                  <fieldset class="fieldset-featured_image">
                     <label for="featured_image">Featured Image <small>(optional)</small></label>
                     <div class="field ">
                        <label for="featured_image" class="file-field-label">
                           <div class="job-manager-uploaded-files">
                           </div>
                            <?php if(!empty($job->insta_job_featured_image)) {  ?>
                                <img height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$job->insta_job_featured_image; ?>">
                           <?php }
                            ?>
                           <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_job_featured_image" id="featured_image" placeholder="">
                          
                        </label>
                        <small class="description file-field-description">
                        Used for the Job Spotlight display	</small>
                     </div>
                  </fieldset><br>
                  <fieldset class="fieldset-job_description">
                     <label for="job_description">Description (or Provide link of Job from your company career page)</label>
                     <textarea id="job_description" name="insta_job_description"><?php if(!empty($job->insta_job_description)) echo $job->insta_job_description; ?></textarea>
                  </fieldset>
                  <fieldset class="fieldset-job_deadline">
                     <label for="job_deadline">Closing date <small>(optional)</small></label>
                     <div class="field ">
                        <input type="text" class="input-text hasDatepicker" name="insta_job_closing_date" id="job_deadline" placeholder="yyyy-mm-dd" value="<?php //if(!empty($job->insta_job_closing_date)) echo $job->insta_job_closing_date; ?>" maxlength="">
                        <small class="description">Deadline for new applicants. The listing will end automatically after this date.</small>				
                     </div>
                  </fieldset>
                  <!-- Company Information Fields -->
                 <!--  <h2>Company Details</h2>
                  <fieldset class="fieldset-company_name">
                     <label for="company_name">Company name</label>
                     <div class="field required-field">

                         <span class="select postform-wrapper">
                           <select name="insta_company_id" id="insta_company_id" class="postform" required="" onchange="show_company_input(this.value)">
                           <?php 
                           // echo '<option class="level-0">Select</option>';
                           // foreach($company as $val)
                           // {
                           	
                           // 		echo '<option class="level-0" value="'.$val->insta_company_id.'"">'.$val->insta_company_name.'</option>';
                           // }
                           // echo '<option class="level-0" value="other">Other</option>';
                            ?>
						   </select>
                           <input type="text" class="input-text" name="insta_company_name" id="insta_company_name" value="" maxlength="100" required="" style="display:none;" placeholder="Your company name">
                        </span>
                     </div>
                  </fieldset> -->
                  
                  <p>
                     <br><br>
                     <?php if(!empty($job->insta_job_id)) {
                      echo '<input type="hidden" name="insta_job_id" value="'.$job->insta_job_id.'">';
                     } ?>
                     
                     <input type="hidden" name="insta_user_id" value="<?php echo $this->session->user_session['user_id']; ?>">
                     <input type="hidden" name="insta_company_id" value="<?php echo $this->session->user_session['company_id']; ?>">
                     <input type="submit" name="update_job" class="button" value="Preview">
                  </p>
               </form>
            </div>
         </article>
         <!-- #post -->
      </div>
   </div>
</div>
<script type="text/javascript">
    //$('#insta_company_id').change(testMessage);

    function show_company_input($val){
    	if($val == 'other'){
    		$("#insta_company_name").show();
    		
    	}else{
    		//$('#insta_company_name').val("");
    		$("#insta_company_name").hide();
    	}
        
    }
</script>
<script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#submit-job-form").validate({
    
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
$('#job_deadline').dcalendarpicker();
$('#job_deadline').dcalendarpicker({

  // default: mm/dd/yyyy
  format: 'yyyy-mm-dd'
  
});
//$('#calendar-demo').dcalendar(); //creates the calendar
</script>