<?php 
include('init.inc.php');
?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

    <title>PartyAppEventManager</title>
    <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
    <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
  </head>
  <body>
	<?php
	if ($_POST) {
	    require 'DropboxUploader.php';
		if (empty($_POST['timedate'])){
			echo "Datum Fehlerhaft!";
			exit;
		}
		
		
		for ( $counter = 0; $counter <= 9; $counter += 1) {
			$fileName = $_POST['timedate'].'_0'.$counter.'.txt';
			$linkvalid = fopen('https://dl.dropbox.com/u/23084518/'.$_POST['destination'].'/'.$fileName, 'r');
			if (!$linkvalid) {
				break;
			}
		}
		$myFile = "testFile.txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$lineone = $_POST['firstline']."\r\n";
		$linetwo = $_POST['secline']."\r\n";
		$linethree = $_POST['thirdline']."\r\n";
		$linefour = $_POST['fourthline'];
		fwrite($fh, $lineone);
		fwrite($fh, $linetwo);
		fwrite($fh, $linethree);
		fwrite($fh, $linefour);
		fclose($fh);
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
	    try {
	        // Upload
	        $uploader = new DropboxUploader('human.khoobsirat@googlemail.com', 'hu26sh10');
		
			$txt1="public/";		
	        $uploader->upload($myFile, $txt1.$_POST['destination'],  $fileName);
    
	        echo '<span style="color: green">Event wurde hinzugefügt!</span>';
	    } catch(Exception $e) {
	        echo '<span style="color: red">Fehler: ' . htmlspecialchars($e->getMessage()) . '</span>';
	    }
		unlink('testFile.txt');

	}
	?>

	
	<section id="samples" class="clearfix">
		<p>
			Du bist eingeloggt als <?php echo $_SESSION['username'];?>
		</p>
		<p>
			<a href="logout.php">Logout?</a>
		</p>
		
		        <form method="POST" enctype="multipart/form-data">
		        <dl>
					<dt><label for="timedate">Datum der Veranstaltung<label</dt><dd><input type="text" id="timedate" name="timedate">dd.mm.year</dd>
		            <dt><label for="destination">Stadt der Veranstaltung<label</dt><dd><input type="text" id="destination" name="destination"></dd>
					<dt><label for="firstline">Veranstaltungsseite<label</dt><dd><input type="text" id="firstline" name="firstline">https://www.facebook.com/xxxxxx  <-- xxx = Veranstaltungsseite</dd>
						
					<dt><label for="secline">Veranstaltungs ID<label</dt><dd><input type="text" id="secline" name="secline">https://www.facebook.com/events/xxxxx <-- xxx = Veranstaltungs ID</dd>
					<dt><label for="thirdline">Link zum Flyer<label</dt><dd><input type="text" id="thirdline" name="thirdline">Größe 680x960</dd>
					<dt><label for="fourthline">Adresse<label</dt><dd><input type="text" id="fourthline" name="fourthline">Musterstraße 12, 12345 Musterstadt</dd>
		            <dd><input type="submit" value="Event Hinzufügen!"></dd>
		        </dl>
	</section>