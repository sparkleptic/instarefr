<script>
  tinymce.init({
  selector: '#insta_job_description'
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
<div id="primary" class="content-area container" role="main">

   <div class="row">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
         <article id="post-3376" class="post-3376 page type-page status-publish hentry">
            <div class="entry-content">
            <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
            <br> <h1>Post Job</h1>
               <!-- <a href="<?php //echo base_url(); ?>manage-job/">Manage Jobs</a>
               <br>
                <a href="<?php //echo base_url(); ?>refer-and-earn/">Refer and Earn</a> -->
               <form action="<?php echo base_url() ?>job/post" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data" novalidate>
                 
                  <fieldset class="fieldset-job_title">
                     <label for="job_title">Job Title</label>
                     <div class="field required-field">
                        <input type="text" class="input-text" name="insta_job_title" id="insta_job_title"  required>
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-application">
                     <label for="application">Application email</label>
                     <div class="field required-field">
                        <input type="text" class="input-text" name="insta_job_application_email" id="insta_job_application_email" placeholder="you@yourdomain.com" value="<?php echo $this->session->user_session['email']; ?>"  required>
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-job_location">
                     <label for="job_location">Location <small>(optional)</small></label>
                     <div class="field ">
                        <input type="text" class="input-text" name="insta_job_location" id="insta_job_location" placeholder="e.g. &quot;London&quot;" required>
                        <small class="description">Leave this blank if the location is not important</small>        
                     </div>
                  </fieldset>
                 
                  <fieldset class="fieldset-job_tags">
                     <label for="job_tags">Job tags <small>(optional)</small></label>
                     <div class="field">
                        <input type="text" class="input-text" name="insta_job_tags" id="insta_job_tags" placeholder="e.g. PHP, Social Media, Management"  required>
                        <small class="description">Comma separate tags, such as required skills or technologies, for this job.</small>        
                     </div>
                  </fieldset>
                  

                  <field set class="fieldset-company_tagline">
                     <label for="company_tagline">Experience <small></small></label>
                     <div class="field ">
                     
                     Minimum : <input type="number" min="0" max="20" step="1" name="job_min_exp_year" value="0">
                     <br>
                     Maximum : 
                     <input type="number" min="0" max="20" step="1" name="job_max_exp_year" value="0">
                        
                     </div>
                  </fieldset>
                   <fieldset class="fieldset-company_tagline">
                     <label for="company_tagline">Category <small></small></label>
                     <div class="field">
                     <span class="select postform-wrapper">
                           <select name="insta_job_category" id="insta_job_category" class="postform" required>
                           <?php 
                           echo '<option class="level-0">Select</option>';
                           foreach($category as $val)
                           {
                            
                              echo '<option class="level-0" value="'.$val->insta_job_category.'"">'.$val->insta_job_category.'</option>';
                           }
                          ?>
                         </select>
                      </span>
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-featured_image">
                     <label for="featured_image">Featured Image <small>(optional)</small></label>
                     <div class="field ">
                        <label for="featured_image" class="file-field-label">
                           <div class="job-manager-uploaded-files">
                           </div>
                           <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_job_featured_image" id="insta_job_featured_image">
                           <span class="button button--size-medium">
                           Choose Image     </span>
                        </label>
                        <small class="description file-field-description">
                        Used for the Job Spotlight display  </small>
                     </div>
                  </fieldset>
                  <fieldset class="fieldset-job_description">
                     <label for="job_description">Description (or Provide link of Job from your company career page)</label>
                     <textarea id="insta_job_description" name="insta_job_description">Hello, World!</textarea>
                  </fieldset>
                  <fieldset class="fieldset-job_deadline">
                     <label for="job_deadline">Closing date <small>(optional)</small></label>
                     <div class="field ">
                        <input type="text" class="input-text hasDatepicker" name="insta_job_closing_date" id="insta_job_closing_date" placeholder="yyyy-mm-dd">
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
                            
                           //     echo '<option class="level-0" value="'.$val->insta_company_id.'"">'.$val->insta_company_name.'</option>';
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
                     <input type="hidden" name="insta_user_id" value="<?php echo $this->session->user_session['user_id']; ?>" required="">
                      <input type="hidden" name="insta_company_id" value="<?php echo $this->session->user_session['company_id']; ?>">
                     <input type="submit" name="submit_job" class="button" value="Preview">
                  </p>
               </form>
            </div>
         </article>
         <!-- #post -->
      </div>
   </div>
</div>
<!-- jQuery Form Validation code -->

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
$('#insta_job_closing_date').dcalendarpicker();
$('#insta_job_closing_date').dcalendarpicker({

  // default: mm/dd/yyyy
  format: 'yyyy-mm-dd'
  
});
//$('#calendar-demo').dcalendar(); //creates the calendar
</script>