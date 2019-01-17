<div id="container" class="container">
    <h1><?php echo $page_title; ?></h1>
    <div class="content">
    <p><?php echo $page_description; ?></p>
        <div class="SocialLogin">
            <div class="social-logincont"><a href="<?php echo $login_url; ?>"><img src="<?php echo base_url() ?>assets/images/facebook.png"/></a></div>
            <div class="social-logincont"><a href="<?php echo $googlelogin; ?>"><img src="<?php echo base_url() ?>assets/images/google.png"/></a></div>
            <!-- <div class="social-logincont"><a href="<?php //echo $twitter; ?>"><img src="<?php //echo base_url() ?>assets/images/twitter.png"/></a></div> -->
            <div class="social-logincont"><a href="<?php echo base_url()?>index.php/login/link/"><img src="<?php echo base_url() ?>assets/images/linkedin.png"/></a></div>
        </div>
    </div>
</div>
   