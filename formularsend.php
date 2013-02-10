<?PHP
echo "Sie haben folgende Angaben gemacht:<br>";
echo "Ihre Stadt: $_POST[destination]<br>";

    header('Location: http://example.org/form.php');
    exit;

?>