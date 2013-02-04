<?php
// connect
$m = new MongoClient( "mongodb://humi:humi@linus.mongohq.com:10020" ); 

// select a database
$db = $m->app10036823;

// select a collection (analogous to a relational database's table)
$collection = $db->events;

// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    echo $document["title"] . "\n";
}

  # disconnect
  $m->close();
?>