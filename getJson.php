<?php header('content-type: application/json; charset=utf-8');
session_start();
$connect = mysql_connect('instance34712.db.xeround.com:3312','app10036823','hu26sh10');
mysql_select_db('app10036823');

$sth = mysql_query("SELECT * From `events`");
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
print $rows;

mysql_close($connect);


?>



