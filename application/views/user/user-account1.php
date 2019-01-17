<?php $jsonarray=  json_decode($jsonarray) ; //print_r($jsonarray); die; ?>
<?php echo validation_errors(); ?>  
<style>
.error{
  color:red;
}
</style>
<div class="tml tml-profile" id="theme-my-login">
 <h3>My Account</h3>
  Current Points : <a href="<?php echo base_url(); ?>points/"><?php echo $current_points; ?></a>
  Applied Jobs : <a href="#" onclick="show_table('applied_jobs')"><?php echo count($applied_jobs); ?></a>
  
   <table class="table" id="applied_jobs" style="display:none;">
<?php  if(!empty($applied_jobs)){ ?>
    <tr>
      <td>Job Title</td>
      <td>Company</td>
      <td>Applied Date</td>
      <td>Referred</td>
      
    </tr>
 
  
   <?php 
    foreach($applied_jobs as $val)
    {
      if($val['insta_job_apply_status']==0)
      {
         $status = "No";
      }else{
         $status = "Yes";
      }
     echo '<tr>
           
            <td><a href="'.base_url().'single-job/'.$val['insta_job_id'].'">'.$val['insta_job_title'].'<br>('.$val['insta_job_tags'].')</a></td>
            <td><a href="'.base_url().'company-jobs/'.$val['insta_company_id'].'/'.$val['insta_company_name'].'/">';
            if(!empty($val->insta_company_logo))
            {
              echo ' <img src="'.COMPANY_LOGO_PATH.''.$val['insta_company_logo'].'" height="100" width="100">';
            }else{
                echo $val['insta_company_name'];
            }
           echo '</td><td>'.$val['insta_job_apply_date'].'</td>
            <td>'.$status.'</td>';
         } 
      
  ?>
<?php }//else { echo "<tr>Not available</tr>"; } ?>
</table>

Referred Jobs : <a href="#" onclick="show_table('referred_jobs')"><?php echo count($referred_jobs); ?></a>

 <table class="table" id="referred_jobs" style="display:none;">
 <?php if(!empty($referred_jobs)){ ?>
    <tr>
      <td>User Name</td>
      <td>Job</td>
      <td>Posted BY</td>
      <td>Posted on</td>
       <td>Applied on</td>
       <td>Referred on</td>
    </tr>
 
  
   <?php  
    foreach($referred_jobs as $val)
    {
     
     echo '<tr>
           <td><a href="'.base_url().'candidate-detail/'.$val['applied_user_id'].'/">'.$val['applied_user_id'].'</a></td>
            <td><a href="'.base_url().'single-job/'.$val['insta_job_id'].'">'.$val['insta_job_title'].'<br>('.$val['insta_job_tags'].')</a></td>
            <td><a href="'.base_url().'candidate-detail/'.$val['job_posted_by_user_id'].'/">'.$val['job_posted_by'].'</a></td><td>'.$val['insta_job_created_on'].'</td><td>'.$val['insta_job_apply_date'].'</td><td>'.$val['insta_job_refer_date'].'</td></tr>';
           
          
         } 
      
   ?>
<?php }//else { echo "<tr>Not available</tr>"; } ?>
</table>
   <form id="your-profile" action="<?php echo base_url()."user/update/"; ?>update" enctype="multipart/form-data" method="post">
      <p>
         <input type="hidden" name="from" value="profile"/>
         <input type="hidden" name="user_id" value="<?php echo $jsonarray->user_id; ?>"/>
      </p>
      <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
      
     <!--  <div class=""><a href="<?php //echo base_url(); ?>logout" class=""><span>Logout</span></a></div> -->
     


      <table class="tml-form-table">
         <tr class="tml-user-login-wrap">
            <th><label for="user_login">Full Name <span class="description">(required)</span</label></th>
            <td><input type="text" name="name" id="name" value="<?php if(!empty($jsonarray->name)) echo $jsonarray->name; ?>" class="regular-text" required/> </td>
         </tr>
         <tr class="tml-first-name-wrap">
            <th><label for="first_name">First Name <span class="description">(required)</span</label></th>
            <td><input type="text" name="first_name" id="first_name" value="<?php if(!empty($jsonarray->first_name)) echo $jsonarray->first_name; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-last-name-wrap">
            <th><label for="last_name">Last Name <span class="description">(required)</span</label></th>
            <td><input type="text" name="last_name" id="last_name" value="<?php if(!empty($jsonarray->last_name)) echo $jsonarray->last_name; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Change Picture <span class="description"></span></label></th>
            <td>
               <?php if(!empty($jsonarray->profile_pic)) { if(strpos($jsonarray->profile_pic, "https://") !== false) {
                  ?>
               <img height="100" width="100" alt="" src="<?php echo $jsonarray->profile_pic; ?>"> <?php } else{ ?>
               <img height="100" width="100" alt="" src="<?php echo USER_UPLOAD_PATH.$jsonarray->profile_pic; ?>">
               <?php } } ?>
               <input type = "file" id="new_profile_pic" name="new_profile_pic"/> 
               <input type = "hidden" id="profile_pic" name="profile_pic" value="<?php  if(!empty($jsonarray->profile_pic)) echo $jsonarray->profile_pic; ?>"/> 
            </td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Email <span class="description">(required)</span></label></th>
            <td>
               <?php if(!empty($jsonarray->email)) { ?>
               <input type="hidden"  class="regular-text"  id="email" name="email"  value="<?php echo $jsonarray->email; ?>"/>
               <input type="email" value="<?php echo $jsonarray->email; ?>" class="regular-text"  disabled="disabled" required/><span class="description">Email cannot be changed.</span>
               <?php }else{ ?>
               <input type="email" id="email" name="email"  class="regular-text"  required/><span class="description">Email cannot be changed.</span>
               <?php } ?>
            </td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Gender <span class="description">(required)</span</label></th>
            <td><input type="text" name="gender" id="gender" value="<?php if(!empty($jsonarray->gender)) echo $jsonarray->gender; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Phone <span class="description">(required)</span></label></th>
            <td><input type="text" name="phone" id="phone" value="<?php if(!empty($jsonarray->phone)) echo $jsonarray->phone; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Company <span class="description">(required)</span></label></th>
            <td><input list="company_list" type="text" name="company" id="company" value="<?php if(!empty($jsonarray->company_name)) echo $jsonarray->company_name; ?>" class="regular-text" autocomplete="off" required/>
               <datalist id="company_list">
                <?php
                foreach ($company_list as $val) {
                     echo "<option value='".$val->insta_company_name."'>";
                  }
                ?> 
            
         </td></tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Skills <span class="description">(required)</span></label></th>
            <td><input type="text" name="skills" id="skills" value="<?php if(!empty($jsonarray->skills)) echo $jsonarray->skills; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Experience <span class="description">(required)</span></label></th>
            <?php if(!empty($jsonarray->experience)) {
                 $exp =  explode(".",$jsonarray->experience); ?>
              
            <td>Monthfs<input type="number" min="0" max="11" step="1" name="exp_month" value="<?php echo $exp[1]; ?>" required>
                Year<input type="number" min="0" max="50" step="1" name="exp_year" value="<?php echo $exp[0]; ?>" required>
            </td>
             <?php }else{ ?>
            <td>Month<input type="number" min="0" max="11" step="1" name="exp_month" value="0" required>
                Year<input type="number" min="0" max="50" step="1" name="exp_year" value="0" required>
            </td>
            <?php } ?>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Location <span class="description">(required)</span></label></th>
            <td><input type="text" name="location" id="location" value="<?php if(!empty($jsonarray->location)) echo $jsonarray->location; ?>" class="regular-text" required/></td>
         </tr>
         <tr class="tml-nickname-wrap">
            <th><label for="nickname">Upload Resume <span class="description">(required)</span</label></th>
            <td>
               <?php if(!empty($jsonarray->resume)) { ?>
               <a  href="<?php echo USER_UPLOAD_PATH.$jsonarray->resume; ?>" id="download_resume">Download resume</a>
               <?php } ?>
               <input type = "file" id="new_resume" name="new_resume"> 
               <input type = "hidden" id="resume" name="resume" value="<?php  echo $jsonarray->resume; ?>"/> 
            </td>
         </tr>
         <!-- <tr class="tml-nickname-wrap">
            <th><label for="nickname">Why should you get referred <span class="description">(required)</span</label></th>
            <td>
              
               <textarea cols="150" rows="3" class="input-text" name="why_you_get_refer" id="why_you_get_refer" placeholder="Please talk about your relevant experience and skill as per job description" maxlength="" required=""><?php //if(!empty($jsonarray->why_you_get_refer)) echo $jsonarray->why_you_get_refer; ?></textarea>
            </td>
         </tr> -->

         
      </table>
      <p class="tml-submit-wrap">
         <input type="submit" class="button-primary" value="Update Profile" name="submit" id="submit"/>
      </p>
   </form>
</div>
<script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#your-profile").validate({
    
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
</script>