 <?php
    if (!empty($this->session->userdata['logged_in'])) {
    $data['username'] = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    } else { 
    redirect(base_url()."admin/logout");
    }
?>
<!-- menu profile quick info -->
<?php $this->load->view('admin/admin-head'); ?>
<!-- /menu profile quick info -->

  <body class="nav-md">
   <div class="container body">
      <div class="main_container">
      <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Instarefr!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php $this->load->view('admin/admin-info'); ?>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('admin/admin-sidebar'); ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('admin/admin-top-navigation'); ?>
        <!-- /top navigation -->

        