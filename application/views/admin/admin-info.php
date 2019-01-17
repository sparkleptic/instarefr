 <?php
    if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    } else {
    header("location: login");
    }
?>
<!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="<?php echo ADMIN_IMAGE_PATH; ?>img.jpg" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $username; ?></h2>
      </div>
    </div>
<!-- /menu profile quick info -->