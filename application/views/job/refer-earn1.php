<div id="primary" class="content-area container" role="main">
   <div class="row">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
         <article id="post-3376" class="post-3376 page type-page status-publish hentry">
            <div class="entry-content">
               <div id="main" class="site-main">

   <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>

    <header class="page-header">
        <h2 class="page-title">Refer and earn</h2>
    </header>

    <div id="primary" class="content-area container" role="main">
        
        
<article id="post-1931" class="post-1931 page type-page status-publish hentry">
    <div class="entry-content">
        <!-- Error, Ad is not available at this time due to schedule/geolocation restrictions! -->
<div id="job-manager-job-dashboard">
   <p>Your listings are shown in the table below.</p>
 <table class="table" id="refer-table">
  <thead>
    <tr>
      <th>TITLE</th>
      <th>Company Logo</th>
      <th>Location</th>
      <th>STATUS</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
   <?php if(!empty($job_list)){
    foreach($job_list as $val)
    {
      if($val->insta_job_status==0)
      {
         $status = "Inactive";
      }else{
         $status = "Active";
      }
     echo '<tr>
            
            <td><a href="'.base_url().'single-job/'.$val->insta_job_id.'/">'.$val->insta_job_title.'</a><br>('.$val->insta_job_tags.')</td>
            <td>';
            if(!empty($val->insta_company_logo))
            {
              echo ' <img src="'.COMPANY_LOGO_PATH.''.$val->insta_company_logo.'" height="100" width="100">';
            }else{
                echo $val->company;
            }
           

            echo '</td>
            <td>'.$val->insta_job_location.'</td>
            <td>'.$val->insta_job_created_on.'<br> by <a href="'.base_url().'candidate-detail/'.$val->insta_user_id.'/">'.$val->user.'</a></td>
            <td>'.$val->insta_job_closing_date.'</td>';
            if(!empty($val->apply_users))
            {
               echo   '<td><button onclick="show_users_row('.$val->insta_job_id.')">'.count($val->apply_users).'</button></td>';
               $apply_user_table = "";
               $apply_user_table = '</tr><tr id="'.$val->insta_job_id.'" class="user-row" style="display:none;">';
               foreach($val->apply_users as $users)
               {
                   $apply_user_table .= '
                   <td><a href="'.base_url().'candidate-detail/'.$users->insta_user_id.'/">'.$users->apply_user_name.'</a><br>'.$users->apply_user_email.'</td>
                    <td>';
                   if(!empty($users->apply_user_profile_pic)) {
                    $apply_user_table .= '<img src="'.USER_UPLOAD_PATH.''.$users->apply_user_profile_pic.'" height="100" width="100">';
                  }

                   $apply_user_table .= '</td><td>'.$val->insta_job_title.'<br>('.$val->insta_job_tags.')</td><td>';
                   if(!empty($users->apply_user_resume)) {
                    $apply_user_table .= '<a href="'.USER_UPLOAD_PATH.''.$users->apply_user_resume.'">Resume</a>';
                  }

                   $apply_user_table .= '</td>
                  <td>'.$val->insta_job_created_on.'<br> by <a href="'.base_url().'candidate-detail/'.$val->insta_user_id.'">'.$val->user.'</a></td>
                  <td><a href="'.base_url().'refer_candidate/'.$users->insta_job_apply_id.'/" onclick="return refer_confirm();">Refer</a></td>
                   ';
               }
              $apply_user_table .= "</tr>";
            }else{ 
              $apply_user_table = "</tr>";
              echo   '<td><a href="#">0</a></td>';
            }

          echo $apply_user_table;
            
            
            //echo "</tr><tr>".$apply_user_table."</tr>";
         } }
   ?>
  </tbody>
</table>
   </div>

    </div>
</article><!-- #post -->

            </div><!-- #primary -->

    

      </div>               
                 
            </div>
         </article>
         <!-- #post -->
      </div>
   </div>
</div>
<script>
function show_users_row(id)
{
  $('#refer-table #'+id).toggle();
}
function refer_confirm()
{
  
  refer=confirm("Do you want to refer this user?");
  console.log(refer);
  if(refer!=true)
  {
      return false;
  }
}

</script>