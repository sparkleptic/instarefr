<!-- Current Page Info-->
       

        <div id="main" class="site-content">
            <div class="container">
            <?php $this->load->view('common/common-msg'); ?>
                <div class="row">
                    <div class="col-md-12">
                    
                        <div class="faq-content">
                            <div class="text-center">
                                <h2 class="section-title">Blog</h2>
                                <span class="green-border"></span>
                            </div>

                            <?php if(!empty($article)) {
                                foreach($article as $val)
                                {
                                    ?>
                            <div class="pb-20">
                                <p><strong><?php echo $val->insta_article_title; ?></strong></p>
                                <p><?php echo $val->insta_article_description; ?></p>
                            </div>
                                    <?php
                                }
                                } ?>
                           

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>