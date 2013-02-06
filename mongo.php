<!-- PHP Mongo Docs: http://php.net/manual/en/class.mongodb.php -->
<html>
<body>
<h1>MongoHQ Test</h1>
<?php
  //$cityid = $_GET['city'];
  $cityid = 'Dortmund';
  
  try {
    // connect to MongoHQ assuming your MONGOHQ_URL environment
    // variable contains the connection string
    $connection_url = getenv("MONGOHQ_URL");
 
    // create the mongo connection object
    $m = new Mongo($connection_url);
 
    // extract the DB name from the connection path
    $url = parse_url($connection_url);
    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
 
    // use the database we connected to
    $db = $m->selectDB($db_name);
	
	// get Collection
	$collection = $db->events;
    echo "<h2>Collections</h2>";
    echo "<ul>";
	echo "<li>" .  $db->events . "</li>";
    echo "</ul>";
	
	date_default_timezone_set('UTC');
	$heute = date("Y-m-d");
	$start = new MongoDate(strtotime($heute));
		
	$criteria = array(
	    'checked' => 1,
		'city' => $cityid,
	    'datum' => array( 
	          '$gte' => $start
	       ),
	  );
	  
	$cursor = $collection->find($criteria);
	echo $cursor->count() . ' document(s) found. <br/>';

	foreach ($cursor as $doc) {
		$rows[] = $doc;
	}
	
	
		
	echo "<h2>Show result as an array:</h2>";
	echo "<pre>";
	print_r($rows);
	echo "</pre>";

	echo "<h2>Show result as JSON:</h2>";
	echo "<pre>";
	echo json_encode($rows);
	echo "</pre>";

 
    // print out last collection
    if ( $collection_name != "" ) {
      $collection = $db->selectCollection($collection_name);
      echo "<h2>Documents in ${collection_name}</h2>";
 
      // only print out the first 5 docs
      $cursor = $collection->find();
      $cursor->limit(5);
      echo $cursor->count() . ' document(s) found. <br/>';
      foreach( $cursor as $doc ) {
        echo "<pre>";
        var_dump($doc);
        echo "</pre>";
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
</body>
</html>