<?php
function valid_credentials($user, $pass){
	$collection = $db->users;
	$qry = array("user_name" => $user,"password" => $pass);
	$result = $collection->findOne($qry);
	return $result;
}
?>
