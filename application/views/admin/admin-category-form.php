<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">

            </div>
            <?php if(!empty($category_detail)) { $category_detail=$category_detail[0]; } ?>
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
                        <h2>Add job category </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="<?php if(!empty($category_detail)) { echo base_url().'admin/edit_details/category/'; } else { echo base_url().'admin/add_job_category/'; } ?>">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Category" name="insta_job_category" id="insta_job_category" value="<?php if(!empty($category_detail->insta_job_category)) echo $category_detail->insta_job_category; ?>" required="required" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Icon</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if(!empty($category_detail->insta_job_category_icon)) { ?>
                                    <img height="100" width="100" alt="" src="<?php echo CATEGORY_ICON_PATH.$category_detail->insta_job_category_icon; ?>">
                                    <?php } ?>
                                    <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png" name="insta_job_category_icon" id="featured_image" placeholder="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                                </label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <textarea id="message" required="required" class="form-control" placeholder="Description" name="insta_job_category_description"data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"><?php if(!empty($category_detail->insta_job_category_description)) echo $category_detail->insta_job_category_description; ?></textarea>

                                </div>

                            </div>




                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="insta_job_category_status">
                                        <!-- <option value="">Select</option> -->
                                        <option class="level-0" value="1" <?php if(!empty($category_detail->insta_job_category_status) && $category_detail->insta_job_category_status == 1) { echo "selected='selected'";} ?>>Enable</option>
                                        <option class="level-0" value="0" <?php if(!empty($category_detail->insta_job_category_status) && $category_detail->insta_job_category_status == 0) { echo "selected='selected'"; } ?>>Disable</option>
                                    </select>

                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <?php if(!empty($category_detail)) { ?>
                                    <input type="hidden" value="<?php echo $category_detail->insta_job_category_id; ?>" name="insta_job_category_id">
                                    <?php } ?>
                                    <a href="<?php echo base_url(); ?>admin/listing/category/" class="btn btn-primary">Cancel</a>
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