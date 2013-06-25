<?php
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '465444696840864',
  'secret' => '653bd1649461dd10ac338a030b9d0d79',
));

$user_profile = $facebook->api('/rushhourdortmund');
$user_profile2 = $facebook->api('/VillageDortmund/events?fields=start_time,description,cover,id');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>InsertToDB</title>
  </head>
  <body>

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
		  	
			
			echo $infoArr1['location']['city']; 
		  
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