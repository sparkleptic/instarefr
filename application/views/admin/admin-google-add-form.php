<div class="right_col" role="main">
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
            <h2>Google Ads <small></small></h2><br>
           
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
            <form id="demo-form2" action="<?php if(!empty($ads_detail)) { echo base_url().'admin/edit_details/google_ads/'; }else { echo base_url().'admin/add_details/google_ads/'; } ?>" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Script <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="insta_google_ads"  id="insta_google_ads" required="required" class="form-control col-md-12 col-xs-12" rows="5"><?php if(!empty($ads_detail[0]->insta_google_ads)) { echo urldecode($ads_detail[0]->insta_google_ads); } ?></textarea>
                </div>
              </div>

              <?php if(!empty($ads_detail)) { ?>
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_google_ads_status">
                   <option class="level-0" value="1" <?php if($ads_detail[0]->insta_google_ads_status == 1) { echo "selected='selected'";} ?>>Enable</option>
                   <option class="level-0" value="0" <?php if($ads_detail[0]->insta_google_ads_status == 0) { echo "selected='selected'"; } ?>>Disable</option>     
                </select>
                </div>
              </div>
              <?php }else{ ?>
              <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="insta_google_ads_status">
                   <option class="level-0" value="1">Enable</option>
                   <option class="level-0" value="0">Disable</option>     
                </select>
                </div>
              </div>
              <?php  } ?>
            
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php if(!empty($ads_detail[0]->insta_google_ads_id)) { ?>
                  <input type="hidden" name="insta_google_ads_id" value="<?php echo $ads_detail[0]->insta_google_ads_id; ?>"/>
                 <?php } ?> 
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
</div>