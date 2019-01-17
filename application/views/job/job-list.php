        <!-- Current Page Info-->
        <div class="manage-job-table-container">
            <div class="container">
            <?php $this->load->view('common/common-msg'); ?>
                <div class="row">

                    <!-- Content -->
                    <div id="content" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php if(!empty($job_list)) { ?>
                            <div class="table-head-item manage-job-table-heading refer-table-heading clearfix">
                                <div class="refer-col-1 fl-left refer-table-head">Title</div>
                                <div class="refer-col-2 fl-left refer-table-head text-center">Status</div>
                                <div class="refer-col-3 fl-left refer-table-head text-center">Date Posted</div>
                                <div class="refer-col-4 fl-left refer-table-head text-center">Listing Expires</div>
                                <div class="refer-col-5 fl-left refer-table-head text-center">Applied</div>
                                <div class="refer-col-6 fl-left refer-table-head text-center">Applications</div>
                            </div>
                            <!-- <table id="manage-job-table" class="instarefer-datatable table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="col-md-3">Title</th>
                                        <th class="col-md-2">Status</th>
                                        <th class="col-md-3">Date Posted</th>
                                        <th class="col-md-1">Listing Expires</th>
                                        <th class="col-md-2">&nbsp;</th>
                                        <th class="col-md-1">Applications</th>
                                    </tr>
                                </thead>

                                <tbody> -->
                                <?php foreach($job_list as $val) { 
                                    if($val->insta_job_status==0) {
                                        $status = '<span class="credit-color">Inactive</span>';
                                    } else {
                                        $status = 'Active';
                                    } ?>
                                    <div class="refer-table-row manage-job-table-row">
                                        <div class="table-row-item refer-table-row-top refer-table-job clearfix">
                                            <div class="refer-col-1 col-text fl-left refer-table-cell">
                                                <div class="visible-xs table-xs-title">Title</div>
                                                <div class="table-content">
                                                    <a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-link transition"><?php echo $val->insta_job_title; ?> - </a>
                                                    <span class="job-item-text"><?php echo $val->company; ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="refer-col-2 col-img fl-left refer-table-cell text-center">
                                                <div class="visible-xs table-xs-title">Status</div>
                                                <div class="table-content">
                                                    <?php echo $status; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="refer-col-3 col-text fl-left refer-table-cell refer-and-date-color">
                                                <div class="visible-xs table-xs-title">Date Posted</div>
                                                <div class="table-content">
                                                    <?php echo $val->insta_job_created_on; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="refer-col-4 col-text fl-left refer-table-cell refer-and-date-color text-center">
                                                <div class="visible-xs table-xs-title">Listing Expires</div>
                                                <div class="table-content">
                                                    <?php echo $val->insta_job_closing_date; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="refer-col-5 col-text fl-left refer-table-cell refer-and-date-color text-center">
                                                <div class="visible-xs table-xs-title">&nbsp;</div>
                                                <div class="table-content">
                                                    <?php echo $val->apply_users_count; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="refer-col-6 col-text fl-left refer-table-cell refer-and-date-color text-center">
                                                <div class="visible-xs table-xs-title">Applications</div>
                                                <div class="table-content">
                                                    <a href="<?php echo base_url().'manage-job/'.$val->insta_job_id.'/'; ?>" class="candidate-refer-link insta-btn-small transition">Manage</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php /*
                                    <tr>
                                        <td class="col-md-3"><a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="insta-link"><?php echo $val->insta_job_title .'-'. $val->company; ?></a></td>
                                        <td class="col-md-2"><?php echo $status; ?></td>
                                        <td class="col-md-3"><?php echo $val->insta_job_created_on; ?></td>
                                        <td class="col-md-2"><?php echo $val->insta_job_closing_date; ?></td>
                                        <td class="col-md-1"><?php echo $val->apply_users_count; ?></td>
                                        <td class="col-md-1"><a href="<?php echo base_url().'manage-job/'.$val->insta_job_id.'/'; ?>" class="candidate-refer-link insta-btn-small transition">Manage</a></td>
                                    </tr> */?>
                                <?php } ?>
                               <!--  </tbody>
                            </table> -->
                            <?php } else {
                                echo "Job listing not available";
                            } ?>
                    </div>

                    <!-- Sidebar -->
                    <?php $this->load->view('common/inner-sidebar'); ?>

                </div>
            </div>
        </div>
