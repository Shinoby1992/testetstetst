<!DOCTYPE html>
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>PartyApp Manager</title>
    </head>
    <body>
        <h1>PartyApp Party Hinzufügen</h1>
<?php
if ($_POST) {
    require 'DropboxUploader.php';

    try {
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK)
            throw new Exception('File was not successfully uploaded from your computer.');
    
        if ($_FILES['file']['name'] === "")
            throw new Exception('File name not supplied by the browser.');
        
        // Upload
        $uploader = new DropboxUploader('human.khoobsirat@googlemail.com', 'hu26sh10');
		
		$txt1="public/";		
        $uploader->upload($_FILES['file']['tmp_name'], $txt1.$_POST['destination'],  $_FILES['file']['name']);
    
        echo '<span style="color: green">File successfully uploaded to your Dropbox!</span>';
    } catch(Exception $e) {
        echo '<span style="color: red">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
    }

}
?>
        <form method="POST" enctype="multipart/form-data">
        <dl>
            <dt><label for="destination">Stadt der Veranstaltung<label</dt><dd><input type="text" id="destination" name="destination"></dd>
            <dt><label for="file"></label>File</dt><dd><input type="file" id="file" name="file"></dd>
            <dd><input type="submit" value="Event Hinzufügen!"></dd>
        </dl>
    </body>
</html>
