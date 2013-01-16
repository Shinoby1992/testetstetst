<?php
$connect = mysql_connect('instance34712.db.xeround.com:3312','app10036823','hu26sh10');
mysql_select_db('app10036823');

$cityid = $_GET['city'];
$update = sprintf("UPDATE `usage` SET Aufrufe = (Aufrufe + 1) WHERE `Stadt` = '%s'", mysql_real_escape_string($cityid));
$result = mysql_query($update);
mysql_close($connect);
?>