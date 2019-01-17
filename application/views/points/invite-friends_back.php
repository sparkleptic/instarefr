<div id="dialog" title="Google Invite" style="display:none; min-height:auto!important;">
<?php
if(!empty($code))
{
    $client_id = '55162301923-981apeig3mr2r7i3o01gqp05vmb3u14l.apps.googleusercontent.com';
    $client_secret = 'qwNB6fCBFKhs7AUYQXvxotDa';
    $redirect_uri = base_url().'invite-friends';
    $max_results = 500;

    $auth_code = $code;

    function curl_file_get_contents($url)
    {
     $curl = curl_init();
     $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
     
     curl_setopt($curl,CURLOPT_URL,$url);   //The URL to fetch. This can also be set when initializing a session with curl_init().
     curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);    //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
     curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);   //The number of seconds to wait while trying to connect.    
     
     curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
     curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);  //To follow any "Location: " header that the server sends as part of the HTTP header.
     curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
     curl_setopt($curl, CURLOPT_TIMEOUT, 10);   //The maximum number of seconds to allow cURL functions to execute.
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //To stop cURL from verifying the peer's certificate.
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
     
     $contents = curl_exec($curl);
     curl_close($curl);
     return $contents;
    }

    $fields=array(
        'code'=>  urlencode($auth_code),
        'client_id'=>  urlencode($client_id),
        'client_secret'=>  urlencode($client_secret),
        'redirect_uri'=>  urlencode($redirect_uri),
        'grant_type'=>  urlencode('authorization_code')
    );
    $post = '';
    foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
    $post = rtrim($post,'&');

    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
    curl_setopt($curl,CURLOPT_POST,5);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    $result = curl_exec($curl);
    curl_close($curl);

    $response =  json_decode($result);
    $accesstoken = $response->access_token;

    $url = 'https://www.google.com/m8/feeds/contacts/default/full?alt=json&v=3.0&oauth_token='.$accesstoken;
    $xmlresponse =  curl_file_get_contents($url);
    $contacts = json_decode($xmlresponse,true);
    if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
    {
        echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
        exit();
    }

    
        if (!empty($contacts['feed']['entry'])) {
            
       
        ?>

    
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
            <?php
            $i=0;
            if (!empty($contacts['feed']['entry'])) {
            foreach($contacts['feed']['entry'] as $contact)
            {
                if (isset($contact['link'][0]['href'])) {
                    
                    $url =   $contact['link'][0]['href'];
                    
                    $url = $url . '&access_token=' . urlencode($accesstoken);
                    
                    $curl = curl_init($url);

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
                    curl_setopt($curl, CURLOPT_VERBOSE, true);
            
                    $image = curl_exec($curl);
                    curl_close($curl);
                    
                    
                }
                if(!in_array($contact['gd$email'][0]['address'], $invited_emails)) {
                ?>
                    <tr class="">
                        <td class="checkbox-container">
                            <input value="<?php if($contact['title']['$t']==''){ echo $contact['gd$email'][0]['address'];}else{ echo $contact['title']['$t'].'='.$contact['gd$email'][0]['address'];}?>" name="google_friend[]" type="checkbox">
                        </td>
                        <td class="user-img">
                        <img src="<?php if($image==='Photo not found') { echo 'images/user.png'; }else{ echo $url; }?>"/>
                        </td>
                        <td class="last-child">
                        <?php if($contact['title']['$t']==''){ echo $contact['gd$email'][0]['address'];}else{ echo $contact['title']['$t'];}?>
                            <em><?php echo $contact['gd$email'][0]['address'];?></em>
                        </td>
                    </tr>
            <?php
               $i=$i+1;
                    }
                }
            }
           ?>
        
            </tbody>
        </table>
        <script src="<?php echo JS_PATH; ?>google_invitation.js"></script>
        
    </div><!--scrollbox-->
</div><!--box-wrapper-->

      <button type="submit" id="submit-button">Send</button>
</form>
    
        <?php
        }
        else
        {
            header("location:".base_url()."points/");
        }
        ?>
        
  
        <script type="text/javascript">
        $("#dialog").dialog({
             width: 600,
            autoOpen: true,
            dialogClass: "test",
            modal: true,
            responsive: true,
            height: 450
          });

        $( "#dialog" ).dialog( "open" );
            
        $('.ui-dialog-titlebar-close').click(function () {
          window.location.href = "<?php echo base_url().'points';?>";
        });  
            
        </script>
                <?php
        }
        ?>
</div>