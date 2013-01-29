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
		$fehler = array();
		if (isset($_POST['timedate'], $_POST['destination'], $_POST['firstline'], $_POST['secline'], $_POST['thirdline'], $_POST['fourthline'])){
			if (empty($_POST['timedate'])){
				$fehler[] = 'Datum darf nicht fehlen.';
			}
			elseif(check_date($_POST['timedate'])== FALSE){
				$fehler[] = 'Datum Fehlerhaft eingegeben';
			}
			if (empty($_POST['destination'])){
				$fehler[] = 'Stadt darf nicht fehlen.';
			}
			if (empty($_POST['firstline'])){
				$fehler[] = 'Veranstaltungsseite darf nicht fehlen.';
			}
			if (empty($_POST['secline'])){
				$fehler[] = 'Veranstaltungs ID darf nicht fehlen.';
			}
			if (empty($_POST['thirdline'])){
				$fehler[] = 'Link zum Flyer darf nicht fehlen.';
			}
			if (empty($_POST['fourthline'])){
				$fehler[] = 'Adresse darf nicht fehlen.';
			}
			if (empty($_POST['fifthline'])){
				$fehler[] = 'Geben Sie mindestens eine Information an';
			}			
			if (empty($fehler) === false){
				foreach ($fehler as $fehlers){
					echo "<li>{$fehlers}</li>";
				}
				echo (int)check_date($_POST['timedate']);
				die();
			}
		}
	
	    try {
	        // Upload
	        $uploader = new DropboxUploader('human.khoobsirat@googlemail.com', 'hu26sh10');
			$txt1="public/";
			
			$insertQuery = sprintf("INSERT INTO `events` VALUES ('%s','%s','%s','%s','%s','%s','%s',0)", mysql_real_escape_string(ucfirst(strtolower($_POST['destination']))),mysql_real_escape_string($_POST['timedate']),mysql_real_escape_string($_POST['firstline']),mysql_real_escape_string($_POST['secline']),mysql_real_escape_string($_POST['thirdline']),mysql_real_escape_string($_POST['fourthline']),mysql_real_escape_string($_POST['fifthline']));
			
			$userName = $_SESSION['username'];			
			$query = sprintf("UPDATE `uploads` SET files = (files + 1) WHERE `user_id` = (SELECT `user_id` FROM `users` WHERE `user_name`='%s')",mysql_real_escape_string($userName));
			
			$updateCitys = sprintf("INSERT INTO `usage`(`Stadt`) VALUES ('%s')", mysql_real_escape_string(ucfirst(strtolower($_POST['destination']))));
			
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET CHARACTER SET 'utf8'");
			mysql_query($insertQuery);
			mysql_query($query);
			mysql_query($updateCitys);
			
			echo '<span style="color: green">Event wurde hinzugefügt!</span>';
			
			date_default_timezone_set('CET');
			$myFile = "log.txt";
			$fh = fopen($myFile, 'a');
			$line = "Benutzer:".$_SESSION['username']."; Bild:".$_POST['thirdline']."; Ordner:".$_POST['destination']."; Dateiname:".$fileName."; Veranstaltungsname:".$_POST['firstline']."; Datum:".date('l jS \of F Y h:i:s A').";\r\n";
			fwrite($fh, $line);
			fclose($fh);
			$uploader->upload($myFile, $txt1."logs",  $myFile);
			
	    } catch(Exception $e) {
	        echo '<span style="color: red">Fehler: ' . htmlspecialchars($e->getMessage()) . '</span>';
	    }
		unlink('testFile.txt');

	}
	
	function check_date($date) {
	    if(strlen($date) == 10) {
	        $pattern = '/\.|\/|-/i';    // . or / or -
	        preg_match($pattern, $date, $char);
        
		    if(strlen($array[2]) == 4) {
				return FALSE;
		    }
		
	        $array = preg_split($pattern, $date, -1, PREG_SPLIT_NO_EMPTY); 
	        // yyyy-mm-dd    # iso 8601
	        if(strlen($array[0]) == 4 && $char[0] == "-") {
	            $month = $array[1];
	            $day = $array[2];
	            $year = $array[0];
	        }
			
	        if(checkdate($month, $day, $year)) {    //Validate Gregorian date
	            return TRUE;
        
	        } else {
	            return FALSE;
	        }
	    }else {
	        return FALSE;    // more or less 10 chars
	    }
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
					<dt><label for="timedate">Datum der Veranstaltung<label</dt><dd><input type="text" id="timedate" name="timedate">year-mm-dd (2013-01-31)</dd>
		            <dt><label for="destination">Stadt der Veranstaltung<label</dt><dd><input type="text" id="destination" name="destination"></dd>
					<dt><label for="firstline">Veranstaltungsseite<label</dt><dd><input type="text" id="firstline" name="firstline">https://www.facebook.com/xxxxxx  <-- xxx = Veranstaltungsseite</dd>
						
					<dt><label for="secline">Veranstaltungs ID<label</dt><dd><input type="text" id="secline" name="secline">https://www.facebook.com/events/xxxxx <-- xxx = Veranstaltungs ID</dd>
					<dt><label for="thirdline">Link zum Flyer<label</dt><dd><input type="text" id="thirdline" name="thirdline">Größe 680x960</dd>
					<dt><label for="fourthline">Adresse<label</dt><dd><input type="text" id="fourthline" name="fourthline">Musterstraße 12, 12345 Musterstadt</dd>
		            <dt><label for="fifthline">Informationen<label</dt><dd><textarea id="fifthline" name="fifthline" cols="25" rows="5"></textarea>Einlass Ab 22Uhr;Eintritt 8€, MdvZ 3€;usw (Zeilen mit ; trennen. Nicht neue Zeilen erstellen(Entertaste)!!!!)</dd>
					<dd><input type="submit" value="Event Hinzufügen!"></dd>
		        </dl>
	</section>