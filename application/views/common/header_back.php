<?php
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));
$this->session->set_userdata('current_url', current_url());
if(!empty($this->session->my_current_location))
{
  $current_url = $this->session->my_current_location;
}
else
{
  $this->session->unset_userdata('my_current_location');
  $current_url = "";
}
if(empty($this->session->facebook_login_url) && empty($this->session->google_login_url) && empty($this->session->user_session['user_id']))
{
   redirect(base_url().'home/set_login_url');
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Instarefer</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Expires" content="30" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />      
      <meta property="og:url"                content="<?php echo base_url(); ?>" />
      <meta property="og:type"               content="<?php echo 'Find Job and get referral'; ?>" />
      <meta property="og:title"              content="<?php echo 'Instarefr'; ?>" />
      <meta property="og:description"        content="<?php echo 'Find Job and get referral, Post Job and refer candidate';; ?>" />
      <meta property="og:image"              content="<?php echo IMAGE_PATH; ?>header-slider-bg.jpg" />      
      <!-- Twitter Summary card images must be at least 120x120px -->
      <meta name="twitter:image" content="<?php echo IMAGE_PATH; ?>header-slider-bg.jpg">
      

      <link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>owl.carousel.css" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>owl.theme.css" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>owl.transitions.css" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>custom-style.css" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>responsive.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo CSS_PATH; ?>jquery-ui.css" />
      <link href="<?php echo CSS_PATH; ?>dcalendar.picker.css" rel="stylesheet">
      <link href="<?php echo CSS_PATH; ?>dcalendar.picker.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">      
      
      <script src="<?php echo JS_PATH; ?>jquery.min.js"></script>
      <script src="<?php echo JS_PATH; ?>jquery-ui.min.js"></script>     
      <!-- ___________ Base Script____________ -->
      
      <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
         
         ga('create', 'UA-85744067-1', 'auto');
         ga('send', 'pageview');

         

         function close_login_box()
         {
            $('#login_msg').html('Login <span>or</span> Signup  <span>with</span>');
            document.getElementById('id01').style.display='none';
           <?php $this->session->set_userdata('current_url', current_url()); ?>
         }

      </script>
     
      <script>
          function getLocation() {
              if (navigator.geolocation) {
                  navigator.geolocation.getCurrentPosition(showPosition);
              } else { 
                 // x.innerHTML = "Geolocation is not supported by this browser.";
              }
          }

          function showPosition(position) {
              $.ajax({
                  type:'POST',
                  url:'<?php echo base_url('home/get_location');?>',
                  data:'latitude='+position.coords.latitude+'&longitude='+position.coords.longitude,
                  success:function(msg){
                   // console.log(msg);
                    $("#locationKeyword").html(msg); 
                  }
              });
          }
          var current_location = "<?php echo $current_url; ?>";
          if(!current_location)
          {
            getLocation(); 
          }
        </script>
      
   </head>
   <body class="<?php if(!empty($this->uri->segment(1))) { echo $this->uri->segment(1); }else { echo "home"; } if(isset($this->session->user_session)) {  echo ' logged-in';  }?>">



       <div id="id01" class="modal">
         <form class="modal-content signup-model-content animate" action="action_page.php">

            <div class="imgcontainer">
              <span onclick="close_login_box()" class="close" title="Close Modal">×</span>
            </div>

            <div class="modal-container text-center">
              <h4 class="section-title" id="login_msg">Login 
                <span>or</span> Signup 
                <span>with</span>
              </h4>
              <span class="green-border span-expert expert-span"></span>

               <div class="SocialLogin">
                  <div class="social-logincont social-signup-icon-fb text-center">
<a href="<?php echo $this->session->facebook_login_url; ?>"><img alt="facebook signup" src="<?php echo base_url() ?>assets/images/facebook.png"/></a></div>
                 <div class="social-logincont social-signup-icon-gl text-center">

<a href="<?php echo $this->session->google_login_url; ?>"><img alt="google signup" src="<?php echo base_url() ?>assets/images/google.png"/></a></div>
                  <!-- <div class="social-logincont"><a href="<?php //echo $twitter; ?>"><img alt="twitter signup" src="<?php //echo base_url() ?>assets/images/twitter.png"/></a></div> -->
                  <div class="social-logincont social-signup-icon-lk text-center">

<a href="<?php echo base_url()?>index.php/user/link/"><img alt="linkedin signup" src="<?php echo base_url() ?>assets/images/linkedin-login.png"/></a></div>
               </div>
            </div>
         </form>
      </div>
      <?php  $current_url =  base_url(uri_string()); 
      // strpos($current_url, base_url().'/home'); 
      $base_url = base_url(); 
      if ($current_url!=$base_url && $current_url!=$base_url.'/' && strpos($current_url, '/home') === false) {  ?>
         <header class="header">
            <div class="navbar custom-navbar clearfix find-job-navbar">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="clearfix">
                        <a class="navbar-brand" href="<?php echo base_url().'home'; ?>">
                            <img class="img-responsive"  src="<?php echo IMAGE_PATH; ?>InstaRefr.png" alt="Instarefr Logo"/>
                        </a>
                        <ul class=" right-menu pull-right"  id="web-menu">
                            <li class="disp menu-item">
                               <a class="header-menu-link <?php if($this->uri->segment(1)=="find-a-job" || $this->uri->segment(1)=="job"){echo "active";}?>" href="<?php echo base_url().'find-a-job/'; ?>">Find Job</a>
                            </li>
                             <li class="menu-item disp trans">
                                <a class="header-menu-link <?php if($this->uri->segment(1)=="company"){echo "active";}?>" href="<?php echo base_url().'company/'; ?>">Companies</a>
                            </li>
                             <li class="menu-item disp trans">
                              <a class="header-menu-link <?php if($this->uri->segment(1)=="post-a-job"){echo "active";}?>" href="<?php echo base_url(); ?>post-a-job/">Post Job</a>
                           </li>
                            <li class="menu-item disp trans">
                              <a class="header-menu-link <?php if($this->uri->segment(1)=="points"){echo "active";}?>" href="<?php echo base_url().'points/'; ?>">Points</a>
                           </li>
                            <?php
                           if (!empty($this->session->user_session)) { ?>
                    
                    
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link <?php if($this->uri->segment(1)=="refer-and-earn"){echo "active";}?>" href="<?php echo base_url().'refer-and-earn/'; ?>">Refer Earn</a>
                     </li>
                     

                     <li class="menu-item disp trans">
                        <a class="header-menu-link <?php if($this->uri->segment(1)=="user"){echo "active";}?>" href="<?php echo base_url().'user/dashboard/'; ?>">My Account</a>
                     </li>

                     <?php } ?>
                           
                            
                            <li class="menu-item disp" id="menu-item5">
                                <?php
                                 if (!empty($this->session->user_session)) { ?>
                              <a class="login trans"  href="<?php echo base_url(); ?>logout"> Logout</a>
                              <?php }else{?>
                              <a class="login trans" href="#" onclick="document.getElementById('id01').style.display='block'"> Login</a><a class="signup trans" href="#" onclick="document.getElementById('id01').style.display='block'">Signup</a>
                              <?php }
                                 ?>
                            </li>
                            <li class="toggle-wrap">
                                <a class="menu-toggle" href="#"><span>Menu</span></a>
                            </li>
                        </ul>
                                <div id="menu-nav-wrap">
                                    <h3>Navigation</h3>     
                                    <ul class="nav-list" id="mob-menu">
                                        <li class="disp menu-item">
                                <a class="header-menu-link active" href="<?php echo base_url().'find-a-job/'; ?>">Find Job</a>
                            </li>
                             <li class="menu-item disp trans">
                                <a class="header-menu-link" href="<?php echo base_url().'company/'; ?>">Companies</a>
                            </li>
                             <li class="menu-item disp trans">
                              <a class="header-menu-link" href="<?php echo base_url(); ?>post-a-job/">Post Job</a>
                           </li>
                            <li class="menu-item disp trans">
                              <a class="header-menu-link" href="<?php echo base_url().'points/'; ?>">Points</a>
                           </li>
                            <?php
                           if (!empty($this->session->user_session)) { ?>
                    
                    
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'refer-and-earn/'; ?>">Refer Earn</a>
                     </li>
                     

                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'user/dashboard/'; ?>">My Account</a>
                     </li>

                     <?php } ?>
                           
                            
                            <li class="menu-item disp" id="menu-item5">
                                <?php
                                 if (!empty($this->session->user_session)) { ?>
                              <a class="login trans"  href="<?php echo base_url(); ?>logout"> Logout</a>
                              <?php }else{?>
                              <a class="login trans" href="#" onclick="document.getElementById('id01').style.display='block'"> Login</a><a class="signup trans" href="#" onclick="document.getElementById('id01').style.display='block'">Signup</a>
                              <?php }
                                 ?>
                            </li>

                                    </ul>
                                </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </header>
    <?php  }else { ?>
     <header class="header">
      <div id="header-slider" class="header-slider">
         <div id="owl-demo" class="owl-carousel owl-theme">
            
            <div class="item">
              <img class="img-responsive" src="<?php echo IMAGE_PATH; ?>header-slider-bg.jpg" alt="Header Background">
              <div class="header-slide-content">
                  <h3 class="header-slide-title">POST JOB AND GET REFERRAL</h3>
                  <p class="header-slide-desc">Get your referral bonus today by referring in your company</p>
                  <a href="<?php echo base_url().'refer-and-earn/'; ?>" class="header-slide-link trans">REFER AND EARN</a>
              </div>
            </div>

            <div class="item">
              <img alt="The Last of us" src="<?php echo IMAGE_PATH; ?>instarefer-slide-2.png">
              <div class="header-slide-content">
                  <h1 class="header-slide-title">GETTING REFERRED IS NOW EASY</h1>
                  <p class="header-slide-desc">Apply for unlimited openings and get reffered directly in the companies</p>
                  <a id="" class="header-slide-link trans" href="<?php echo base_url().'find-a-job/'; ?>">Get Referral</a>
              </div>              
            </div>

         </div>
      </div>   
         <div class="navbar custom-navbar absolute-pos clearfix">
            <div class="container">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="heder-top-wrap clearfix">
                  <a class="navbar-brand" href="<?php echo base_url()?>">
                     <img class="img-responsive"  src="<?php echo IMAGE_PATH; ?>InstaRefr.png" alt="Instarefr Logo"/>
                  </a>
                  <ul class=" right-menu pull-right" id="web-menu">
                     <li class="disp menu-item">
                        <a class="header-menu-link active" href="<?php echo base_url().'find-a-job/'; ?>">Find Job</a>
                     </li>
                      <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url(); ?>company/">Companies</a>
                     </li>
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url(); ?>post-a-job/">Post Job</a>
                     </li>
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'points/'; ?>">Points</a>
                     </li>
                     <?php
                           if (!empty($this->session->user_session)) { ?>
                     
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'refer-and-earn/'; ?>">Refer Earn</a>
                     </li>
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'user/dashboard/'; ?>">My Account</a>
                     </li>

                     <?php } ?>
                     <li class="menu-item disp" id="menu-item5">
                     <?php
                           if (!empty($this->session->user_session)) { ?>
                        <a class="login trans"  href="<?php echo base_url(); ?>logout"> Logout</a>
                        <?php }else{?>
                        <a class="login trans" href="#" onclick="document.getElementById('id01').style.display='block'"> Login</a><a class="signup trans" href="#" onclick="document.getElementById('id01').style.display='block'">Signup</a>
                        <?php }
                           ?>
                       
                     </li>
                     <li class="toggle-wrap">
                        <a class="menu-toggle" href="#"><span>Menu</span></a>
                        
                     </li>
                  </ul>
                  <div id="menu-nav-wrap">
                           <h3>Navigation</h3>     
                           <ul class="nav-list" id="mob-menu">
                                <li class="disp menu-item">
                        <a class="header-menu-link active" href="<?php echo base_url().'find-a-job/'; ?>">Find Job</a>
                     </li>
                      <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url(); ?>company/">Companies</a>
                     </li>
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url(); ?>post-a-job/">Post Job</a>
                     </li>
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'points/'; ?>">Points</a>
                     </li>
                     <?php
                           if (!empty($this->session->user_session)) { ?>
                     
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'refer-and-earn/'; ?>">Refer Earn</a>
                     </li>
                    
                     <li class="menu-item disp trans">
                        <a class="header-menu-link" href="<?php echo base_url().'user/dashboard/'; ?>">My Account</a>
                     </li>

                     <?php } ?>
                     <li class="menu-item disp" id="menu-item5">
                     <?php
                           if (!empty($this->session->user_session)) { ?>
                        <a class="login trans"  href="<?php echo base_url(); ?>logout"> Logout</a>
                        <?php }else{?>
                        <a class="login trans" href="#" onclick="document.getElementById('id01').style.display='block'"> Login</a><a class="signup trans" href="#" onclick="document.getElementById('id01').style.display='block'">Signup</a>
                        <?php }
                           ?>
                       
                     </li>

                           </ul>
                        </div>
               </div>
            </div><!-- /.container-fluid -->
         </div>
        <form id="header-form" action = "<?php echo base_url(); ?>job/filter_job/" method="get" autocomplete="off">
            <div class="container">
                <div class="row">
                  <ul class="col-md-offset-1 col-md-10" id="header-form-ul">
                    <li>
                       <div class="form-group has-feedback col-md-5">
                            <img src="<?php echo IMAGE_PATH; ?>job-title-icon.png" alt="job-title" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                            <input list="title_company_skills" type="text" class="form-control find-job-input find-job-input-text input-left-radius" id="jobKeyword" onkeyup="doSearch('title_company_skills');" name="title_company_skills" placeholder="Job Title, Company, Tags" autocomplete="off"/>
                            <div id="test"></div>
                           
                       </div>
                    </li>

                    <li>
                       <div class="form-group has-feedback col-md-5 col-sm-9">
                           <img src="<?php echo IMAGE_PATH; ?>place-icon.png" alt="job-location" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                                <input list="location" type="text" name="location"  class="form-control find-job-input find-job-input-text" id="locationKeyword"  placeholder="City, State or Zip" onkeyup="doSearch('location');" autocomplete="off" value="<?php if(!empty($location)) { echo $location; } else if(!empty($this->session->my_current_location)) { echo $this->session->my_current_location; }  ?>"/>
                                <div id="test1"></div>
                                
                       </div>
                    </li>
                    <li>
                         <div class="form-group has-feedback col-md-2 col-sm-3">
                             <input  type="submit" name="title_company_skills_submit" id="find-job-btn" type="submit" class="form-control trans" value="FIND JOB"  />
                             <i class="header-form-submit-icon glyphicon glyphicon-search form-control-feedback"></i>
                         </div>
                    </li>
                  </ul>
              </div>
            </div>
        </form>
          <?php //echo $experience; die; ?>
      </header>
      <script>
         // Get the modal
         var modal = document.getElementById('id01');
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
             if (event.target == modal) {
                 modal.style.display = "none";
             }
         }
           
      </script>
      
      <?php }    ?>


      <div class="apply-job-container">
        <div class="apply-job">
          <div class="pos-relative">
            <i class="fa fa-close close-apply-popup"></i>
          </div>
          <div class="apply-job-top">
            <p class="d-inline-block">Please update your resume before apply for any job?</p>
            <a class="trans apply-job-update d-inline-block" href="<?php echo base_url(); ?>/user/dashboard/" title="update">UPDATE</a>
          </div>
          <div class="apply-job-form">
            <div class="text-center">
              <h3 class="section-title">Apply for job</h3>
              <span class="green-border"></span>
            </div>

            <form method="post" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>job/add_apply_job/">

             <input class="col-md-12 col-sm-12 col-xs-12" type="hidden" name="insta_job_apply_message" id="insta_job_apply_message" placeholder="Your cover letter/message sent to the employer" required>

              <div class="input-wrap clearfix">
                <label>Why should you get referred</label>
                <input class="col-md-12 col-sm-12 col-xs-12" type="text" name="insta_job_apply_why_get_refer" id="insta_job_apply_why_get_refer" placeholder="Please talk about your relevant experience and skill as per job description" required>
              </div>

              <div class="text-center">
                <input type="hidden" id="insta_job_id" value="" name="insta_job_id">
                <input type="hidden" value="0" name="insta_job_apply_status">
                <input type="hidden" id="insta_user_id" value="<?php echo $this->session->user_session['user_id']; ?>" name="insta_user_id">
                <input class="recent-news-articles-link trans" type="submit" value="SEND APPLICATION">
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php 
      if($this->session->flashdata('login_msg') == 'Login Request') 
      {
        if($this->session->flashdata('next_redirect') != null)
        {
          $this->session->set_userdata('current_url', $this->session->flashdata('next_redirect'));
        }
      ?>
          <script>
            $('#login_msg').html('<span>Please Login first</span>');
            document.getElementById('id01').style.display='block';
          </script>
      <?php } ?>

     

      

        