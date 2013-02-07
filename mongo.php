<!-- PHP Mongo Docs: http://php.net/manual/en/class.mongodb.php -->
<html>
<body>
<h1>MongoHQ Test</h1>
<?php    
  try {
	$connection_url = getenv("MONGOHQ_URL");
	$m = new Mongo($connection_url);
    $url = parse_url($connection_url);
    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
	$db = $m->selectDB($db_name);
	
	
	$collection = $db->usage;
  	$collection->insert(array(
  	    'Stadt' => ucfirst(strtolower('Dortmund')),
  		'Aufrufe' => 0,
		'upsert' => true
  	));
	
	  	$collection->insert(array(
	  	    'Stadt' => ucfirst(strtolower('Frankfurt')),
	  		'Aufrufe' => 0,
			'upsert' => true
	  	));


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