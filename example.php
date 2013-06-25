<?php
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '465444696840864',
  'secret' => '653bd1649461dd10ac338a030b9d0d79',
));

$user_profile = $facebook->api('/VillageDortmund');
$user_profile2 = $facebook->api('/VillageDortmund/events?fields=start_time,description,cover,id');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>InsertToDB</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>

    <?php echo $user_profile['location']['city']; ?>
	<?php echo $user_profile['location']['street'];?>
	
  	<?php	  
  		foreach($user_profile2['data'] as $user_profile2) {
      	  //echo $user_profile2['start_time'], '<br>';
	  	  //echo $user_profile2['id'], '<br>';
	  
	   	  //echo $user_profile2['description'], '<br>';
	      //echo $user_profile2['cover']['source'], '<br>';
  	}
  	?>
	
	
  </body>
</html>