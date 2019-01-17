<script src="http://isotope.metafizzy.co/beta/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="<?php echo JS_PATH; ?>modulo-columns.js" type="text/javascript"></script>
<script src="<?php echo JS_PATH; ?>isotope-custom.js"></script>
<!-- Current Page Info-->
        
        <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
        <div class="popular-companies">
            <div class="container">
            <?php $this->load->view('common/common-msg'); ?>
                 <h3 class="companies-title page-heading">POPULAR COMPANIES</h3> 
                <span class="green-border"></span>
                <div id="company-slide" class="owl-carousel owl-theme">
                <?php
                $j = 0;
                foreach($company_list as $val)
				{ 
					$alias = json_decode($val->insta_company_alias);
					if(!empty($alias->insta_company_logo))
					{
						echo '<div class="item">
                        <a href="'.base_url().'company-jobs/'.$val->insta_company_id.'/'.$val->insta_company_name.'/" title="Mahindra"><img class="img-responsive" src="'.COMPANY_LOGO_PATH.''.$alias->insta_company_logo.'" alt="Mahindra"></a>
                   		 </div>';
                   		 $j++;
					}					
				} 
				?>
				</div>
				 <?php 
				if($j == 0)
				{
						echo "<br>Company logo not available now.";
				} ?>
            </div>
           
        </div>

        <div class="company-list">
            <div class="container">
                <div class="row">

                        <div id="content" class="col-md-9 col-sm-9 col-xs-12">
                         
                            <p id="letters" class="letters button-group filters-button-group">
                            <a href="javascript:void(0);" class="button is-checked" data-filter="*">show all</a> 
                                
                            <?php 
                            function sortByName($a, $b)
                            {
                                $a = strtolower($a->insta_company_name);
                                $b = strtolower($b->insta_company_name);

                                if ($a == $b)
                                {
                                    return 0;
                                }

                                return ($a < $b) ? -1 : 1;
                            }
      
							usort($company_list, 'sortByName');

                            //echo "<pre>"; print_r($company_list); die;
                            if(!empty($company_list)) {
								foreach(range('A', 'Z') as $char)
								{
									echo '<a data-filter=".company-'.strtolower($char).'" href="javascript:void(0);">'.$char.'</a>';
								} 
							}
							?>
                            
                                
                            </p>
                           
                          
                            <div id="joblist" class="grid company-list-ul">
                            <?php $i=0;
                            foreach($company_list as $val)
                            { 
                             $first_char = strtoupper($val->insta_company_name[0]);
                             if($i==0)
                             {
                                 $i++;
                                 $check_char = $first_char;
                                 echo '<div class="grid-item col-md-4 company-'.strtolower($val->insta_company_name[0]).' no-padding-left" data-category="company-'.strtolower($val->insta_company_name[0]).'"><div id="'.strtoupper($val->insta_company_name[0]).'" class="company-alphabet"><span>'.$first_char.'</span></div><ul class="alphabetical-list-ul list-unstyled">';
                                    
                             }
                             else if($first_char !=  $check_char && $first_char !=  strtolower($check_char))
                             {
                                 $check_char = $first_char;
                                 echo '</ul></div><div class="grid-item col-md-4 company-'.strtolower($val->insta_company_name[0]).' no-padding-left" data-category="company-'.strtolower($val->insta_company_name[0]).'"><div id="'.strtoupper($val->insta_company_name[0]).'" class="company-alphabet"><span>'.$first_char.'</span></div><ul class="alphabetical-list-ul list-unstyled">';
                             }
                                
                             echo '<li><a href="'.base_url().'company-jobs/'.$val->insta_company_id.'/'.$val->insta_company_name.'/" title="'.$val->insta_company_name.'"> '.$val->insta_company_name.'</a></li>';
                                
                            }
                            echo "</div>";
                            ?>
                                
                            </div>
                        </div>
                        <!-- <div class="col-md-3 no-padding">
                            <ul class="list-unstyled featured-ul">
                                <li>
                                    <div class="featured-jobs">
                                        <h3 class="featured-jobs-title">FEATURED JOBS</h3>
                                        <span class="green-border"></span>
                                        <div class="featured-jobs-image text-center">
                                            <a href="javascript:void(0);"><img class="img-responsive social-img" src="<?php //echo IMAGE_PATH; ?>featured-company.png" alt="Featured Company"></a>
                                        </div>
                                        <h4 class="featured-post-title">Program Manager</h4>
                                        <p>
                                            <i class="fa-style fa fa-map-marker" aria-hidden="true"></i>
                                            Guragaon India
                                        </p>
                                        <p>
                                            <i class="fa-style fa fa-money" aria-hidden="true"></i>
                                            <i class="fa fa-inr" aria-hidden="true"></i>
                                            45000 - 
                                            <i class="fa fa-inr" aria-hidden="true"></i>
                                            50000
                                        </p>
                                        <div class="featured-jobs-link">
                                            <a class="subscribe-link trans" href="javascript:void(0);" title="View Job">VIEW JOB</a>
                                            <a class="subscribe-link trans" href="javascript:void(0);" title="Apply For Job">APPLY FOR JOB</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="featured-iframe">
                                        <img class="img-responsive" src="<?php //echo IMAGE_PATH; ?>featured-product.jpg" alt="featured product"/>
                                    </div>
                                </li>
                                <li>
                                    <div class="featured-iframe">
                                        <img class="img-responsive" src="<?php //echo IMAGE_PATH; ?>featured-product.jpg" alt="featured product"/>
                                    </div>
                                </li> 
                            </ul>
                        </div> -->
                        <?php $this->load->view('common/inner-sidebar'); ?>

                </div>
            </div>
        </div>
