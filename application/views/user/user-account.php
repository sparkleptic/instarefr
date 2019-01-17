<!-- Current Page Info-->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>


<?php $jsonarray=  json_decode($jsonarray) ; //print_r($jsonarray); die; ?>
<!-- PERSONAL OPTIONS SECTION -->
<div id="personal-options" class="post-job">
    <div class="container">
    <?php $this->load->view('common/common-msg'); ?>
        <div class="row">

            <div id="content" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <!-- <h2 class="section-title page-heading">PERSONAL OPTIONS</h2>

                <span class="green-border"></span> -->
                 <div class="row ua-table-wrap">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs user-acc-tabs text-center">
                  <li><a class="transition" data-toggle="tab" href="#ua-reffered-job">Referred Job - <span><?php echo count($referred_jobs); ?></span></a></li>
                  <li><a class="transition" data-toggle="tab" href="#ua-applied-job">Applied Job - <?php echo count($applied_jobs); ?></a></li>
                  <li><a class="transition" href="<?php echo base_url(); ?>points_transaction/">Current Points - <span><?php echo $current_points; ?></span></a></li>
                </ul>

                <div class="tab-content">
                  <div id="ua-reffered-job" class="tab-pane fade">
                    <!-- Refer Tabel Heading -->
                    <?php if(!empty($referred_jobs)){ ?>
                    <div class="ua-refered-job-heading clearfix">
                      <div class="refer-col-1 fl-left refer-table-head">Candidate</div>
                      <div class="refer-col-2 fl-left refer-table-head text-center">Title</div>
                      <div class="refer-col-3 fl-left refer-table-head text-center">Posted By</div>
                      <div class="refer-col-4 fl-left refer-table-head text-center">Posted Date</div>
                      <div class="refer-col-5 fl-left refer-table-head text-center">Applied Date</div>
                      <div class="refer-col-6 fl-left refer-table-head text-center">Reffered Date</div>
                    </div>

                    <!-- Refer Tabel Content -->
                    <div class="ua-refered-job-table-contents">
                      <div class="refer-table-row">
                      <?php  //echo "<pre>"; print_r($referred_jobs);
                          foreach($referred_jobs as $val)
                          { ?>
                        <!-- Refer Tabel Row -->
                        <div class="refer-table-row-top refer-table-job clearfix">
                          <div class="refer-col-1 fl-left refer-table-cell"><?php echo $val['applied_user_name']; ?></div>

                          <div class="refer-col-2 fl-left refer-table-cell credit-color text-center"><?php echo '<a class="ua-job-item-link transition" href="'.base_url().'single-job/'.$val['insta_job_id'].'">'.$val['insta_job_title'].'<br>('.$val['insta_job_tags'].')</a>'; ?></div>

                          <div class="refer-col-3 fl-left refer-table-cell refer-and-date-color text-center"><a href="javascript:void(0);" class="ua-candidate-name transition"><?php echo $val['job_posted_by']; ?></a></div>

                          <div class="refer-col-4 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $val['insta_job_created_on']; ?></div>

                          <div class="refer-col-5 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $val['insta_job_apply_date']; ?></div>

                          <div class="refer-col-6 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $val['insta_job_refer_date']; ?></div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                                    
                  <div id="ua-applied-job" class="tab-pane fade">
                    <!-- Applied Tabel Heading -->
                    <?php if(!empty($applied_jobs)){ ?>
                    <div class="ua-applied-job-heading clearfix">
                      <div class="refer-col-1 fl-left refer-table-head">Title</div>
                      <div class="refer-col-2 fl-left refer-table-head text-center">Company</div>
                      <div class="refer-col-3 fl-left refer-table-head text-center">Applied Date</div>
                      <div class="refer-col-4 fl-left refer-table-head text-center">Reffered Date</div>
                      <div class="refer-col-5 fl-left refer-table-head text-center">Reffered By</div>
                    </div>

                    <!-- Applied Tabel Content -->
                    <div class="ua-applied-job-table-contents">
                      <div class="refer-table-row">
                        <!-- Applied Tabel Row -->
                        <?php  //echo "<pre>"; print_r($applied_jobs);
                          foreach($applied_jobs as $val)
                          { 
                            if($val['insta_job_apply_status']==0)
                            {
                               $status = "No";
                            }else{
                               $status = "Yes";
                            }     
                            ?>
                            <div class="refer-table-row-top refer-table-job clearfix">
                              <div class="refer-col-1 fl-left refer-table-cell"><?php echo '<a class="ua-job-item-link transition" href="'.base_url().'single-job/'.$val['insta_job_id'].'">'.$val['insta_job_title'].'<br>('.$val['insta_job_tags'].')</a>'; ?></div>
                              <div class="refer-col-2 fl-left refer-table-cell credit-color text-center"><?php echo '<a href="'.base_url().'company-jobs/'.$val['insta_company_id'].'/'.$val['insta_company_name'].'/">';
                                if(!empty($val->insta_company_logo))
                                {
                                  echo ' <img src="'.COMPANY_LOGO_PATH.''.$val['insta_company_logo'].'" height="100" width="100"></a>';
                                }else{
                                    echo $val['insta_company_name'].'</a>';
                                } ?></div>
                              <div class="refer-col-3 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $val['insta_job_apply_date']; ?></div> 
                              <div class="refer-col-4 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $val['insta_job_referred_date']; ?></div>
                              <div class="refer-col-5 fl-left refer-table-cell refer-and-date-color text-center"><?php echo $status; ?></div>
                            </div>
                        
                        <?php } ?>
                        
                        
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
                <!-- <div class="col-md-12 col-sm-12 col-xs-12 no-padding"> -->
                 <form id="job-form"  action="<?php echo base_url()."user/update/"; ?>update" enctype="multipart/form-data" method="post">
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <p>Picture</p>
                      <div class="clearfix">
                         
                          <div class="profile-pic">
                          <?php if(!empty($jsonarray->profile_pic)) { if(strpos($jsonarray->profile_pic, "https://") !== false) {
                              ?>
                           <img class="img-responsive" height="100" width="100" alt="" src="<?php echo $jsonarray->profile_pic; ?>"> <?php } else{ ?>
                           <img class="img-responsive" height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$jsonarray->profile_pic; ?>">
                           <?php } } ?>
                          </div>

                          <div class="profile-pic-wrap">
                            <div class="input clearfix">
                              <label class="input-file-label">
                                <?php if(!empty($jsonarray->profile_pic)) { echo  'Change Picture'; }else { echo 'Choose Picture'; } ?>
                              </label>
                              <div class="input-file-wrap">
                                <i class="fa fa-upload input-file-upload-icon"></i>
                                <input type="file" id="new_profile_pic" name="new_profile_pic">
                                <input type="hidden" id="profile_pic" name="profile_pic" value="<?php  if(!empty($jsonarray->profile_pic)) echo $jsonarray->profile_pic; ?>"/> 
                              </div>
                              <span id="profile-pic-filename"></span>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

               
                <div class="job-details-form">

                    

                        <!-- <div class="input clearfix"> -->
                           <!--  <label>Full Name</label> -->
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="hidden"  name="name" id="name" value="<?php //if(!empty($jsonarray->name)) echo $jsonarray->name; ?>"  required="required" />
                        <!-- </div> -->
                            
                        <div class="input clearfix">
                            <label>First Name</label>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="text" name="first_name" id="first_name" value="<?php if(!empty($jsonarray->first_name)) echo $jsonarray->first_name; ?>" required="required">
                        </div>

                        <div class="input clearfix">
                            <label>Last Name</label>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="text" name="last_name" id="last_name" value="<?php if(!empty($jsonarray->last_name)) echo $jsonarray->last_name; ?>" required="required">
                        </div>

                        <div class="input clearfix">
                            <label>Gender</label>
                            <div class="style-select">
                                <select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" name="gender" required="required">
                                    <option value="male" <?php if(!empty($jsonarray->gender) && $jsonarray->gender == 'male') echo 'selected="selected"'; ?>>Male</option>
                                    <option value="female" <?php if(!empty($jsonarray->gender) && $jsonarray->gender == 'female') echo 'selected="selected"'; ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="input clearfix">
                            <label>Email</label>
                            
                            <?php if(!empty($jsonarray->email)) { ?>
                              <input type="hidden"  class="regular-text"  id="email" name="email"  value="<?php echo $jsonarray->email; ?>"/>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="email"   value="<?php if(!empty($jsonarray->email)) echo $jsonarray->email; ?>" disabled="disabled" required="required">
                            <?php }else { ?>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" id="email" name="email" type="email"    required="required">
                            <?php } ?>
                        </div>

                        <div class="input clearfix">
                            <label>Phone</label>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="number" id="phone" name="phone" value="<?php if(!empty($jsonarray->phone)) echo $jsonarray->phone; ?>"  required="required">
                        </div>

                        <div class="input clearfix">
                            <label>Company</label>
                            <input autocomplete="off" class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" list="company_list" type="text" name="company" id="company" value="<?php if(!empty($jsonarray->company_name)) echo $jsonarray->company_name; ?>" required="required">
                            <datalist id="company_list">
                            <?php
                            foreach ($company_list as $val) {
                                 echo "<option value='".$val->insta_company_name."'>";
                              }
                            ?> 
                            </datalist>
                        </div>

                        <div class="input clearfix">
                            <label>Skills</label>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="text"  name="skills" id="skills" value="<?php if(!empty($jsonarray->skills)) echo $jsonarray->skills; ?>" required="required">
                            <p class="optional-desc">Comma seperated tags, such as required skills or technologies, for this job.</p>
                        </div>

                        
                        <?php if(!empty($jsonarray->experience)) {
                        $exp =  explode(".",$jsonarray->experience); ?>
                        <div class="input clearfix">
                            <label>Experience</label>
                            <div class="col-md-12 no-padding">
                               
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
                          <div class="input clearfix">
                            <label>Experience</label>
                            <div class="col-md-12 no-padding">
                               
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

                        <div class="input clearfix">
                            <label>Location</label>
                            <input class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" type="text"  name="location" id="location" value="<?php if(!empty($jsonarray->location)) echo $jsonarray->location; ?>" required="required">
                        </div>

                        <div class="input clearfix">

                            <?php if(!empty($jsonarray->resume)) { ?>
                              <a  href="<?php echo USER_UPLOAD_PATH.$jsonarray->resume; ?>" id="download_resume">Download resume</a>
                               <label class="input-file-label">Change Resume</label>
                               <div class="input-file-wrap">
                                <i class="fa fa-upload input-file-upload-icon"></i>
                                <input type="file" id="new_resume" name="new_resume">
                                <input type="hidden" id="resume" name="resume" value="<?php  echo $jsonarray->resume; ?>"/> 
                            </div> 
                            <span id="resume-filename"></span>                   
                            <?php }else{ ?>
                              <label class="input-file-label">Upload Resume</label>
                              <div class="input-file-wrap">
                                <i class="fa fa-upload input-file-upload-icon"></i>
                                <input type="file" id="new_resume" name="new_resume">
                                <input type="hidden" id="resume" name="resume" value="<?php  echo $jsonarray->resume; ?>"/> 
                            </div>
                            <span id="resume-filename">No file Chosen.</span>
                              <?php } ?>

                           
                            
                            
                        </div>

                        <div class="preview-div">
                        <input type="hidden" name="from" value="profile"/>
                        <input type="hidden" name="user_id" value="<?php echo $jsonarray->user_id; ?>"/>
                            <input class="preview-button" type="submit" value="UPDATE PROFILE"/>
                        </div>
                   
                </div>
                 </form>
            </div>
            <?php $this->load->view('common/inner-sidebar'); ?>
        </div>
    </div>
</div>
<script type="text/javascript">

  
  // When the browser is ready...
  $(function() {
    
    $("#job-form").validate({
    
        // Specify the validation rules
        rules: {
            name: "required",
            first_name: "required",            
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            first_name: "Please enter your first name"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Setup form validation on the #register-form element
    $("#job-form").validate({
        // Specify the validation rules
        rules: {
            name: "required",
            first_name: "required",
            email: {
                required: true,
                email: true
            },
            last_name: "required",
            gender: "required",
            phone: {
               matches: "[0-9]+",  // <-- no such method called "matches"!
               minlength:10
            },
            company: "required",
            
            skills: "required",
            location: "required",

            new_profile_pic :  {
               
                extension: "jpg|jpeg|png|gif"
            },
            new_resume :  {
                extension: "xls|csv|odt|doc|docx|rtf"
            }
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your full name",
            first_name: "Please enter your first name",
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            last_name: "Please enter your first name",
            gender: "Please enter your gender",
            phone: "Please enter your valid 10 digit phone number",
            company: "Please enter your company Name",
            skills: "Please enter your job skills",
            location: "Please enter your location",
            new_profile_pic : "you can upload image type jpeg,jpg,png and gif",
            new_resume: "File type is not correct(docx,rtf,doc,pdf and odt types are allowed only)"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>  
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

    function show_table(table_id)
    {
      $("#"+table_id).toggle();
    }

  $('#new_resume,#new_profile_pic').change(function(){
      var fullPath = $(this).val();
      var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
      var filename = fullPath.substring(startIndex);
      if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
          filename = filename.substring(1);
      }
      if( $(this).attr('id') == 'new_resume' ){
        $('#resume-filename').text(filename);
      }else{
        $('#profile-pic-filename').text(filename);
      }
  });
</script>