		<!-- Current Page Info-->
		<script src="http://connect.facebook.net/en_US/all.js"></script>
		<?php 
		$email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');
		$msg_url = base_url()."/instarefr_invitation/".$email_encoded;
		?>
		<div id="fb-root"></div>            
		<script type="text/javascript">
			/* facebook invitation */
			if (top.location!= self.location) {
				top.location = self.location
			}
			FB.init({ 
			    appId:'1460430350907084', cookie:true, status:true, xfbml:true 
			});
			function FacebookInviteFriends()
			{
				var session_id = "<?php echo $this->session->user_session['email']; ?>";
				if(session_id === '')
				{
					$('#login_msg').html('<span>Please Login first</span>');
        			document.getElementById('id01').style.display='block';
				}else{
					FB.ui({ method: 'send',name: 'Instarefr Invitation',link: '<?php echo base_url(); ?>',redirect_uri: '<?php echo base_url().'points'; ?>',caption:'Please click on link and connect with Instarefr', description: '<?php echo $msg_url; ?>'});
				}
				
			}

			function check_session()
			{
				var session_id = "<?php echo $this->session->user_session['email']; ?>";
				if(session_id === '')
				{
					$('#login_msg').html('<span>Please Login first</span>');
        			document.getElementById('id01').style.display='block';
				}else{
					window.location.href = "https://accounts.google.com/o/oauth2/auth?client_id=55162301923-981apeig3mr2r7i3o01gqp05vmb3u14l.apps.googleusercontent.com&redirect_uri=http://staging3.instarefr.com/invite-friends&scope=https://www.google.com/m8/feeds/&response_type=code";
				}
			}

			/* google invitation */
			function invite_friends(nameemail)
			{
				var res = nameemail.split(",");

				var name = res[0];

				var email = res[1];

				var count = res[2];



				var dataString = 'name=' + name + '&email=' + email + '&page=invite';
			    $.ajax({
			        type: "POST",
			        url: "invite.php",
			        data: dataString,
			        cache: false,
			        beforeSend: function() {
			            $("#btn"+count).html('');
			    $("#btn"+count).html('<button type="button">Inviting...</button>');
			        },
			        success: function(response) {
			            var response_brought = response.indexOf("invited");
			            if (response_brought != -1) {
			                $("#btn"+count).html('');
			      $("#btn"+count).html('<button type="button">Invited</button>');
			      $(".inviteDiv"+count).fadeOut(500);
			      
			            } else {
			              
			            }
			        }
			    });

			}

		</script>

		<div class="rules-list-container">
			<div class="container">
			<?php $this->load->view('common/common-msg'); ?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h3 class="small-title">POINT RULES</h3>
						<span class="green-border"></span>

						<ol class="rules-list">
							<li>For every invite which is accepted (referral joins ) user gets 50 point. It will have 4 social invite buttons. Invite via Gmail, Linkedin, Facebook and Twitter.</li>
							<li>For every job submitted, user get 100 points.</li>
							<li>For every immediate mail forwarded to us user gets 100 points.</li>
							<li>For every job applied user is deducted with 50 points.</li>
							<li>For every refer users point is deducted with 50 points.</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<div class="rules-image-container">
			<div class="container">
				<!-- Rule 1 -->
				<div class="rules-img-row row">
					<div class="col-md-6 col-sm-6 rule-text-1 rules-invert">
						<div class="small-title">Rule 1</div>
						<span class="green-border"></span>
						<p>Invite people. Bigger the community, better the opportunity.</p>
						<p>Get 50 credit points every time, whenever your friends join us.</p>
						<div class="rules-form-wrap">
							<form class="clearfix">
								<div class="col-md-5 text-social"><p class="unique-refer-title">Your unique referral link.</p></div>
								<div class="col-md-7">
									<input class="unique-refer-link-text" type="text" name="referral-link"/>
								</div>
							</form>
						</div>
						<div class="text-center">
							<div class="rules-invite-wrap"> 
								<p class="text-social text-social-title">Invite your email contacts</p>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<a href="Gmail"><img class="img-responsive" alt="Instarefer-rule-2" src="<?php echo IMAGE_PATH; ?>gmail-logo.png"/></a>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<a href="Yahoo"><img class="img-responsive" alt="Instarefer-rule-2" src="<?php echo IMAGE_PATH; ?>yahoo-logo.jpg"/></a>
									</div>
								</div>
							</div>
							
							<div class="rules-invite-wrap"> 
								<p class="text-social text-social-title">Invite via Social Media</p>
								<p>
									<a href="#" onclick="FacebookInviteFriends();" style="color:#FFF; text-decoration:none;" class="refer-social-link refer-facebook button_default xxlarge round3 facebookk"></a>

									<a href='#' onclick="check_session();" class="refer-social-link refer-google"></a>

									<a class="refer-social-link refer-linkedin" href="Linkedin"></a>
									<a class="refer-social-link refer-tweeter" href="Twitter"></a>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6" style="position: unset;">
						<img class="img-responsive" alt="Instarefer-rule-1" src="<?php echo IMAGE_PATH; ?>rule-1.jpg"/>
					</div>
				</div>
				<!-- Rule 2 -->
				<div class="rules-img-row row">
					<div class="col-md-6 col-sm-6 rule-text">
						<div class="small-title">Rule 2</div>
						<span class="green-border"></span>
						<p>Post the latest job openings of your company and help the community.</p>
						<p>Get 100 Credit points.</p>
					</div>
					<div class="col-md-6 col-sm-6">
						<img class="img-responsive" alt="Instarefer-rule-2" src="<?php echo IMAGE_PATH; ?>rule-2.jpg"/>
					</div>
				</div>
				<!-- Rule 3 -->
				<div class="rules-img-row row">
					<div class="col-md-6 col-sm-6 rule-text rules-invert">
						<div class="small-title">Rule 3</div>
						<span class="green-border"></span>
						<p>Don’t have time to post the jobs?</p>
						<p>Forward us the latest job openings and we will do that for you. You still get the credit points.</p>
					</div>
					<div class="col-md-6 col-sm-6">
						<img class="img-responsive" alt="Instarefer-rule-3" src="<?php echo IMAGE_PATH; ?>rule-3.jpg"/>
					</div>
				</div>
				<!-- Rule 4 -->
				<div class="rules-img-row row">
					<div class="col-md-6 col-sm-6 rule-text">
						<div class="small-title">Rule 4</div>
						<span class="green-border"></span>
						<p>Share Jobs from our portal and let others discover the new opportunities. Get 5 credit points every time you share on social media.</p>
					</div>
					<div class="col-md-6 col-sm-6">
						<img class="img-responsive" alt="Instarefer-rule-4" src="<?php echo IMAGE_PATH; ?>rule-4.jpg"/>
					</div>
				</div>
			</div>

			<div class="rules-img-row-6">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="pb-20">
								<p class="section-title">Excited about what we are doing?</p>
								<p class="small-title">Want more credits instantly?</p>
								<span class="green-border"></span>
							</div>
							<form method="post" action="<?php echo base_url().'points/buy_now/'; ?>">
								<div class="refer-radio">
									<label><input type="radio" name="buy_points" value="50-29" required>50 credits points for Rs <del>49</del> 29. (You save 40% )</label>
								</div>
								<div class="refer-radio">
									<label><input type="radio" name="buy_points" value="300-149" required>300 credit points for Rs <del>299</del> 149. (You save  50% )</label>
								</div>
								<div class="refer-radio">
									<label><input type="radio" name="buy_points" value="500-199" required>500 credit points for Rs <del>499</del> 199. (You save 60%)</label>
								</div>
								<p class="text-center">
									<a href=""><input type="submit" class="btn btn-primary btn-md" name="buy_now" value="Buy Now"></a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<!-- Rule 5 -->
				<div class="rules-img-row row">
					<div class="col-md-12">
						<img class="img-responsive" alt="Instarefer-rule-5" src="<?php echo IMAGE_PATH; ?>instarefer-rule-5.jpg"/>
					</div>
				</div>
			</div>
		</div>

		