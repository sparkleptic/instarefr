<?php
//print_r($this->session->flashdata());
 if($this->session->flashdata('success') != null) {  ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
</div>
<?php }else if($this->session->flashdata('info') != null) { ?>
<div class="alert alert-info alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
</div>
<?php }else if($this->session->flashdata('warning') != null) { ?>
<div class="alert alert-warning alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
</div>
<?php }else if($this->session->flashdata('error') != null) { ?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger!</strong> <?php echo $this->session->flashdata('error'); ?>
</div>
<?php } ?>


