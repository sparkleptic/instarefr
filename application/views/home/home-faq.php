<section class="faq-home" id="faq">
<div class="container text-center">
<div class="faq-main-div row-eq-height row" id="faq-main-div">
<div class="faq-sub-div">
<div class="help" id="help">
<h3 class="section-title">GOT A QUESTION?</h3>
<span class="green-border"></span>
<p class="help-title" id="help-title">We are here to help. Check out our</p>
<p class="help-desc" id="help-desc">
Have a doubt. See our FAQ section for more details.
</p>
<a href="<?php echo base_url().'faq/'; ?>" class="faq-link trans">FAQ</a>
</div>
</div>
<div class="news-letter">
<h3 class="section-title">Contact Us</h3>
<span class="green-border"></span>
<div id="contact-us-suc-msg"><?php $this->load->view('common/common-msg'); ?></div>
<form method="post" class="news-letter-form" id="news-letter-form">
<input type="text" name="insta_contact_us_name" placeholder="Enter your name" class="news-letter-input" id="insta_contact_us_name" required>
<input type="email" name="insta_contact_us_email" placeholder="Enter your Email-id" class="news-letter-input" id="insta_contact_us_email" required>
<textarea class="news-letter-input" name="insta_contact_us_message" placeholder="Enter your Message" required></textarea>
<div><input type="submit" name="subscribe" value="SUBMIT" class="news-letter-submit" id="news-letter-submit"></div>
</form>
</div>
</div>
</div>
</section>