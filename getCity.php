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
	
    //$collection = $db->events;
    //$cursor = $collection->find();
    //$cursor->sort(array('city' => 1));
    //foreach ($cursor as $obj) {
    //  $rows[] = $obj['city'];
    //}
    //echo json_encode($rows);

	  // get All Citys
	  $citys = $db->command(array("distinct" => "events", "key" => "city"));

      $obj = json_decode($citys, true);

      var_dump($obj);
      ksort($citys['values']);
      var_dump($obj);


      echo json_encode($obj);

	
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
