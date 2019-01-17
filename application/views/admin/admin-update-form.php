<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
  selector: '#job_description'
  });
  tinymce.init({
  selector: '#insta_article_description'
  });
</script>
<!-- page content -->
<div class="right_col" role="main">
<?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>

<?php
if($type=="user") {
$user = $user_detail['user'][0];
$usermeta = json_decode($user_detail['user_meta'][0]);
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
            <h2>Update Candidate <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" action="<?php echo base_url();  ?>admin/edit_details/user/" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

            
              <input type="hidden" name="name" id="name" value="<?php if(!empty($usermeta->name)) echo $usermeta->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="first_name" id="first_name" value="<?php if(!empty($usermeta->first_name)) echo $usermeta->first_name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="last_name" id="last_name" value="<?php if(!empty($usermeta->last_name)) echo $usermeta->last_name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Profile Pic <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php if(!empty($usermeta->profile_pic)) { if(strpos($usermeta->profile_pic, "https://") !== false) {
                  ?>
                 <img height="100" width="100" alt="" src="<?php echo $usermeta->profile_pic; ?>"> <?php } else{ ?>
                 <img height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$usermeta->profile_pic; ?>">
                 <?php } } ?>
                 <input type = "file" id="new_profile_pic" name="new_profile_pic"/> 
                 <input type = "hidden" id="profile_pic" name="profile_pic" value="<?php  if(!empty($usermeta->profile_pic)) echo $usermeta->profile_pic; ?>"/> 
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Name / Initial  <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name email"  value="<?php if(!empty($usermeta->email)) echo $usermeta->email; ?>" class="form-control col-md-7 col-xs-12 has-feedback-left" type="email" required="required" disabled>
                  <input  name="email"  value="<?php if(!empty($usermeta->email)) echo $usermeta->email; ?>" class="form-control col-md-7 col-xs-12 has-feedback-left" type="hidden">
                   <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gender  <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="gender" required="required">
                    <option value="">Choose option</option>
                    <option value="male" <?php if(!empty($usermeta->gender) && $usermeta->gender=="male") echo "selected='selected'" ?>>Male</option>
                    <option value="female" <?php if(!empty($usermeta->gender) && $usermeta->gender=="female") echo "selected='selected'" ?>>Female</option>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="phone" value="<?php if(!empty($usermeta->phone)) echo $usermeta->phone; ?>" class="form-control col-md-7 col-xs-12" type="phone" name="middle-name">
                  
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company  <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="company" value="<?php if(!empty($usermeta->company_name)) echo $usermeta->company_name; ?>" class="form-control col-md-7 col-xs-12" type="company" name="middle-name" required="required">
                   
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Location <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="location" value="<?php if(!empty($usermeta->location)) echo $usermeta->location; ?>" class="form-control col-md-7 col-xs-12" type="location" name="middle-name" required="required">
                   
                </div>
              </div>

              <div class="form-group">
                <label for="skills" class="control-label col-md-3 col-sm-3 col-xs-12">Skills <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name"  name="skills" value="<?php if(!empty($usermeta->skills)) echo $usermeta->skills; ?>" class="form-control col-md-7 col-xs-12" type="text" required="required">
                   <p class="optional-desc">Comma seperated tags, such as required skills or technologies, for this job.</p>
                </div>
              </div>

              <?php if(!empty($usermeta->experience)) {
                        $exp =  explode(".",$usermeta->experience); ?>
                        <div class="form-group">
                          <label for="skills" class="control-label col-md-3 col-sm-3 col-xs-12">Experience <span class="required">*</span></label>
                            
                             <div class="col-md-6 col-sm-6 col-xs-12">
                               
                                <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                                    <span class="optional">Year</span>
                                    <div>
                                    <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="35" step="1" name="exp_year" value="<?php echo $exp[0]; ?>" required="required">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 no-padding min-exp">
                                    <span class="optional">Months</span>
                                    <div>
                                    <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" min="0" max="11" step="1" name="exp_month" value="<?php echo $exp[1]; ?>" required="required">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php }else{ ?>
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
                        <?php } ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Resume <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if(!empty($usermeta->resume)) { ?>
               <a target="_blank" href="<?php echo USER_UPLOAD_PATH.$usermeta->resume; ?>">Download resume</a><br><br>
               <?php } ?>
               <input type = "file" id="new_resume" name="new_resume"/> 
               <input type = "hidden" id="resume" name="resume" value="<?php  echo $usermeta->resume; ?>"/> 
                 
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="user_id" value="<?php echo $user->insta_user_id; ?>"/>
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
<?php }
else if($type=="job") { 
 // echo "<pre>";print_r($job_detail); die;
$job = $job_detail[0]; ?>

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
            <h2>Update Post Job <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" action="<?php echo base_url();  ?>admin/edit_details/job" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Job Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_title" id="insta_job_title" value="<?php if(!empty($job->insta_job_title)) echo $job->insta_job_title; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Application email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_application_email" id="insta_job_application_email" value="<?php if(!empty($job->insta_job_application_email)) echo $job->insta_job_application_email; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Location <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_location" id="insta_job_location" value="<?php if(!empty($job->insta_job_location)) echo $job->insta_job_location; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Job tags <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_job_tags" id="insta_job_tags" value="<?php if(!empty($job->insta_job_tags)) echo $job->insta_job_tags; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_job_category">
                    <?php 
                           echo '<option class="level-0">Select</option>';
                           foreach($category as $val)
                           {
                             $selected = "";
                             if($val->insta_job_category == $job->insta_job_category)
                             {
                                $selected = "selected='selected'";
                             }
                            echo '<option class="level-0" value="'.$val->insta_job_category.'"" '.$selected.'>'.$val->insta_job_category.'</option>';
                           }
                           
                            ?>
                </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Experience <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"> <span class="optional-desc">Minimum Experience</span>
                  <input type="number" min="0" max="35" step="1" name="insta_job_min_experience" required="required" class="form-control" value="<?php if(!empty($job->insta_job_min_experience)) echo $job->insta_job_min_experience; else echo 0; ?>"><span class="optional-desc">Maximum Experience</span>
                  <input type="number" min="0" max="35"  step="1" name="insta_job_max_experience" required="required" class="form-control col-md-7 col-xs-6" value="<?php if(!empty($job->insta_job_max_experience)) echo $job->insta_job_max_experience; else echo 0; ?>">
                </div>
              </div>

              
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Featured Image</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if(!empty($job->insta_job_featured_image)) { ?>
                 <img height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$job->insta_job_featured_image; ?>">
                 <?php } ?>
                  <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_job_featured_image" id="featured_image" placeholder="">
                   
                </div>
              </div>



              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="job_description" name="insta_job_description"><?php if(!empty($job->insta_job_description)) echo $job->insta_job_description; ?></textarea>
                </div>
              </div>

              <?php if(empty($job->insta_user_id)) { ?>
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_company_id" required="required">
                    <?php 
                           echo '<option class="level-0">Select</option>';
                           foreach($company as $val)
                           {
                             $selected = "";
                             if($val->insta_company_id == $job->insta_company_id)
                             {
                                $selected = "selected='selected'";
                             }
                            echo '<option class="level-0" value="'.$val->insta_company_id.'"" '.$selected.'>'.$val->insta_company_name.'</option>';
                           }
                           echo '<option class="level-0" value="other">Other</option>';
                            ?>
                </select>
                </div>
              </div>
              <?php } ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Closing Date <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="insta_job_closing_date"  class="form-control col-md-7 col-xs-12" id="insta_job_closing_date" value="<?php if(!empty($job->insta_job_closing_date)) { echo $job->insta_job_closing_date;} ?>">                 
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_job_status">
                   <option class="level-0" value="1" <?php if($job->insta_job_status == 1) { echo "selected='selected'";} ?>>Enable</option>
                   <option class="level-0" value="0" <?php if($job->insta_job_status == 0) { echo "selected='selected'"; } ?>>Disable</option>     
                </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Spotlight <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="checkbox" name="insta_job_spotlight"  value="1" class="col-md-1 col-xs-1" id="insta_job_spotlight" <?php if($job->insta_job_spotlight == 1) { echo "checked='checked'";} ?>>                 
                </div>
              </div>
              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php if(isset($job->insta_job_updated_round))  { ?>
                  <input type="hidden" name="insta_job_updated_round" value="<?php echo $job->insta_job_updated_round; ?>"/>
                <?php  } ?>
                  <input type="hidden" name="insta_job_id" value="<?php echo $job->insta_job_id; ?>"/>
                  <?php if(!empty($job->insta_user_id)) { ?>
                  <input type="hidden" name="insta_user_id" value="<?php echo $job->insta_user_id; ?>"/>
                   <?php if(!empty($job->insta_company_id)) { ?>
                  <input type="hidden" name="insta_company_id" value="<?php echo $job->insta_company_id; ?>"/>
                  <?php } ?>
                  <?php } ?>
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
<script>

$('#insta_job_closing_date').datepicker({

  dateFormat: 'yy-mm-dd'
  
});
</script>
<?php } 
else if($type=="company") { //print_r($company_detail); 
$company = $company_detail[0]; 
$company_detail = json_decode($company_detail[0]->insta_company_alias);

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
            <h2>Update Company <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" action="<?php echo base_url();  ?>admin/edit_details/company" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_company_name" id="insta_company_name" value="<?php if(!empty($company->insta_company_name)) echo $company->insta_company_name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TAGLINE (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_company_tagline" id="insta_company_tagline" value="<?php if(!empty($company_detail->insta_company_tagline)) echo $company_detail->insta_company_tagline; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description (OPTIONAL)</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="job_description" name="insta_company_description"><?php if(!empty($company_detail->insta_company_description)) echo $company_detail->insta_company_description; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">VIDEO (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_video" id="insta_company_video" value="<?php if(!empty($company_detail->insta_company_video)) echo $company_detail->insta_company_video; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">WEBSITE (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_website" id="insta_company_website" value="<?php if(!empty($company_detail->insta_company_website)) echo $company_detail->insta_company_website; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">GOOGLE+ USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_google" id="insta_company_google" value="<?php if(!empty($company_detail->insta_company_google)) echo $company_detail->insta_company_google; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FACEBOOK USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_facebook" id="insta_company_facebook" value="<?php if(!empty($company_detail->insta_company_facebook)) echo $company_detail->insta_company_facebook; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LINKEDIN USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_linkedin" id="insta_company_linkedin" value="<?php if(!empty($company_detail->insta_company_linkedin)) echo $company_detail->insta_company_linkedin; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TWITTER USERNAME (OPTIONAL)
 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" name="insta_company_twitter" id="insta_company_twitter" value="<?php if(!empty($company_detail->insta_company_twitter)) echo $company_detail->insta_company_twitter; ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if(!empty($company_detail->insta_company_logo)) { ?>
                <img height="100" width="100" alt="" src="<?php echo COMPANY_LOGO_PATH.$company_detail->insta_company_logo; ?>">
                <?php }?>
                  <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_company_logo" id="insta_company_logo" placeholder="">
                   
                </div>
              </div>

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_company_status" required="required">
                   <option class="level-0" value="1" <?php if($company->insta_company_status == 1) { echo "selected='selected'";} ?>>Enable</option>
                   <option class="level-0" value="0" <?php if($company->insta_company_status == 0) { echo "selected='selected'"; } ?>>Disable</option>     
                </select>
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="insta_company_id" value="<?php echo $company->insta_company_id; ?>"/>
                
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
<?php } 
else if($type=="admin_users") { 
$admin_detail = $admin_detail[0];
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
            <h2>Update User<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" action="<?php echo base_url();  ?>admin/edit_details/admin_users" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_name" id="insta_admin_name" value="<?php if(!empty($admin_detail->insta_admin_name)) echo $admin_detail->insta_admin_name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email 
                <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" name="insta_admin_email" id="insta_admin_email" value="<?php if(!empty($admin_detail->insta_admin_email)) echo $admin_detail->insta_admin_email; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              
              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username
                <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_username" value="<?php if(!empty($admin_detail->insta_admin_username)) echo $admin_detail->insta_admin_username; ?>" id="insta_admin_username" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_admin_password" value="<?php if(!empty($admin_detail->insta_admin_password)) echo $admin_detail->insta_admin_password; ?>" id="insta_admin_password" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>

               <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type  <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_admin_type" required="required">
                    <option value="Super Administrator" <?php if(!empty($admin_detail->insta_admin_type) && $admin_detail->insta_admin_type == 'Super Administrator') echo "selected='selected'"; ?>>Super Administrator</option>
                    <option value="Administrator" <?php if(!empty($admin_detail->insta_admin_type) && $admin_detail->insta_admin_type == 'Administrator') echo "selected='selected'"; ?>>Administrator</option>
                    <option value="Manager" <?php if(!empty($admin_detail->insta_admin_type) && $admin_detail->insta_admin_type == 'Manager') echo "selected='selected'"; ?>>Manager</option>
                </select>
                
                </div>
              </div>

              

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status  <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              
                 <select class="form-control" name="insta_admin_status" required="required">
                    <option value="0" <?php if(!empty($admin_detail->insta_admin_status) && $admin_detail->insta_admin_status == 0) echo "selected='selected'"; ?>>Disable</option>
                    <option value="1" <?php if(!empty($admin_detail->insta_admin_status) && $admin_detail->insta_admin_status == 1) echo "selected='selected'"; ?>>Enable</option>
                </select>
                
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                 
                 <input type="hidden" name="insta_admin_id" value="<?php if(!empty($admin_detail->insta_admin_id)) echo $admin_detail->insta_admin_id; ?>">
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
<?php } 
else if($type=="article") { 
$article_detail = $article_detail[0];
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
            <h2>Update article <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form4" action="<?php echo base_url();  ?>admin/edit_details/article" data-parsley-validate class="form-horizontal form-label-left" method="post">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title<span class="required"> *</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="insta_article_title" id="insta_article_title" required="required" class="form-control col-md-7 col-xs-12"  value="<?php if(!empty($article_detail->insta_article_title)) echo $article_detail->insta_article_title; ?>">
                </div>
              </div>

              
              
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="insta_article_description" name="insta_article_description" required="required"><?php if(!empty($article_detail->insta_article_description)) echo $article_detail->insta_article_description; ?></textarea>
                </div>
              </div>

              

              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required"> *</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">              
                 <select class="form-control" name="insta_article_status" required="required">
                 <option value="1" <?php if($article_detail->insta_article_status == 1) { echo "selected"; } ?>>Enable</option>
                  <option value="0" <?php if($article_detail->insta_article_status == 0){ echo "selected"; } ?>>Disable</option>
                  
                 </select>                
                </div>
              </div>

              
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="insta_company_id"/>
                <input type="hidden" name="insta_article_id" value="<?php if(!empty($article_detail->insta_article_id)) { echo $article_detail->insta_article_id; } ?>">
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