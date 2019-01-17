 <!-- spotlight section begins -->
      <div class="spotlight">
      
        <div class="container">
          <div class="row">
            
            <!-- spotlight-left section -->
            <section class="spotlight-left col-md-4">
                <h3 class="section-title spotlight-title">JOB SPOTLIGHT</h3>  
                <span class="green-border"></span>
                <div class="job-desc" id="job-desc">
                    <?php if(!empty($job_spotlight)) {
                      foreach($job_spotlight as $spotlight){ ?>
                        <div class="job-desc-div-1" id="job-desc-div-1">
                          <p><?php echo $spotlight->insta_job_title; ?></p>
                        </div>
                        <div class="job-desc-div-2" id="job-desc-div-2">
                            <span class="glyphicon glyphicon-map-marker" id="job-desc-div2-span"></span>
                            <span id="city" class="city"><?php echo $spotlight->insta_job_location; ?></span>
                            <div class="job-time-div"><a href="<?php echo base_url()."single-job/".$spotlight->insta_job_id."/"; ?>" class="job-time trans" id="job-time">VIEW JOB</a></div>
                            <div class="job-desc-text" id="job-desc-text">
                             <?php echo $spotlight->insta_job_description; ?>
                            </div>
                        </div>
                     <?php }

                  }?>
                </div>
            </section> <!--spotlight-left section ends-->

            <!-- spotlight-right section begins -->
            <section class="spotlight-right col-md-8">
                <h3 class="section-title spotlight-title">Latest Job</h3>
                <span class="green-border"></span>
                <div class="recent-jobs" id="recent-jobs">
                  <?php if(empty($error_msg) && !empty($job_list)) {  ?>
                  <ul class="job-list" id="job-list">
                     
                        <?php $i=0;  foreach($job_list as $val) {
                        if($i==5) break; ?>
                              <li class="job-list-item" id="job-list-item1">
                                  <div class="clearfix">
                                    <div class="job-item-div1">
                                      <a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-link transition"><?php echo $val->insta_job_title; ?> - </a>
                                      <p class="job-item-text"><?php echo $val->company; ?></p>
                                    </div>
                                    <div class="job-item-div2">
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                        <span><?php echo $val->insta_job_location; ?></span>
                                    </div>
                                    <div class="job-item-div3">
                                      <a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-time-link transition">VIEW JOB</a>
                                    </div>
                                  </div>                        
                              </li>
                          <?php $i++; } ?>         
                  </ul>
                  <?php if(count($job_list) > 5) { ?>
                  <a href="<?php echo base_url().'find-a-job/'; ?>" class="more-jobs">VIEW MORE</a>
                  <?php } ?>
                   <?php }else { echo "Not available now."; } ?>        
                </div>  
            </section><!--spotlight-right section ends-->
          </div>
        </div>
      </div><!--spotlight section ends-->