<?php
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '465444696840864',
  'secret' => '653bd1649461dd10ac338a030b9d0d79',
));

// Get User ID
$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
	
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
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>InsertToDB</title>
  </head>
  <body>
      <h1>InsertVeranstaltungAutomatic</h1>

      <?php if ($user): ?>
        <a href="<?php echo $logoutUrl; ?>">Logout</a>
      <?php else: ?>
        <div>
          Login:
          <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
        </div>
      <?php endif ?>
	  
	  
      <?php if ($user): ?>
        <h3>You</h3>
        <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
		
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
  		  	$infoArr1 = $facebook->api('/'.$pages);
  			$infoArr2 = $facebook->api('/'.$pages.'/events?fields=start_time,description,cover,id');
  		  
			echo $infoArr1['location']['city'], '<br>';; 
			echo $infoArr1['location']['street'], '<br>';;
		  	foreach($infoArr2['data'] as $infoArr2) {
		  	  echo $infoArr2['start_time'], '<br>';
		  	  echo $infoArr2['id'], '<br>';
			  //echo $infoArr2['description'], '<br>';
			  echo $infoArr2['cover']['source'], '<br>';
			  echo '<br>';
		  	}
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
      <?php else: ?>
        <strong><em>You are not Connected.</em></strong>
      <?php endif ?>

<?php 

?>	
  </body>
</html>