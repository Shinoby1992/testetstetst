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
				die();
			}
		}
	        // Upload
	        $uploader = new DropboxUploader('human.khoobsirat@googlemail.com', 'hu26sh10');
			$txt1="public/";
			
			
		    try {
		  	$connection_url = getenv("MONGOHQ_URL");
		  	$m = new Mongo($connection_url);
		    $url = parse_url($connection_url);
		    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
		  	$db = $m->selectDB($db_name);
		  	$collection = $db->events;
		  	$start = new MongoDate(strtotime($_POST['timedate']));	
		  	$collection->insert(array(
		  	    'city' => ucfirst(strtolower($_POST['destination'])),
		  		'datum' => $start,
		  	    'page_name' => $_POST['firstline'],
		  	    'event_id' => $_POST['secline'],
		  		'image_link' => $_POST['thirdline'],
		  		'address' => $_POST['fourthline'],
		  		'info' => $_POST['fifthline'],
		  	    'checked' => 0,
		  	));
			
			$collection = $db->users;
			$collection->update(array('user_name' => $_SESSION['username']), array('$inc' => array('files' => 1)), true);
			
			$collection = $db->usage;
			if ( $collection->findOne ( array ('Stadt'=> ucfirst(strtolower($_POST['destination'])))) == NULL ) {
				$collection->insert(array(
					'Stadt' => ucfirst(strtolower($_POST['destination'])),
					'Aufrufe' => 0
				));
			} else {
			  	// else don't touch it, so upsert would not fit.
			}


		    $m->close();

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