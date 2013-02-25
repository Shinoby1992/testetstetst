<?php header('Content-Type: application/json; charset=utf-8');
  $cityid = $_GET['city'];
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
	
	// create Current Date in MongoDate format
	$heute = date("Y-m-d");
	$start = new MongoDate(strtotime($heute));

	$zeitzone = -4;
	$format = 'd.m.Y, H:i';
	$timestamp = time();
	$timestamp += (3600*intval($zeitzone)); 
	echo gmdate($format, $timestamp);


	//Create criteria for find	
	$criteria = array(
	    'checked' => 1,
		'city' => $cityid,
	    'datum' => array( 
	          '$gte' => $start
	       ),
	  );
	
	//find query
	$cursor = $collection->find($criteria);
	
	//sort cursor
	$cursor->sort(array('datum'=>1));

	//save in array
	foreach ($cursor as $doc) {
		$rows[] = $doc;
	}
	echo json_encode($rows);

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