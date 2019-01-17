<div id="dialog" title="Google Invite" style="display:none; min-height:auto!important;">

 <script type="text/javascript">
        function invite_friends(nameemail)
        {
          var res = nameemail.split(",");
          
          var name = res[0];
          
          var email = res[1];
          
          var count = res[2];
          
          
          
          var dataString = 'name=' + name + '&email=' + email + '&page=invite';

                $.ajax({
                    type: "POST",
                     url: "<?php  echo site_url('points/invite_google_contact'); ?>",
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
  <style type="text/stylesheet">    
    div#dialog p {
        font-size: 12px;
    }
    .ui-widget-content {
    max-width: 100% !important;
}
  </style>

  <link href="<?php echo CSS_PATH; ?>google_invitation.css" rel="stylesheet" type="text/css" media="all">
    <form id="collect_emails" action="<?php  echo site_url('points/invite_google_contact'); ?>" method="post">

    <div class="box-wrapper collector">
    <div class="search-box">
        <div class="unselect-all">
            <a href="#" class="unselect" style="display: none">Unselect All</a>
            <a href="#" class="select" style="display: block">Select All</a>
        </div>
        <div id="friendsSearch" class="textwrapper text-search labeloverlaywrapper">
            <input class="form-text required defaultInvalid toggleval" placeholder="Search friends" id="searchinput" style="" type="text">
        </div>
    </div>
    <div class="scroll-box">
        <table id="FriendsList" class="friends_container" cellpadding="0" cellspacing="0">
            <tbody>
            
        
            </tbody>
        </table>
        
        
    </div><!--scrollbox-->
</div><!--box-wrapper-->

      <button type="submit" id="submit-button">Send</button>
</form>
    
       
  
        <script type="text/javascript">   
        $('.ui-dialog-titlebar-close').click(function () {
          window.location.href = "<?php echo base_url().'points';?>";
        });  
            
        </script>
               
</div>
<script src="https://apis.google.com/js/client.js"></script>
   
    <script>
      var all_user = [];
      function auth() {
		  var session_id = "<?php echo $this->session->user_session['email']; ?>";
				if(session_id === '')
				{
					$('#login_msg').html('<span>Please Login first</span>');
        			document.getElementById('id01').style.display='block';
				}else{
					var config = {
					  'client_id': '55162301923-fhh26o3svqut1r0141qrmld2l67t9mjt.apps.googleusercontent.com',
					  'scope': 'https://www.google.com/m8/feeds'
					};
					gapi.auth.authorize(config, function() {
					  fetch(gapi.auth.getToken());
					});
				}
        
      }
      function fetch(token) {
        token['g-oauth-window'] = null;
        $.ajax({
          url: 'https://www.google.com/m8/feeds/contacts/default/full?max-results=500',
          dataType: 'jsonp',
          data: token
        }).done(function(data) {
            $("#dialog").dialog({
                 width: 600,
                autoOpen: true,
                dialogClass: "test",
                modal: true,
                responsive: true,
                height: 450
              });

             $( "#dialog" ).dialog( "open" );
            var xml = $.parseXML(data);
            var arrayFromPHP = '<?php if(!empty($invited_emails)) echo json_encode($invited_emails); ?>';
            if (arrayFromPHP.length != 0)
            {
              var newarrayFromPHP = $.parseJSON(arrayFromPHP);
            }else{
              var newarrayFromPHP = new Array();
            }
            
            console.log(arrayFromPHP);
                $(xml).find('entry').each(function() {

                 
                    var entry = $(this);
                    var name  = entry.find('title').text();
                    var email = entry.find('email, gd\\:email').attr('address');
                    //var href = entry.find('link[type="image/*"]').attr('href');
                    //var imageUrl = href + '&' + $.param(token); 
                 if( $.inArray(email, newarrayFromPHP) == -1 ){

                    var li = '<tr class=""><td class="checkbox-container">';
                    if(name != "")
                    {
                       li += '<input value="'+name+'='+email+'" name="google_friend[]" type="checkbox">';
                    }else{
                      li += '<input value="'+email+'" name="google_friend[]" type="checkbox">';
                    }
                    li += '</td><td class="user-img">';
                    li += '</td><td class="last-child">';
                    if(name != "")
                    {
                          li += name;
                    }
                    li += '<em>'+email+'</em>';
                    li += '</td></tr>';    
                     $('#FriendsList tbody').append(li);          
                 }

                 });
                  
                   var script = document.createElement('script');
                   script.src = '<?php echo JS_PATH; ?>google_invitation.js';
                   script.type = 'text/javascript';
                   var head = document.getElementsByTagName("head")[0];
                   head.appendChild(script);
                
        });
      }
    </script>