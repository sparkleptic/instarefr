<!-- Current Page Info-->
		<script src="<?php echo JS_PATH.'facebook_all.js'; ?>"></script>
		<?php 
		$email_encoded = rtrim(strtr(base64_encode($this->session->user_session['email']), '+/', '-_'), '=');
		$msg_url = base_url()."instarefr_invitation/".$email_encoded;
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
					var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
	
			FB.ui({
		  	method: 'share',
			 mobile_iframe: true,
					  href: '<?php echo $msg_url; ?>',
					  redirect_uri: '<?php echo base_url().'points'; ?>',
					  caption:'Please click on link and connect with Instarefr', description: '<?php echo $this->session->user_session['first_name']." ".$this->session->user_session['last_name']." has invited you to become a part of this wonderful community.Employees from top companies are waiting for you.Join us today! ".$msg_url; ?>'
			}, function(response){});
		
				}else{
					FB.ui({ method: 'send',name: 'Instarefr Invitation',link: '<?php echo $msg_url; ?>',redirect_uri: '<?php echo base_url().'points'; ?>',caption:'Please click on link and connect with Instarefr', description: '<?php echo $this->session->user_session['first_name']." ".$this->session->user_session['last_name']." has invited you to become a part of this wonderful community.Employees from top companies are waiting for you.Join us today! ".$msg_url; ?>', message: '<?php echo $this->session->user_session['first_name']." ".$this->session->user_session['last_name']." has invited you to become a part of this wonderful community.Employees from top companies are waiting for you.Join us today! ".$msg_url; ?>'});
				}

    
					
				}
				
			}

			function check_session(type)
			{
				console.log(type);
				var session_id = "<?php echo $this->session->user_session['email']; ?>";
				if(session_id === '')
				{
					$('#login_msg').html('<span>Please Login first</span>');
        			document.getElementById('id01').style.display='block';
				}else if(type=='google'){
					 window.location.href = "https://accounts.google.com/o/oauth2/auth?client_id=55162301923-981apeig3mr2r7i3o01gqp05vmb3u14l.apps.googleusercontent.com&redirect_uri=http://staging3.instarefr.com/invite-friends&scope=https://www.google.com/m8/feeds/&response_type=code";
				}else if(type=='twitter'){
					window.open('https://twitter.com/intent/tweet?text= <?php echo $this->session->user_session['first_name']." ".$this->session->user_session['last_name']." has invited you.Employees from top companies are waiting. Join us today! ".$msg_url; ?>&image=<?php echo IMAGE_PATH; ?>insta-more-than-50.png', 'twitterwindow','left=400,top=200,width=600,height=300,toolbar=0,resizable=1');
				}else if(type=='linkedin'){
					window.open('https://www.linkedin.com/shareArticle?url=<?php echo $msg_url; ?>&title=<?php echo $this->session->user_session['first_name']." ".$this->session->user_session['last_name']." has invited you to become a part of this wonderful community.Employees from top companies are waiting for you.Join us today! "; ?>&image=<?php echo IMAGE_PATH; ?>insta-more-than-50.png', 'linkedinwindow','left=400,top=200,width=600,height=700,toolbar=0,resizable=1');
				}
			}
		</script>

		

		


		<div class="rules-image-container">
			<div class="container">
			<?php $this->load->view('common/common-msg'); ?>
				<!-- Rule 1 -->
				<div class="rules-img-row row">
					<div class="col-md-6 col-sm-6 rule-text-1 rules-invert">
						<div class="small-title">Rule 1</div>
						<span class="green-border"></span>
						<p>Invite people. Bigger the community, better the opportunity.</p>
						<p>Get 50 credit points every time, whenever your friends join us.</p>
						
						<div class="text-center">
							<div class="rules-invite-wrap"> 
								<p class="text-social text-social-title">Invite via Social Media</p>
								<p>
									<a href="#" onclick="FacebookInviteFriends();" style="color:#FFF; text-decoration:none;" class="refer-social-link refer-facebook button_default xxlarge round3 facebookk"></a>

									<a href='#' onclick="auth();" class="refer-social-link refer-google"></a>

									<a class="refer-social-link refer-linkedin" href="#" onclick="check_session('linkedin');"></a>
									<a class="refer-social-link refer-tweeter" onclick="check_session('twitter');" href="#"></a>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
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
						<!-- <p>Forward us the latest job openings and we will do that for you. You still get the credit points.</p> -->
						<p>Forward us the latest job openings at <a href="mailto:newopening@instarefr.com">newopening@instarefr.com</a> and we will do that for you. You still get the credit points.</p>
					</div>
					<div class="col-md-6 col-sm-6">
						<img class="img-responsive" alt="Instarefer-rule-3" src="<?php echo IMAGE_PATH; ?>rule-3.jpg"/>
					</div>
				</div>
			</div>
			
			<!-- Rule 4 -->
			<div class="container-fluid">
				<div class="row rule-grey-bg">
					<div class="col-md-12 col-sm-12 rules-img-row-12 rule-grey-bg" style="padding-top: 25px;">
						<div class="pb-20 text-center">
							<p class="section-title">Excited about what we are doing?</p>
							<p class="small-title">Want more credits instantly?</p>
							<span class="green-border"></span>
						</div>
						<form class="buy-points-form" method="post" action="<?php echo base_url().'points/buy_now/'; ?>">
							<div class="refer-radio">
								<label><input class="fl-left" type="radio" name="buy_points" value="50-29" required><span>50 credits points for Rs <del>49</del> 29. (You save 40% )</span></label>
							</div>
							<div class="refer-radio">
								<label><input class="fl-left" type="radio" name="buy_points" value="300-149" required><span>300 credit points for Rs <del>299</del> 149. (You save  50% )</span></label>
							</div>
							<div class="refer-radio">
								<label><input class="fl-left" type="radio" name="buy_points" value="500-199" required><span>500 credit points for Rs <del>499</del> 199. (You save 60%)</span></label>
							</div>
							<p class="text-center">
								<a href=""><input type="submit" class="btn btn-primary btn-md" name="buy_now" value="Buy Now"></a>
							</p>
						</form>
					</div>
					<!-- <div class="col-md-6 col-sm-6 text-center rule-white-bg">
					<div class="small-title">Rule 4</div>
						<span class="green-border"></span>
						<img class="img-responsive" alt="Instarefer-rule-4" src="<?php //echo IMAGE_PATH; ?>instarefer-rule-5.png" style="display: inline-block;"/><br><br><br>
					</div>	 -->	
				
				</div>
			</div>

			<div class="container hidden">
				<!-- Rule 5 -->
				<div class="rules-img-row row">
					<div class="col-md-12">
						<img class="img-responsive" alt="Instarefer-rule-5" src="<?php echo IMAGE_PATH; ?>instarefer-rule-5.jpg"/>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('points/invite-friends'); ?>