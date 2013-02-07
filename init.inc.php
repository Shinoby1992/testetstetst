<?php
session_start();
$exception = array('register', 'login');

$page = substr(end(explode('/', $_SERVER['SCRIPT_NAME'])), 0,-4);

if (in_array($page, $exception) === false){
	if (isset($_SESSION['username']) === false){
		header('Location: login.php');
		die();
	}
}

$connection_url = getenv("MONGOHQ_URL");
$m = new Mongo($connection_url);
$url = parse_url($connection_url);
$db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
$db = $m->selectDB($db_name);

include("user.inc.php");
?>
