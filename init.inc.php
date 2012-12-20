<?php
session_start();
$exception = array('register', 'login');

$page = substr(end(explode('/', $_SERVER['SCRIPT_NAME'])), 0,-4);

if (in_array($page, $exception) === false){
	echo "ARRAY FALSE";
	echo "<br>";
}
if (in_array($page, $exception) === true){
	echo "ARRAY TRUE";
	echo "<br>";
}

if (isset($_SESSION['username']) === false){
	echo "USERNAME FALSE";
	echo "<br>";
}
if (isset($_SESSION['username']) === true){
	echo "USERNAME TRUE";
	echo "<br>";
}
if (isset($_SESSION['blasn']) === true){
	echo "blasn TRUE";
	echo "<br>";
}
if (isset($_SESSION['blasn']) === false){
	echo "blasn FALSE";
	echo "<br>";
}

if (in_array($page, $exception) === false){
	if (isset($_SESSION['username']) === false){
		header('Location: login.php');
		die();
	}
}

mysql_connect('instance34712.db.xeround.com:3312','app10036823','hu26sh10');
mysql_select_db('app10036823');

include("user.inc.php");
?>