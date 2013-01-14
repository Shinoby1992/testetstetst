<?php header('Content-Type: application/json; charset=utf-8');
session_start();
$connect = mysql_connect('instance34712.db.xeround.com:3312','app10036823','hu26sh10');
mysql_select_db('app10036823');

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");

$cityid = $_GET['city'];
$selection = sprintf("SELECT * FROM `events` WHERE `city` = '%s' and `datum` >= CURDATE() ORDER BY `events`.`datum` ASC", mysql_real_escape_string($cityid));

$sth = mysql_query($selection);
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
$dict = "events" => array($rows);

echo json_encode($dict);
mysql_close($connect);
?>



