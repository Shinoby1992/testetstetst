<?PHP
echo "Sie haben folgende Angaben gemacht:<br>";
echo "Ihre Stadt: $_POST[destination]<br>";

    header('Location: protected.php');
    exit;

?>