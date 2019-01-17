
<div class="right_col" role="main">
<?php if($type == "candidate-points-transaction") { //echo "<pre>"; print_r($candidate_detail[0]->user_meta); die; ?>
    <div class="">
    <div class="page-title">
      

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <?php $this->load->view('common/common-msg'); ?>
          <div class="x_title">
            <h2>Update User Points <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="<?php  echo base_url().'admin/add_candidate_points/';  ?>">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Candidate Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" placeholder="Candidate Name" name="insta_candidate_name" id="insta_points_rule_amount" value="<?php if(!empty($candidate_name)) echo $candidate_name; ?>" required="required" disabled class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               <input type="hidden" placeholder="Candidate Name" name="insta_points_rule_id" id="insta_points_rule_id" value="8" required="required" class="form-control col-md-7 col-xs-12">

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  
                   <input type="number" placeholder="Point" name="insta_points_transaction_amount" id="insta_points_transaction_amount" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                </label>
                
                <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea placeholder="Description"  name="insta_custom_transaction_details" rows="3" class="form-control" required="required"></textarea>
                        </div>                  
                
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="insta_points_rule_type" required="required">
                  <!-- <option value="">Select</option> -->
                   <option class="level-0" value="Credit">Credit</option>
                   <option class="level-0" value="Debit">Debit</option>     
                </select>
                </div>
              </div>

             
              
               <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 <?php if(!empty($candidate_id)) {  ?>
                  <input type="hidden" value="<?php echo $candidate_id; ?>" name="insta_user_id">
                  <?php } ?>
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
<?php }else{ ?>
<div class="">
    <div class="page-title">
      
}
<?php if(!empty($point_detail)) { $point_detail = $point_detail[0]; } 
$points = unserialize (POINTS_RULE); ?>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add / Update Point Rules <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="<?php if(!empty($point_detail)) { echo base_url().'admin/edit_details/points/'; } else { echo base_url().'admin/add_points_rule/'; } ?>" >

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rule Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="insta_points_rule_name" class="form-control" <?php if(!empty($point_detail)) { echo "disabled"; } ?> required="required">
                <option>Select</option>
                <?php foreach($points as $key=>$val)
                {
                  if(!empty($point_detail) && $point_detail->insta_points_rule_name == $key) {

                    echo "<option class='level-0'  value='".$key."' selected='selected'>".$key."</option>";
                  }else{
                     echo "<option class='level-0'  value='".$key."'>".$key."</option>";
                  }
                }
                 ?>
                }
                </select>
                 <!--  <input type="text" placeholder="Rule" name="insta_points_rule_name" id="insta_points_rule_name" value="<?php //if(!empty($point_detail->insta_points_rule_name)) echo $point_detail->insta_points_rule_name; ?>" required="required" class="form-control col-md-7 col-xs-12"> -->
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" placeholder="Point" name="insta_points_rule_amount" id="insta_points_rule_amount" value="<?php if(!empty($point_detail->insta_points_rule_amount)) echo $point_detail->insta_points_rule_amount; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                </label>
                
                <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea placeholder="Rule's  description"  name="insta_points_rule_description" rows="3" class="form-control" required="required"><?php if(!empty($point_detail->insta_points_rule_description)) echo $point_detail->insta_points_rule_description; ?></textarea>
                        </div>                  
                
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="insta_points_rule_type" required="required">
                  <!-- <option value="">Select</option> -->
                   <option class="level-0" value="Credit" <?php if(!empty($point_detail->insta_points_rule_type) && $point_detail->insta_points_rule_type == "Credit") { echo "selected='selected'";} ?>>Credit</option>
                   <option class="level-0" value="Debit" <?php if(!empty($point_detail->insta_points_rule_type) && $point_detail->insta_points_rule_type == "Debit") { echo "selected='selected'";} ?>>Debit</option>     
                </select>
                </div>
              </div>
              
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status  <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="insta_points_rule_status" required="required">
                  <!-- <option value="">Select</option> -->
                   <option class="level-0" value="1" <?php if($point_detail->insta_points_rule_status == 1) { echo "selected='selected'";} ?>>Enable</option>
                   <option class="level-0" value="0" <?php if($point_detail->insta_points_rule_status == 0) { echo "selected='selected'"; } ?>>Disable</option>  
                </select>
                   
                </div>
              </div>
               <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 <?php if(!empty($point_detail)) { ?>
                  <input type="hidden" value="<?php echo $point_detail->insta_points_rule_id; ?>" name="insta_points_rule_id">
                  <?php } ?>
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
 <?php } ?>
</div>