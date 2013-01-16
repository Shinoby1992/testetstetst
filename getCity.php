<?php header('Content-Type: application/json; charset=utf-8');
$connect = mysql_connect('instance34712.db.xeround.com:3312','app10036823','hu26sh10');
mysql_select_db('app10036823');

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");

$citys = $_GET['city'];
$selection = sprintf("SELECT DISTINCT `city` FROM `events` ORDER BY `events`.`city` ASC", mysql_real_escape_string($citys));

$sth = mysql_query($selection);
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
$dict = array("citys" => $rows);

echo json_encode($dict);
mysql_close($connect);
?>



