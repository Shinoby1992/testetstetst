<?php

function valid_credentials($user, $pass){
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
  	  $collection = $db->users;
	
  	  $qry = array("user_name" => $user,"password" => $pass);
  	  $result = $collection->findOne($qry);
	  return ($result == '1') ? true : false;
}
?>