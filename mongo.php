<!-- PHP Mongo Docs: http://php.net/manual/en/class.mongodb.php -->
<html>
<body>
<h1>MongoHQ Test</h1>
<?php

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
 
    echo "<h2>Collections</h2>";
    echo "<ul>";
 	$collection = $db->events;
	echo "<li>" .  $db->events . "</li>";
    echo "</ul>";

	$obj = $collection->findOne();
	echo "<pre>";
	print_r($obj);
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