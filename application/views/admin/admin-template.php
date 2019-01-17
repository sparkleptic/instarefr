 <?php error_reporting(0);  error_reporting(E_ALL); ?>
<!-- header -->
<?php $this->load->view('admin/admin-header'); ?>
<!-- /header -->

<!-- main container -->
<?php $this->load->view('admin/'.$main_content); ?>
<!-- /main container -->

<!-- Footer -->
<?php $this->load->view('admin/admin-footer'); ?>
<!-- /Footer -->
