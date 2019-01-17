<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
  selector: '#job_description'
  });
   tinymce.init({
  selector: '#insta_article_description'
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<div class="right_col" role="main">
<?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
<?php
if($type=="user") {
//print_r($usermeta); die;
?>
  <div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Add candidate <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
            <form id="demo-form2" action="<?php echo base_url();  ?>admin/add_details/user/" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="name" id="name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="first_name" id="first_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="last_name" id="last_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Profile Pic <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type = "file" id="new_profile_pic" name="new_profile_pic"/> 
                 <input type = "hidden" id="profile_pic" name="profile_pic"/> 
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Name / Initial<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name email"  name="email" class="form-control col-md-7 col-xs-12 has-feedback-left" type="email" name="middle-name" required="required">
                   <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="gender">
                    <option value="">Choose option</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="phone" class="form-control col-md-7 col-xs-12" type="phone" name="middle-name">
                  
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="company" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" required="required">
                   
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Location <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="location" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" required="required">
                   
                </div>
              </div>

              <div class="form-group">
                <label for="skills" class="control-label col-md-3 col-sm-3 col-xs-12">Skills <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="skills" class="form-control col-md-7 col-xs-12" type="text" required="required">
                   <p class="optional-desc">Comma seperated tags, such as required skills or technologies, for this job.</p>
                </div>
              </div>

              
                       
              <div class="form-group">
              <label for="skills" class="control-label col-md-3 col-sm-3 col-xs-12">Experience <span class="required">*</span></label>
                
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   
                    <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                        <span class="optional">Year</span>
                        <div>
                        <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="50" step="1" name="exp_year" value="0" required="required">
                            
                        </div>
                    </div>
                     <div class="col-md-6 col-sm-6 col-xs-12 no-padding min-exp">
                        <span class="optional">Months</span>
                        <div>
                        <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="11" step="1" name="exp_month" value="0" required="required">
                            
                        </div>
                    </div>
                </div>
            </div>
                       

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Login Type<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_user_login_type" required="required">
                    <option value="google" selected>Google</option>
                    <option value="facebook">Facebook</option>
                    <option value="linkedin">LinkedIn</option>
                </select>
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_user_status" required="required">
                    <option value="0" selected>Disable</option>
                    <option value="1">Enable</option>
                </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Resume<span class="required">*</span> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
               
               <input type = "file" id="new_resume" name="new_resume" required="required"/> 
               
                 
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="user_id"/>
                  <a href="<?php echo base_url(); ?>admin/listing/user/" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
<script type="text/javascript">

  
  // When the browser is ready...
  $(function() {
    // Setup form validation on the #register-form element
    $("#demo-form2").validate({
        // Specify the validation rules
        rules: {
            name: "required"
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your full name"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>


<?php }
else if($type=="job") { 
 // echo "<pre>"; print_r($user);
?>
   <div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Post Job / Add Job<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form3" action="<?php echo base_url();  ?>admin/add_details/job" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Job Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_title" id="insta_job_title" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
             
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Application email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_application_email" id="insta_job_application_email"  required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group" style="display:none;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Candidate <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_user_id">
                <option value="">Select</option>
                    <?php 
                    foreach ($user as $val) {
                      $user_meta = json_decode($val->user_meta);
                         echo "<option value=".$val->insta_user_id.">".$user_meta->first_name." ".$user_meta->last_name." - ".$user_meta->email."</option>";
                      }
                    ?> 
                </select>
                   
                </div>
                
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Location <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_location" id="insta_job_location" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Job tags <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_tags" id="insta_job_tags" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_job_category">
                <?php 
                         echo '<option>Select</option>';
                         foreach($category as $val)
                         {
                            
                            echo '<option value="'.$val->insta_job_category.'">'.$val->insta_job_category.'</option>';
                         }
                ?>
                </select>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Experience <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"> <span class="optional-desc">Minimum Experience</span>
                  <input type="number" min="0" max="35" step="1" name="insta_job_min_experience" required="required" class="form-control"><span class="optional-desc">Maximum Experience</span>
                  <input type="number" min="0" max="35" step="1" name="insta_job_max_experience" required="required" class="form-control col-md-7 col-xs-6">
                </div>
              </div>

           
              
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Featured Image</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_job_featured_image" id="featured_image" placeholder="">
                   
                </div>
              </div>



              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="job_description" name="insta_job_description"></textarea>
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company <span class="required"></span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_company_id">
                    <?php 
                           echo '<option class="level-0">Select</option>';
                           foreach($company as $val)
                           {
                             
                            echo '<option class="level-0" value="'.$val->insta_company_id.'"">'.$val->insta_company_name.'</option>';
                           }                           
                            ?>
                </select>
                </div>
              </div>

              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Closing Date <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="insta_job_closing_date"  class="date-picker form-control col-md-7 col-xs-12" id="birthday">                 
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_job_status" required="required">
                    <option value="0" selected>Disable</option>
                    <option value="1">Enable</option>
                </select>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Spotlight <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="checkbox" name="insta_job_spotlight"  value="1" class="col-md-1 col-xs-1" id="insta_job_spotlight">                 
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  
                  <a href="<?php echo base_url(); ?>admin/listing/job/" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>

<script type="text/javascript">

  
  // When the browser is ready...
  $(function() {
    
    // Setup form validation on the #register-form element
    $("#demo-form3").validate({
        rules: {
            insta_job_title: "required",
            insta_job_application_email: "required",
            insta_job_application_email: {
                required: true,
                email: true
            },
            insta_job_location: "required",
            insta_job_tags: "required",
            
            insta_job_min_experience: "required",
            insta_job_max_experience: "required",

            insta_job_featured_image :  {
                extension: "jpg|jpeg|png|gif"
            },
            insta_job_closing_date: "required"
        },
        messages: {
          insta_job_title: "Please enter job title",
          insta_job_application_email: "Please provide a valid email address",
          insta_job_location: "Please input location",
          insta_job_tags: "Please provide tags",
          insta_job_min_experience: "Please provide a minimum experience",
          insta_job_max_experience: "Please provide a maximum experience",
          insta_job_featured_image: "Please provide featured image",
          insta_job_closing_date: "Please provide a closing date"
        },        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>


<?php } 
else if($type=="company") { //print_r($company_detail); 
?>

<div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Add company <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form4" action="<?php echo base_url();  ?>admin/add_details/company" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company name<span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_company_name" id="insta_company_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TAGLINE (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_company_tagline" id="insta_company_tagline"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description (OPTIONAL)</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="job_description" name="insta_company_description"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">VIDEO (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_video" id="insta_company_video" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">WEBSITE (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_website" id="insta_company_website" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">GOOGLE+ USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_google" id="insta_company_google" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FACEBOOK USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_facebook" id="insta_company_facebook" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LINKEDIN USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_linkedin" id="insta_company_linkedin"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TWITTER USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_twitter" id="insta_company_twitter" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
               
                  <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_company_logo" id="insta_company_logo" placeholder="">
                   
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_company_status" required="required">
                    <option value="0" selected>Disable</option>
                    <option value="1">Enable</option>
                </select>
                
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="insta_company_id"/>
                
                 <a href="<?php echo base_url(); ?>admin/listing/company/" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>


<script type="text/javascript">

  
  // When the browser is ready...
  $(function() {
    

    // Setup form validation on the #register-form element
    $("#demo-form4").validate({
        // Specify the validation rules
        rules: {
            insta_company_name : "required",
            insta_company_logo :  {
               
                extension: "jpg|jpeg|png|gif"
            },
        },
        
        // Specify the validation error messages
        messages: {
          insta_company_name: "Please provide company name",
          insta_company_logo: "Please provide company logo(jpg|jpeg|png|gif)"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>


<?php } 
else if($type=="admin_users") { //print_r($company_detail); 
?>

<div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Ads user <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form5" action="<?php echo base_url();  ?>admin/add_details/admin_users" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_name" id=" insta_admin_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email 
                <span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" name="insta_admin_email" id="insta_admin_email"  class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              
              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username
                <span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_username" id="insta_admin_username" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                <span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_password" id="insta_admin_password" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>

               <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_admin_type" required="required">
                    <option value="Super Administrator">Super Administrator</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Manager">Manager</option>
                </select>
                
                </div>
              </div>

              

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label><span class="required"> *</span>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_admin_status" required="required">
                    <option value="0" selected>Disable</option>
                    <option value="1">Enable</option>
                </select>
                
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                 
                
                 <a href="<?php echo base_url(); ?>admin/listing/admin_users/" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>

<script type="text/javascript">

  
  // When the browser is ready...
  $(function() {
    
    // Setup form validation on the #register-form element
    $("#demo-form5").validate({
        // Specify the validation rules
        rules: {
            insta_admin_name : "required",
            insta_admin_email: {
              required: true,
              email: true
            },
            insta_admin_username: "required",
            insta_admin_password: {
              required: true,
              minlength: 5
            }
        },
        
        // Specify the validation error messages
        messages: {
          insta_admin_name: "Please provid admin name",
          insta_admin_email: "Please enter valid email",
          insta_admin_username: "Please provide admin username",
          insta_admin_password: "Please provide admin password(minlength : 5)"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });


<?php } 
else if($type=="article") { //print_r($company_detail); 
?>
<div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Add article <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form4" action="<?php echo base_url();  ?>admin/add_details/article" data-parsley-validate class="form-horizontal form-label-left" method="post">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title<span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_article_title" id="insta_article_title" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              
              
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="insta_article_description" name="insta_article_description" required="required"></textarea>
                </div>
              </div>

              

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_article_status" required="required">
                    <option value="0" selected>Disable</option>
                    <option value="1">Enable</option>
                </select>
                
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="insta_company_id"/>
                
                 <a href="<?php echo base_url(); ?>admin/listing/article/" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>

<?php } ?>
</div>
<!-- /page content -->