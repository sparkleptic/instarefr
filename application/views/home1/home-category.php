<!-- Popular categories section begins -->
      <section class="popular-categories" id="popular-categories">
        <div class="container">
            
            <h3 id="popular-title" class="section-title">POPULAR CATEGORIES</h3>
            <span class="green-border"></span> 
            <div class="categories">
              <div class="row row-eq-height">
            <?php $i = 0; foreach ($job_category as $val) { ?> 
            <?php if($i%4==0){ ?>                      
            </div>
            </div> <div class="categories">
              <div class="row row-eq-height">
            <?php } $i++; ?>
                <div class="col-md-3 col-sm-3">
                      <a href="<?php echo base_url().'find-a-job/'.$val->insta_job_category; ?>" class="feature-link">
                        <div class="feature-box">
                          
                          <div class="feature-image">
                          <?php if(!empty($val->insta_job_category_icon)) { ?>
                            <img class="img-responsive img1" src="<?php echo CATEGORY_ICON_PATH.''.$val->insta_job_category_icon; ?>">
                            <img class="img-responsive img2" src="<?php echo CATEGORY_ICON_PATH.''.$val->insta_job_category_icon; ?>">
                          <?php } ?>
                          </div>
                          
                          <div class="feature-title">
                            <?php echo $val->insta_job_category; ?>
                          </div>
                          
                          <div class="feature-border"></div>                    
                          
                          <div class="feature-desc">
                            <?php echo $val->insta_job_category_description; ?>
                          </div>
                        </div><!--feature-box-->
                        </a>
                      </div><!--/3--> 
            
           <?php  }    ?>     
           </div>
           </div>
          
        </div>
      </section>
      <!-- End! - Popular categories section -->