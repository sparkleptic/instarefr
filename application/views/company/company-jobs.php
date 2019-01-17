 <?php
$company = $company_detail[0]; 
$company_detail = json_decode($company_detail[0]->insta_company_alias);
$summary = "";
if(!empty($company_detail->insta_company_description))
{
  $summary = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($company_detail->insta_company_description))))));
}

//echo "<pre>"; print_r($company);
?>


 <!-- Current Page Info-->
<script src="<?php echo JS_PATH.'facebook_all.js'; ?>"></script>
<script type="text/javascript">
function linkedin_share()
{
  window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(uri_string()); ?>&title=<?php echo addslashes(htmlspecialchars($company->insta_company_name)); ?>&source=<?php echo base_url(); ?>', 'linkedinwindow','left=400,top=200,width=600,height=700,toolbar=0,resizable=1');
}
function twitter_share()
{
  window.open('https://twitter.com/intent/tweet?text=<?php echo htmlspecialchars($company->insta_company_name); ?> <?php echo base_url(uri_string()); ?>&image=<?php if(!empty($company_detail->insta_company_logo)) { echo COMPANY_LOGO_PATH.''.$company_detail->insta_company_logo; } ?>', 'twitterwindow','left=400,top=200,width=600,height=300,toolbar=0,resizable=1');
}
function facebook_share()
{
  FB.init({ 
          appId:'240834932956528', cookie:true, status:true, xfbml:true 
      });
  FB.ui({
        method: 'share',
       mobile_iframe: true,
            href: '<?php echo base_url(uri_string()); ?>',
            redirect_uri: '<?php echo base_url(uri_string()); ?>',
            picture:'<?php if(!empty($company_detail->insta_company_logo)) { echo COMPANY_LOGO_PATH.''.$company_detail->insta_company_logo; } ?>',
            caption:'<?php echo addslashes(htmlspecialchars($company->insta_company_name)); ?>'
      }, function(response){});
}
</script>

<!-- SINGLE COMPANY INFO SECTION -->
<div class="single-company-info">
    <div class="container">
    <?php $this->load->view('common/common-msg'); ?>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 clearfix">
                <div class="single-company-img pull-left col-md-3 col-sm-3 col-xs-12 no-padding-left">
                <?php if(!empty($company_detail->insta_company_logo)) { ?>
                    <img class="img-responsive" src="<?php echo COMPANY_LOGO_PATH.''.$company_detail->insta_company_logo; ?>" alt="<?php echo $company->insta_company_name; ?>"/>  
                  <?php } else { ?>
                     
                  <?php } ?>
                </div>
              
                <div class="single-company-details pull-left col-md-9 col-sm-9 col-xs-12">
                    <h2 class="section-title"><?php if(!empty($company->insta_company_name)) echo $company->insta_company_name; ?></h2>
                    <p class="article-div-border job-item-text brief-desc"><?php if(!empty($company_detail->insta_company_tagline)) echo $company_detail->insta_company_tagline; ?></p>
                    <span class="green-border"></span>
                    <div class="clearfix">
                        <div class="d-inline-block pull-left">
                            <p class="single-company-positions">OPEN POSITIONS</p>
                            <p class="number-of-jobs"><?php if(count($job_detail) > 0 && !empty($job_detail)) echo count($job_detail).' Jobs Available'; else echo 'Jobs not available now';?> </p>
                        </div>
                        <!-- <div class="d-inline-block pull-left single-jobs-link text-right">
                            <a class="job-item-time-link trans" href="javascript:void(0);" title="favourite">FAVOURITE</a>
                            <a class="subscribe-link trans" href="javascript:void(0);" title="Contact">CONTACT</a>
                        </div> -->
                    </div>
                </div>
            </div>
           

            <div class="col-md-3 col-md-offset-1 col-sm-12 col-xs-12 share-single-job a2a_kit a2a_kit_size_32 a2a_default_style">
            
                <p class="single-company-positions">SHARE</p>
                

                <a class="" href="#" onclick="twitter_share();" title="Twitter"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>twitter2.png" alt="Twitter"/></a>

                <a class="" href="#" onclick="facebook_share();" title="Facebook"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>facebook2.png" alt="Facebook"/></a>

                <a rel="nofollow" class="" href="#" onclick="linkedin_share();" title="LinkedIn"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>linkedin2.png" alt="LinkedIn"/></a>

                <!-- <a rel="nofollow" class="a2a_i" href='javascript:a2a.loadExtScript("https://static.addtoany.com/menu/pinmarklet.js")' target="_blank" title="Pinterest"><img class="img-responsive social-img" src="<?php //echo IMAGE_PATH; ?>pinterest.png" alt="pinterest"/></a> -->

                <a href="https://plus.google.com/share?url=<?php echo base_url(uri_string()); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Google Plus"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>gplus2.png" alt="Google Plus"/></a>
                
            </div>
        </div>
    </div>            
</div>


 <!-- ABOUT COMPANY -->
 <?php if(!empty($company_detail->insta_company_twitter) && !empty($company_detail->insta_company_facebook) && !empty($company_detail->insta_company_linkedin) && !empty($company_detail->insta_company_google) && !empty($company_detail->insta_company_video) && !empty($company_detail->insta_company_website)) { ?>
<div class="single-company-about">
    <div class="container">
        <h2 class="section-title">ABOUT <?php if(!empty($company->insta_company_name))  echo $company->insta_company_name; ?></h2>
        <span class="green-border"></span>
        <p>
            <?php if(!empty($company_detail->insta_company_description)){
                echo $company_detail->insta_company_description;
            } ?>
        </p>

    
      
        <div class="company-info-icons row">
            <ul class="list-unstyled list-inline col-md-12">
                <li class="col-md-3 col-sm-6 col-xs-12 clearfix">
                 <?php if(!empty($company_detail->insta_company_website)) { ?>
                <a href="<?php echo $company_detail->insta_company_website; ?>" target="_blank"><span class="about-company-icon-text fl-left">Website  </span> </a>              
                    <!-- <p class="about-company-icon-text">From 1968</p>-->
                <?php } ?>
                </li>
                <li class="col-md-3 col-sm-6 col-xs-12 clearfix clearfix">
                  <?php if(!empty($company_detail->insta_company_video)) { ?>
                    <a href="<?php echo $company_detail->insta_company_video; ?>" target="_blank"><span class="about-company-icon-text fl-left">Video </span> </a>  
                   <!-- <p class="about-company-icon-text">From 1968</p>-->
                <?php } ?>
                </li>
                <li class="col-md-6 col-sm-6 col-xs-12 clearfix">
                    <div class="share-single-job share-company-job">
                    <?php if(!empty($company_detail->insta_company_twitter) && !empty($company_detail->insta_company_facebook) && !empty($company_detail->insta_company_linkedin) && !empty($company_detail->insta_company_google)) { ?>
                    <span class="about-company-icon-text fl-left">Follow Us :</span>

                    <?php if(!empty($company_detail->insta_company_twitter)) { ?>
                        <a class="a2a_button_twitter" title="Twitter" target="_blank" href="<?php echo $company_detail->insta_company_twitter; ?>"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>twitter2.png" alt="Twitter"/></a>
                    <?php } ?>
                    <?php if(!empty($company_detail->insta_company_facebook)) { ?>
                        <a class="a2a_button_facebook" title="Facebook" target="_blank" href="<?php echo $company_detail->insta_company_facebook; ?>"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>facebook2.png" alt="Facebook"/></a>
                     <?php } ?>
                    <?php if(!empty($company_detail->insta_company_linkedin)) { ?>
                        <a rel="nofollow" class="a2a_i a2a_sss" href="<?php echo $company_detail->insta_company_linkedin; ?>" target="_blank" title="LinkedIn"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>linkedin2.png" alt="LinkedIn"/></a>
                    <?php } ?>
                    <?php if(!empty($company_detail->insta_company_google)) { ?>
                        <a class="a2a_button_google_plus" href="<?php echo $company_detail->insta_company_google; ?>" title="Google Plus" target="_blank"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>gplus2.png" alt="Google Plus"/></a>
                     <?php } ?>
                      <?php } ?>
                    </div>
                </li>
            </ul>
        </div>

   
    </div>            
</div>
 <?php } ?>
<!-- OPEN-POSITIONS -->
<div class="open-positions">
    <div class="spotlight-right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="col-md-9 col-sm-9 col-xs-12">
                     <?php if(!empty($job_detail)) { ?>
                        <h3 class="section-title spotlight-title page-heading">OPEN POSITIONS</h3>
                        <span class="green-border"></span>
                        <div class="recent-jobs" id="recent-jobs">
                            <ul class="job-list" id="job-list">
                             <?php 
                               if($job_detail > 0)
                               {
                                  foreach($job_detail as $val)
                                  {
                                  
                                         echo '<li class="job-list-item" id="job-list-item1">
                                          <div class="clearfix">
                                            <div class="job-item-div0 pull-left job-list-item-image">';
                                            if(!empty($val->insta_company_logo))
                                            {
                                               echo '<img class="img-responsive" src="'.COMPANY_LOGO_PATH.''.$val->insta_company_logo.'" alt="Job Logo">';
                                            }else{
                                              echo '<img class="img-responsive" src="'.IMAGE_PATH.'NoImageAvailable.png" alt="Job Logo">';
                                            }
                                                
                                            echo '</div>
                                            <div class="job-item-div1 job-list-item-post">
                                              <a href="'.base_url().'single-job/'.$val->insta_job_id.'/" class="job-item-link transition">'.$val->insta_job_title.' - '.$val->company.'</a>
                                             <!--  <p class="job-item-text">Ernst and Young India</p> -->
                                            </div>
                                            <div class="job-item-div2 job-list-item-location">
                                                <i class="glyphicon glyphicon-map-marker fl-left"></i>
                                                <span>'.$val->insta_job_location.'</span>
                                            </div>
                                            <div class="job-item-div3 job-list-item-button">
                                              <a href="'.base_url().'single-job/'.$val->insta_job_id.'/" class="job-item-time-link transition">VIEW JOB</a>
                                            </div>
                                          </div>                        
                                        </li>';
                                     }
                               }
                                
                               ?>
                            </ul>
                        </div>
                    <?php } ?>
                    </div>
                    
                    <?php $this->load->view('common/inner-sidebar'); ?>

                </div>                    
            </div>                
        </div>
    </div><!--spotlight-right section ends-->
</div>
<!-- <section class="news-letter-section">
    <h2 class="section-title">NEWS LETTER</h2>
    <span class="green-border"></span>
    <div class="container">
        <form class="news-letter-form">
            <div class="row">
                <ul class="no-list-style col-md-offset-1 col-md-11">
                    <li class="col-md-4 news-letter-li">
                        <input class="news-letter-input-text" type="text" name="name" placeholder="Enter Your Name" required>
                    </li>
                    <li class="col-md-4 news-letter-li">
                        <input class="news-letter-input-text" type="text" name="email" placeholder="Enter Your Email-Id" required>
                    </li>
                    <li class="col-md-2 news-letter-li">
                        <input class="news-letter-input-submit news-letter-submit   " type="submit" value="SUBSCRIBE">
                    </li>
                </ul>
            </div>                    
        </form>                
    </div>
</section> -->


