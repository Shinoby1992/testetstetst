<?php
//check if the username exists in the database
function user_exists($user){
	$user = mysql_real_escape_string($user);
	$total = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}'");
	return (mysql_result($total, 0) == '1') ? true : false;
}

//check if the username and password matches
function valid_credentials($user, $pass){
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);
	$total = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}' AND `user_password` = '{$pass}'");
	return (mysql_result($total, 0) == '1') ? true : false;
}


//add user
function add_user($user,$pass){
	
}


?>