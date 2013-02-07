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
	$collection = $db->events;
	$start = new MongoDate(strtotime('2013-01-01'));
	$collection->insert(array(
	    'city' => 'test',
		'datum' => new MongoDate(strtotime($start)),
	    'page_name' => 'test',
	    'event_id' => 'test',
		'image_link' => 'test',
		'address' => 'test',
		'info' => 'test',
	    'checked' => 0,
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