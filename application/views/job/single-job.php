<?php 
$job = $job_detail[0];
$company = $company_detail[0]; 
$company_detail = json_decode($company_detail[0]->insta_company_alias);  

$datetime1 = new DateTime($job->insta_job_created_on);
$datetime2 = new DateTime(date("Y-m-d H:i:s"));
$interval = $datetime1->diff($datetime2);
$posted_days = $interval->format('%a days');
$summary = "";
if(!empty($job->insta_job_description))
{

  
  $summary = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($job->insta_job_description))))));
  $summary = trim(strip_tags($job->insta_job_description));
  //$summary = preg_replace('/\s+/', ' ', $summary);
}

//$posted_time = strtotime(date("Y-m-d H:i:s")) - strtotime($job->insta_job_created_on); echo floor($posted_time / (60 * 60 * 24));
?> 

<script src="<?php echo JS_PATH.'facebook_all.js'; ?>"></script>
<script type="text/javascript">

function twitter_share()
{
  window.open('https://twitter.com/intent/tweet?text=<?php if(!empty($job->insta_job_title)) { echo $job->insta_job_title; } ?> <?php echo base_url(uri_string()); ?>&image=<?php if(!empty($job->insta_job_featured_image)) { echo USER_JOB_PATH.''.$job->insta_job_featured_image; } ?>', 'twitterwindow','left=400,top=200,width=600,height=300,toolbar=0,resizable=1');
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
            picture:'<?php if(!empty($job->insta_job_featured_image)) { echo USER_JOB_PATH.''.$job->insta_job_featured_image; }  ?>',
            caption:'<?php if(!empty($job->insta_job_title)) { echo addslashes(htmlspecialchars(strip_tags($job->insta_job_title))); } ?>'
      }, function(response){});
}
function linkedin_share()
{
   window.open('https://www.linkedin.com/shareArticle?url=<?php echo base_url(uri_string()); ?>&title=<?php if(!empty($job->insta_job_title)) { echo addslashes(htmlspecialchars(strip_tags($job->insta_job_title))); } ?>&source=<?php echo base_url(); ?>', 'linkedinwindow','left=400,top=200,width=600,height=700,toolbar=0,resizable=1');
}
</script>
 <!-- Current Page Info-->
<?php $this->load->view('common/common-msg'); ?>
<!-- Job : Brief View -->
<div class="job-view">
    <div class="container">
        <div class="clearfix">
            <div class="job-view-title pull-left"><?php if(!empty($job->insta_job_title)) echo $job->insta_job_title; ?> </div>
            <!-- <div class="views-count pull-left">1232 views</div> -->
        </div>
        <div class="job-info">
            <ul class="list-unstyled list-inline">
                <li>
                    <span class="glyphicon glyphicon-star"></span>
                    Full Time
                </li>
                <li>
                    <span class="glyphicon glyphicon-map-marker"></span>
                    <?php if(!empty($job->insta_job_location)) echo $job->insta_job_location; ?>
                </li>
                <li>
                    <span class="glyphicon glyphicon-calendar"></span>
                    Posted : <?php if(!empty($job->insta_job_created_on)) { echo $posted_days.' ago';  } ?>
                </li>
                <li>
                    <span class="glyphicon glyphicon-folder-open"></span>
                   <?php
                      if( strpos( $job->insta_job_tags, ',' ) !== false ) {
                          $arr = explode(',', $job->insta_job_tags);
                          foreach($arr as $tag)
                          {
                              $tag = trim($tag);
                              echo "<a href='".base_url()."job-tag/".rawurlencode($tag)."/'><span>".$tag."</span></a>";
                          }
                      }else{
                        $tag = trim($job->insta_job_tags);
                        echo "<a href='".base_url()."job-tag/".$tag."/'><span>".$tag."</span></a>";
                          
                      }
                  ?>
                </li>
                <li>
                    <span class="glyphicon glyphicon-calendar"></span>
                    Experience : <?php if
                    ($job->insta_job_min_experience != $job->insta_job_max_experience) { echo $job->insta_job_min_experience." - ".$job->insta_job_max_experience; }else { echo $job->insta_job_min_experience; }   ?> Year
                </li>
                <li>
                    <i class="fa fa-building" aria-hidden="true"></i>
                   <a href="<?php echo base_url(); ?>company-jobs/<?php if(!empty($job->insta_company_id)) echo $job->insta_company_id; ?>/<?php if(!empty($company->insta_company_name)) echo $company->insta_company_name; ?>/"> <?php if(!empty($job->company)) echo $job->company; ?>
                   </a>
                </li>
            </ul>
        </div>                                
    </div>
</div>

 <!-- JOB AND COMPANY DETAILS -->
<div class="job-company-details">
    <div class="container">
        <div class="row">
            

                <div id="content" class="col-md-9 col-sm-9 col-xs-12">

                    <!-- <div class="overview border">
                        <h3 class="section-title">OVERVIEW</h3>
                        <span class="green-border"></span>
                        <p><span class="section-sub-title">Job Code: </span>70485BR</p>  
                    </div> -->

                    <?php if(!empty($job->insta_job_description)) { ?>
                    <div class="description border">
                        <h3 class="section-title">JOB DESCRIPTION</h3>
                        <span class="green-border"></span>
                        <!-- <h4 class="section-sub-title">Business Unit Introduction</h4> -->
                        <div>
                           <?php if(!empty($job->insta_job_description)) echo $job->insta_job_description; ?>
                        </div>
                    </div> <?php } ?>
                    
                     <?php if(!empty($job->insta_job_category)) { ?>  
                    <div class="location border">
                        <h4 class="section-sub-title">Category</h4>
                         <?php if(!empty($job->insta_job_category)) echo $job->insta_job_category; ?>
                    </div> <?php } ?>

                     

                     <?php if(!empty($job->insta_job_tags)) { ?>
                    <div class="location border">
                        <h4 class="section-sub-title">Tags</h4>
                         <?php if(!empty($job->insta_job_tags)) echo $job->insta_job_tags; ?>
                    </div> <?php } ?>

                     <?php if(!empty($job->insta_job_created_on)) { ?>
                    <div class="location border">
                        <h4 class="section-sub-title">Posted Date</h4>
                        <?php if(!empty($job->insta_job_created_on)) echo $job->insta_job_created_on; ?>
                    </div> <?php } ?>

                     <?php if(!empty($job->insta_job_closing_date)) { ?>
                    <div class="location border">
                        <h4 class="section-sub-title">Closing Date</h4>
                        <input type="hidden" value="<?php echo $job->insta_job_closing_date; ?>" name="closing_date" id="closing_date">
                        <?php if(!empty($job->insta_job_closing_date)) echo $job->insta_job_closing_date; ?>
                    </div> <?php } ?>

                     <?php if(!empty($job->insta_job_location)) { ?>
                    <div class="location border">
                        <h4 class="section-sub-title">Location</h4>
                         <?php if(!empty($job->insta_job_location)) echo $job->insta_job_location; ?>
                    </div> <?php } ?>

                    <?php if(!empty($job->insta_job_type)) { ?>
                     <div class="location border">
                        <h4 class="section-sub-title">Type</h4>
                         <?php if(!empty($job->insta_job_type)) echo $job->insta_job_type; ?>
                    </div>
                    <?php } ?>

                    <?php if(!empty($job->insta_job_status) && $job->insta_job_status != 0) { ?>
                    <div class="detailed-job-apply text-right">
                        <a class="subscribe-link trans apply-for-job-popup-link" href="#" apply-job="<?php echo $job->insta_job_id; ?>" title="Apply Now">Get Referral</a>
                    </div>
                    <?php } ?>
                </div>

                <div id="sidebar" class="col-md-3 col-sm-3 col-xs-12">
                    <?php if(!empty($job->insta_job_status) && $job->insta_job_status != 0) { ?>
                    <div class="apply-for-job text-center">
                        <a class="subscribe-link trans apply-for-job-popup-link" href="#" apply-job="<?php echo $job->insta_job_id; ?>" title="Apply Now">Get Referral</a>
                    </div>
                    <?php } ?>
                    <div class="share-job text-center">
                        <div class="clearfix">
                          <h4 class="section-sub-title">SHARE THIS JOB</h4>
                          <span class="green-border"></span>
                        </div>
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="" href="#" onclick="twitter_share();" title="Twitter"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>twitter2.png" alt="Twitter"/></a>
   
                            <a class="" href="#" onclick="facebook_share();" title="Facebook"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>facebook2.png" alt="Facebook"/></a>

                            <a rel="nofollow" class="" href="#" onclick="linkedin_share();" title="LinkedIn"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>linkedin2.png" alt="LinkedIn"/></a>

                            <!-- <a rel="nofollow" class="a2a_i" href='javascript:a2a.loadExtScript("https://static.addtoany.com/menu/pinmarklet.js")' target="_blank" title="Pinterest"><img class="img-responsive social-img" src="<?php //echo IMAGE_PATH; ?>pinterest.png" alt="pinterest"/></a> -->

                           <!--  <a href="https://plus.google.com/share?url=<?php echo base_url(uri_string()); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
  src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a> -->

                            <a href="https://plus.google.com/share?url=<?php echo base_url(uri_string()); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Google Plus"><img class="img-responsive social-img" src="<?php echo IMAGE_PATH; ?>gplus2.png" alt="Google Plus"/></a>
                        </div>
                    </div>
                    <div class="about-company text-center">
                        <h4 class="section-sub-title">ABOUT <?php echo $job->company; ?></h4>
                        <span class="green-border"></span>
                        <div class="about-company-img">
                        <?php if(!empty($company_detail->insta_company_logo)) { ?>
                            <img class="img-responsive social-img" src="<?php echo COMPANY_LOGO_PATH.''.$company_detail->insta_company_logo; ?>" alt="<?php echo $job->company; ?>"/>
                        <?php } ?>
                        </div>
                        <p class="no-margin">
                            <?php if(!empty($company_detail->insta_company_description)) { echo $company_detail->insta_company_description; } ?>
                        </p>
                    </div>
                </div>
            <?php $this->load->view('common/inner-sidebar'); ?>
        </div>            
    </div>
</div>

<!-- RECENT JOBS IN YOUR AREA -->
<div class="recent-jobs-single-page">
    <div class="spotlight-right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title spotlight-title">Related Jobs</h3>
                    <span class="green-border"></span>
                    <div class="recent-jobs" id="recent-jobs">
                    <?php //echo "<pre>"; print_r($related_jobs); ?>
                        <ul class="job-list" id="job-list">
                        <?php if(!empty($related_jobs)) {

                         foreach($related_jobs as $val) {  
                          echo '<li class="job-list-item">
                                  <div class="clearfix">
                                    <div class="job-item-div0 pull-left job-list-item-image">';
                                    if(!empty($val->insta_company_logo))
                                    {
                                       echo '<img class="img-responsive job-logo" src="'.COMPANY_LOGO_PATH.''.$val->insta_company_logo.'" alt="Job Logo">';
                                    }else{
                                      echo '<img class="img-responsive job-logo" src="'.IMAGE_PATH.'NoImageAvailable.png" alt="Job Logo">';
                                    }
                                        
                                    echo '</div>
                                    <div class="job-item-div1 job-list-item-post">
                                      <a href="'.base_url().'single-job/'.$val->insta_job_id.'/" class="job-item-link transition">'.$val->insta_job_title.' - '.$val->company.'</a>
                                     <!--  <p class="job-item-text">Ernst and Young India</p> -->
                                    </div>
                                    <div class="job-item-div2 job-list-item-location">
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                        <span>'.$val->insta_job_location.'</span>
                                    </div>
                                    <div class="job-item-div3 job-list-item-button">
                                      <a href="'.base_url().'single-job/'.$val->insta_job_id.'/" class="job-item-time-link transition">VIEW JOB</a>
                                    </div>
                                  </div>                        
                                </li>'; 
                          } } else { echo "<br>Not available now"; } ?>
                            
                        </ul>
                    </div>
                </div>                    
            </div>                
        </div>
    </div><!--spotlight-right section ends-->
</div>
<script type="text/javascript">
$(document).ready(function(){   

     $(".apply-for-job-popup-link").click(function() {
     var jobId = $(this).attr("apply-job"); 
     var closing_date = $("#closing_date").val(); // For JQuery

     
          $.ajax({
            type: "POST",
            url: "<?php echo base_url("job/apply_job/"); ?>",
            data    : {'jobId':jobId,'closing_date':closing_date},
            dataType: "text",
            success: function(msg){
              if(msg == 1)
              {
                $('.apply-job-container').css("display","block");
                $('.apply-job-container #insta_job_id').val(jobId);
              }else if(msg == 2){            
                document.getElementById('id01').style.display='block';

              }else{ 
                if(msg.indexOf("http") != -1){ 
                    window.location.href = msg;
                }else{
                    var a = '<div class="modal fade" id="ajaxMsgModal" role="dialog"> <div class="modal-content signup-model-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> </div> <div class="modal-body"> Sorry! some error occured, please apply after sometime.  </div> </div> </div>'; 
                    $('body').append(a);
                }
                
              }          
            } 
          }); 
      

        
     
     return false;
 });
 });
</script>