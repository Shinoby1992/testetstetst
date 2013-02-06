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
//include("user.inc.php");
?>