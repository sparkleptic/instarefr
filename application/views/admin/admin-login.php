<!DOCTYPE html>
<html lang="en">
<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: ".base_url()."admin/admin_login/");
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instarefr | Admin </title>

    <!-- Bootstrap -->
    <link href="<?php echo ADMIN_ASSET; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ADMIN_ASSET; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo ADMIN_ASSET; ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo ADMIN_ASSET; ?>vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_ASSET; ?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo base_url(); ?>admin/admin_login" method="post">
              <h1>Login Form</h1>
              <?php
                echo "<div class='error_msg' style='color:red;'>";
                if (isset($error_message)) {
                echo $error_message;
                }
                echo validation_errors();
                echo "</div><br>";
              ?>
              <?php
                if (isset($logout_message)) {
                  echo "<div class='message'>";
                  echo $logout_message;
                  echo "</div><br>";
                }
                ?>
                <?php
                if (isset($message_display)) {
                  echo "<div class='message'>";
                  echo $message_display;
                  echo "</div><br>";
                }
              ?>
              <div>
                <input type="text" class="form-control" placeholder="Username"  name="username" id="name" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password"  name="password" id="password" required="" />
              </div>
              <div>
              <input class="btn btn-default submit" type="submit" value=" Login " name="submit"/>
                
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>


              <div class="separator">
                

                <div class="clearfix"></div>
                <br>

                <div>
                  <h1><i class="fa fa-paw"></i> Instarefr!</h1>
                  <!-- <p>&copy;2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p> -->
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
