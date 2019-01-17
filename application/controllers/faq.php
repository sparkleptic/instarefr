<!-- Recent Jobs In Your Area -->
        <div class="recent-jobs-section">
            <div class="container">
                <div class="row">
                     <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
                    <section class="spotlight-right col-md-8">
                        <h3 class="section-title spotlight-title">BLOG</h3>
                        <span class="green-border"></span>
                        <div class="recent-jobs" id="recent-jobs">
                          
					     
                              
					          
					         
                        </div> 
                        
                    </section><!--spotlight-right section ends-->

                    <div class="col-md-4">
                        <div class="product-1">
                            <img src="<?php echo IMAGE_PATH; ?>product-1.jpg" alt="Advertisement"/>
                            <span>Your Ads here</span>
                        </div>
                        <div class="product-2">
                            <img src="<?php echo IMAGE_PATH; ?>product-2.jpg" alt="Advertisement"/>
                            <span>Your Ads here</span>
                        </div>                        
                    </div>
                </div>                
            </div>            
        </div>