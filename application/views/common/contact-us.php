<!-- Current Page Info-->
       
        <div id="main" class="site-content">
            <div class="container">
            <div id="contact-us-suc-msg"><?php $this->load->view('common/common-msg'); ?></div>
                <div class="row">
                <?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="contact-us-form">
                            <p>Fields marked with an * are required</p>
                            <form class="row insta-form" method="post" id="news-letter-form">
                                <div class="col-md-6 col-sm-6 col-xs-12 input form-group">
                                    <label>Your Name</label>
                                    <input class="post-job-input-text insta-input" type="text" name="insta_contact_us_name" required="">
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 input form-group">
                                    <label>Your Email</label>
                                    <input class="post-job-input-text insta-input" type="email" name="insta_contact_us_email" required="">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label for="message">Message:</label>
                                    <textarea class="form-control" rows="5" id="message" name="insta_contact_us_message"></textarea>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="submit" class="insta-btn-default transition-300">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>