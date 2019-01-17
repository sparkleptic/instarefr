<div class="main">
   
   <style type="text/css">
   .pagination{
    margin-top:2px;
   }
       .pagination>li {
            display: inline-block;
            width: 50px;
        }
   </style>
    <?php  if( !empty($job_list) ) { ?>
    <div id="content-top-wrap">
        <!-- Find Job Form -->
        <div class="find-job-section">
            <div class="container">
            <?php $this->load->view('common/common-msg'); ?>
                <form class="find-job-form" id="title_company_skills_submit" action = "<?php echo base_url(); ?>job/filter_job/" method="get">
                    <div class="row">
                        <ul class="col-md-12 col-sm-12 col-xs-12 no-list-style find-job-form-ul">
                            <li class="no-padding form-group has-feedback col-md-5 col-sm-5 col-xs-12">
                                <img src="<?php echo IMAGE_PATH; ?>job-title-icon.png" alt="job-title" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                                <input list="title_company_skills" type="text" class="form-control find-job-input find-job-input-text input-left-radius" id="jobKeyword" onkeyup="doSearch('title_company_skills');" name="title_company_skills" placeholder="Job Title, Company, Tags" value="<?php if(!empty($title_company_skills)) echo $title_company_skills; ?>" autocomplete="off"/>
                                <div id="test"></div>
                                <datalist id="title_company_skills">
                                    <?php $new = array();
                                    // foreach ($job_list as $val) {
                                    //     if(!in_array($val->insta_job_title, $new))
                                    //         echo "<option value='".$val->insta_job_title."'>";
                                    //     array_push($new,$val->insta_job_title);
                                    // }

                                    $new = array();
                                    // foreach ($company as $val) {
                                    //     if(!in_array($val->insta_company_name, $new))
                                    //         echo "<option value='".$val->insta_company_name."'>";
                                    //     array_push($new,$val->insta_company_name);
                                   // }

                                    $new = array();
                                    // foreach ($job_list as $val) {
                                    //     if(!in_array($val->insta_job_skills, $new))
                                    //         echo "<option value='".$val->insta_job_skills."'>";
                                    //     array_push($new,$val->insta_job_skills);
                                    // } ?>
                                </datalist>
                            </li>

                            <li class="no-padding form-group has-feedback col-md-5 col-sm-5 col-xs-12">
                                <img src="<?php echo IMAGE_PATH; ?>place-icon.png" alt="job-location" class="header-form-input-icon glyphicon glyphicon-user form-control-feedback">
                                <input list="location" type="text" name="location"  class="form-control find-job-input find-job-input-text" id="locationKeyword" onkeyup="doSearch('location');" value="<?php if(!empty($location)) { echo $location; } else if(!empty($this->session->my_current_location)) { echo $this->session->my_current_location; }  ?>" placeholder="City, State or Zip" autocomplete="off"/>
                                <div id="test1"></div>
                                <datalist id="location">
                                    <?php $new = array();
                                    foreach ($job_list as $val) {
                                        // if(!in_array($val->insta_job_location, $new))
                                        //     echo "<option value='".$val->insta_job_location."'>";
                                        // array_push($new,$val->insta_job_location);
                                    } ?>
                                  </datalist>
                            </li>
                            <li class="no-padding form-group has-feedback col md-2 col-sm-2 col-xs-12">
                                <input type="submit" name="title_company_skills_submit" class="find-job-btn form-control trans find-job-input hidden" value="FIND JOB"/>
                                <input type="button"  class="find-job-btn form-control trans find-job-input" value="FIND JOB" onclick="submit_form('title_company_skills_submit')"/>
                                <i class="header-form-submit-icon get-job-submit-icon glyphicon glyphicon-search form-control-feedback"></i>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <div id="content-bottom-wrap">
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="row">
                        <?php if( !empty($job_list) ) { ?>
                            <!-- Job Filter -->
                            <div class="col-md-3">
                                <div class="all-jobs-div">
                                    <div class="style-select">
                                        <form id="cat_form" action = "<?php echo base_url(); ?>job/filter_job/" method="get">
                                            <select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" name="category" onchange="submit_form('category_submit')" id="category">
                                                <option value="Job Categories" <?php if(isset($category) && $category == 'Job Categories') {
                                                        echo "selected='selected'";
                                                    } ?>>Job Categories</option>
                                                <?php foreach ($job_category as $val) {
                                                    $selected = "";
                                                    if(isset($category) && $category == $val->insta_job_category) {
                                                        $selected = "selected='selected'";
                                                    }
                                                    echo "<option value='".$val->insta_job_category."' $selected>".$val->insta_job_category."</option>";
                                                } ?>
                                            </select>
                                            <input type="submit" name="category_submit" style="display:none;">
                                        </form>
                                    </div>
                                    <div class="style-select">
                                        <form id="exp_form" action = "<?php echo base_url(); ?>job/filter_job/" method="get">
                                            <select class="col-md-12 col-sm-12 col-xs-12 post-job-input-text" name="experience" onchange="submit_form('exp_submit')" id="experience">
                                                <option value="Experience" <?php if(isset($experience) && $experience == 'Experience') {
                                                        echo "selected='selected'";
                                                    } ?>>Experience</option>
                                                <?php foreach (range(0, 35) as $number) {
                                                    $selected = "";
                                                    if(isset($experience) && $experience == $number && $experience != 'Experience') {
                                                        $selected = "selected='selected'";
                                                    }
                                                    echo "<option value='".$number."' $selected>".$number." year</option>";
                                                } ?>
                                            </select>
                                            <input type="submit" name="exp_submit" style="display:none;">
                                        </form>
                                    </div>
                                </div>

                                <div class="all-jobs-div">
                                    <a class="all-jobs-link green-hover trans" href="<?php echo base_url(); ?>find-a-job/" title="View All Jobs">View All Jobs</a>
                                </div>
                            </div>
                            <!-- ./Job Filter -->
                            
                            <!-- Job List -->
                            <div class="col-md-9">
                                <!-- <div class="checkbox-wrap clearfix">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                Freelancer
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                Part Time
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                Full Time
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                Temporary
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                Partnership
                                            </label>
                                        </div>
                                    </div> -->

                                    <!-- <table id="jobs-table" class="jobs-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Account Management</th>
                                                <th>Analyst</th>
                                                <th>Business Development</th>
                                                <th>CRM</th>
                                                <th>C++</th>
                                                <th>Business Development</th>
                                                <th>Analyst</th>
                                                <th>Consulting</th>
                                                <th>Account Management</th>
                                                <th>Medical Officer</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Account Management</th>
                                                <th>Analyst</th>
                                                <th>Business Development</th>
                                                <th>CRM</th>
                                                <th>C++</th>
                                                <th>Business Development</th>
                                                <th>Analyst</th>
                                                <th>Consulting</th>
                                                <th>Account Management</th>
                                                <th>Medical Officer</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                            <?php //foreach($job_tags as $val) {
                                                
                                                //echo '<td>'.$val.'</td>';
                                            //} ?>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                    <!-- <table id="jobs-table" class="jobs-table" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                            <?php //foreach($job_category as $val) {
                                                
                                                //echo '<td>'.$val->insta_job_category.'</td>';

                                            //} ?>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                
                                <!-- Recent Jobs In Your Area -->
                                <div class="recent-jobs-section">
                                    <div class="spotlight-right">
                                        <?php if(is_array($jobs) && !empty($jobs)) {   ?>
                                            <?php if(count($jobs) > 8) { ?>
                                            <div class="show_paginator"></div>
                                            <?php } ?>
                                            <div class="recent-jobs" id="recent-jobs">
                                                 <ul id="1" class="clearfix job-list">
                                                    <?php $i = 0; $j=1; foreach($jobs as $val) {  ?>
                                                        <?php if($i%8 == 0 && $i!=0){ $j++;  ?>
                                                            </ul>
                                                    <ul id="<?php echo $j; ?>" style="<?php  echo 'display:none;'; ?>" class="clearfix job-list">
                                                    <?php } ?>
                                                    <li class="job-list-item">
                                                        <div class="clearfix">
                                                            <div class="col-md-1 col-sm-1 col-xs-3 no-padding job-list-item-image">
                                                            <?php if(!empty($val->insta_company_logo)) {
                                                               echo '<img class="img-responsive" src="'.COMPANY_LOGO_PATH.''.$val->insta_company_logo.'" alt="Job Logo">';
                                                            } else {
                                                              echo '<img class="img-responsive job-logo" src="'.IMAGE_PATH.'NoImageAvailable.png" alt="Job Logo">';
                                                            } ?>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-9 job-name">
                                                              <a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-link transition"><?php echo $val->insta_job_title; ?> - </a>
                                                              <p class="job-item-text"><?php echo $val->company; ?></p>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-12 job-loc">
                                                                <i class="glyphicon glyphicon-map-marker"></i>
                                                                <span><?php echo $val->insta_job_location; ?></span>
                                                            </div>
                                                            <div class="col-md-2 col-sm-3 col-xs-12 job-date">
                                                                <?php echo date('Y:m:d', strtotime($val->insta_job_created_on)); ?>
                                                            </div>
                                                            <div class="col-md-3 col-sm-2  col-xs-12 job-col-last text-right">
                                                              <a href="<?php echo base_url()."single-job/".$val->insta_job_id."/"; ?>" class="job-item-time-link transition">VIEW JOB</a>
                                                            </div>
                                                        </div>                        
                                                    </li>
                                                    <?php $i++; } ?>
                                                </ul>
                                            </div>
                                             <?php if(count($jobs) > 8) { ?>
                                            <div class="show_paginator"></div>
                                            <?php } ?>
                                           
                                        <?php } else { ?>
                                            <div class="recent-jobs" id="recent-jobs">
                                                <?php echo "Job Listing not available.."; ?>
                                            </div>
                                        <?php } ?> 
                                    </div><!--spotlight-right section ends-->
                                </div>             
                            </div>
                        <?php } else { 
                            echo "<h2>Job list not available now..</h2>";
                        } ?>
                    </div>
                </div>
                    
                <?php $this->load->view('common/inner-sidebar'); ?>
            </div>
        </div>
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
      
    <script src="<?php echo JS_PATH; ?>pagination.js"></script>
    <script>
    var str = window.location.href;
   
    if (~str.indexOf("#_=_"))
    {
         window.location.href = "<?php echo base_url(); ?>find-a-job/";
    }
     $(document).ready(function() {
      // $('#gallery').Paginationwithhashchange2({
      //   nextSelector: '.next',
      //   prevSelector: '.prev',
      //   counterSelector: '.counter',
      //   pagingSelector: '.paging-nav',
      //   itemsPerPage: 8,
      //   initialPage: 1
      // });
      var numItems = $('.job-list').length
         $('.show_paginator').bootpag({
               total: numItems,
               page: 1,
               maxVisible: 8,
               leaps: true,
               firstLastUse: true,
               first: '←',
               last: '→',
               wrapClass: 'pagination',
               activeClass: 'active',
               disabledClass: 'disabled',
               nextClass: 'next',
               prevClass: 'prev',
               lastClass: 'last',
               firstClass: 'first'
        }).on('page', function(event, num)
        {
            console.log(num);
            $(".job-list").hide();
            $("#"+num).show(); // or some ajax content loading...
            //console.log(a);
        });    
     });

    function submit_form(name)
    {
    	if(name == "exp_submit")
    	{
            var title = $("#jobKeyword").val();
            if(title!="")
            {
               $( "#exp_form" ).append("<input type='hidden' value='"+title+"' name='title_company_skills'>");
            }

            var location = $("#locationKeyword").val();
            if(location!="")
            {
               $( "#exp_form" ).append("<input type='hidden' value='"+location+"' name='location'>");
            }
            var category = $("#category option:selected").val();
            if(category!="" && category != 'Job Categories')
            {
               $( "#exp_form" ).append("<input type='hidden' value='"+category+"' name='category'>");
            }

            $( "input[name='exp_submit']" ).trigger( "click" );    		
    	}

        if(name == "category_submit")
    	{
            var title = $("#jobKeyword").val();
            if(title!="")
            {
               $( "#cat_form" ).append("<input type='hidden' value='"+title+"' name='title_company_skills'>");
            }

            var location = $("#locationKeyword").val();
            if(location!="")
            {
               $( "#cat_form" ).append("<input type='hidden' value='"+location+"' name='location'>");
            }
            var experience = $("#experience option:selected").val();
            if(experience!="")
            {
               $( "#cat_form" ).append("<input type='hidden' value='"+experience+"' name='experience'>");
            }

            $( "input[name='category_submit']" ).trigger( "click" );
    	}

        if(name=="title_company_skills_submit")
        {
            var category = $("#category option:selected").val();
            if(category!="")
            {
               $( "#title_company_skills_submit" ).append("<input type='hidden' value='"+category+"' name='category'>");
            }

            $( "input[name='exp_submit']" ).trigger( "click" );  
            var experience = $("#experience option:selected").val();
            if(experience!="")
            {
               $( "#title_company_skills_submit" ).append("<input type='hidden' value='"+experience+"' name='experience'>");
            }

            $( "input[name='title_company_skills_submit']" ).trigger( "click" );
        }
    }

    
    
    </script>
</div>