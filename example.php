<?php
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '465444696840864',
  'secret' => '653bd1649461dd10ac338a030b9d0d79',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/VillageDortmund');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

//$user_profile = $facebook->api('/rushhourdortmund?fields=location');
$user_profile2 = $facebook->api('/VillageDortmund/events?fields=start_time,description,cover,id');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>InsertToDB</title>
  </head>
  <body>
      <h1>php-sdk</h1>

      <?php if ($user): ?>
        <a href="<?php echo $logoutUrl; ?>">Logout</a>
      <?php else: ?>
        <div>
          Login using OAuth 2.0 handled by the PHP SDK:
          <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
        </div>
      <?php endif ?>
	  
	  
      <?php if ($user): ?>
        <h3>You</h3>
        <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

        <h3>Your User Object (/me)</h3>
        <pre><?php print_r($user_profile); ?></pre>
      <?php else: ?>
        <strong><em>You are not Connected.</em></strong>
      <?php endif ?>
	  
	  
	  
	  
	  
	  
	  
      <?php echo $user_profile; ?>

<?php 
	  try {
	    $connection_url = getenv("MONGOHQ_URL");
	    $m = new Mongo($connection_url);
	    $url = parse_url($connection_url);
	    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
 
	    // use the database we connected to
	    $db = $m->selectDB($db_name);

		  // get All Citys
		  $pages = $db->command(array("distinct" => "pages", "key" => "name"));
		  		  
		  foreach($pages['values'] as $pages) {
		  	//$infoArr1 = $facebook->api('/'.$pages);
		  	
			
			//echo $infoArr1['location']['city']; 
		  
		  }
		  
		  
	    // disconnect from server
	    $m->close();
	  } catch ( MongoConnectionException $e ) {
	    die('Error connecting to MongoDB server');
	  } catch ( MongoException $e ) {
	    die('Mongo Error: ' . $e->getMessage());
	  } catch ( Exception $e ) {
	    die('Error: ' . $e->getMessage());
	  }
?>

    <?php echo $user_profile['location']['city']; ?>
	<?php echo $user_profile['location']['street'];?>
	
	
	
  	<?php	  
  		//foreach($user_profile2['data'] as $user_profile2) {
      	  //echo $user_profile2['start_time'], '<br>';
	  	  //echo $user_profile2['id'], '<br>';
	  
	   	  //echo $user_profile2['description'], '<br>';
	      //echo $user_profile2['cover']['source'], '<br>';
  	//}
  	?>
	
	
	
	
	
	
	
	
	
	
  </body>
</html>