<?php
$client_id = '55162301923-981apeig3mr2r7i3o01gqp05vmb3u14l.apps.googleusercontent.com';
$client_secret = 'qwNB6fCBFKhs7AUYQXvxotDa';
$redirect_uri = 'http://staging3.instarefr.com/invite-friends';
$max_results = 25;

$auth_code = $_GET["code"];

function curl_file_get_contents($url)
{
 $curl = curl_init();
 $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
 
 curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.	
 
 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
 curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	//To stop cURL from verifying the peer's certificate.
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

$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
$xmlresponse =  curl_file_get_contents($url);
$contacts = json_decode($xmlresponse,true);
if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
{
	echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
	exit();
}

$return = array();
		if (!empty($contacts['feed']['entry'])) {
			
		foreach($contacts['feed']['entry'] as $contact) {
           
            //retrieve user photo
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
				
				if($image==='Photo not found')
				{
						 //retrieve Name and email address  
						$return[] = array (
							'name'=> $contact['title']['$t'],
							'email' => $contact['gd$email'][0]['address'],
							'img_url' => 'images/user.png',
						);
				}
				else
				{
					 //retrieve Name and email address  
						$return[] = array (
							'name'=> $contact['title']['$t'],
							'email' => $contact['gd$email'][0]['address'],
							'img_url' => $url,
						);
				}
			
		

		}	
		$google_contacts = $return;			//returning all data to avariable
	
	
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Invite Friends Using Google Contact API and oAuth</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
      p {margin:10px;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
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
  </head>
  <body style="background:#ccc;">
  
    <div style="width:50%; margin:0 auto; height:auto; border-radius:5px; background:#fff; padding:10px; text-align:center;">
    
    <h6>www.Instarefr.com</h6>
      <h3 style="text-align:center;">Invite your gmail contacts!</h3>
      
      <h4 style="text-align:center;">Click the Invite Button and Invite Friends.</h4>
      	
      <a class='login' href='?logout'><img style='height:35px;' src='https://field.bayada.com/_layouts/15/Bayada.SharePoint.ClaimsProvider/..%5Cimage%5Cgoogle_logout_button.png' /></a>
      <br/>
       <?php
	   $i=0;
       foreach($google_contacts as $list)
	{
		?>
       <div style="width:98%; padding:5px; border:1px solid #ccc;" class="inviteDiv<?php echo $i;?>">
       
       	<div style="width:101px; float:left; height:101px; padding:5px; border:1px solid #333;">
        	<img src="<?php echo $list['img_url'];?>" height="96" width="96"/>
        </div>
        
        <div style="width:80%; float:left; text-align:left;">
        <p><b>Name :</b><?php if($list['name']==''){ echo $list['email'];}else{ echo $list['name'];}?></p>
        <p><b>Email :</b><?php echo $list['email'];?></p>
        <p id="btn<?php echo $i;?>"><button type="button" onclick="invite_friends('<?php echo $list['name']?>,<?php echo $list['email'];?>,<?php echo $i;?>');">Invite</button></p>
        
        
        </div>
       <br clear="all"/>
       
       </div>
       <?php
	   $i=$i+1;
	}
	?>
        
      
      
      <p>Go to Home Page: <a href="<?php echo base_url(); ?>">www.instarefr.com </a></p>
	</div>
    <?php
		}
		else
		{
			header("location:index.php");
		}
		?>
        
  </body>
</html>