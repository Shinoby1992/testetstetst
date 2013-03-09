<?php header('Content-Type: application/json; charset=utf-8');
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
	$zeitzone = -4;
	$format = 'Y-m-d';
	$timestamp = time();
	$timestamp += (3600*intval($zeitzone)); 
	$heute = gmdate($format, $timestamp);
	$start = new MongoDate(strtotime($heute));

	//Create criteria for find	
	$criteria = array(
	    'checked' => 1,
	    'datum' => array( 
	          '$lt' => $start
	       ),
	  );
		
	$r = $collection->remove($criteria, array('safe' => true));
  	echo 'Removed ' . $r['n'] . ' document(s).';

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