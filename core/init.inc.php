<?php

session_start();



$exceptions = array('register', 'login');

$page = substr(end(explode('/', $_SERVER['SCRIPT_NAME'])), 0,-4);

echo $page;

if (in_array($page, $exception) === false){
	if (isset($_SESSION['username']) === false){
		header('Location login.php');
		die();
	}
}

mysql_connect("instance34712.db.xeround.com:3312","app10036823","hu26sh10");
mysql_select_db("app10036823");

$path = dirname(__FILE__);

include("{$path}/inc/user.inc.php");

?>