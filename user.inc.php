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
	
  	  $qry = array("user_name" => $name,"password" => $password);
  	  $result = $collection->findOne($qry);
  	  if($result){
  		$success = "You are successully loggedIn";
  		echo "<li>" .  $success . "</li>";
  	}
	
	
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);
	$total = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}' AND `user_password` = '{$pass}'");
	
	
	
	
	
	return (mysql_result($total, 0) == '1') ? true : false;
}
?>