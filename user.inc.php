<?php
function valid_credentials($user, $pass){
	$connection_url = getenv("MONGOHQ_URL");
	$m = new Mongo($connection_url);
	$url = parse_url($connection_url);
	$db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
	$db = $m->selectDB($db_name);
	$collection = $db->users;
	$qry = array("user_name" => $user,"password" => $pass);
	$result = $collection->findOne($qry);
	return $result;
}
?>
