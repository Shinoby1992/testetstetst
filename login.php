<?php
include('init.inc.php');
$errors = array();

if (isset($_POST['username'], $_POST['password'])){
	if (empty($_POST['username'])){
		$errors[] = 'Der Benutzername darf nicht leer sein.';
	}
	if (empty($_POST['password'])){
		$errors[] = 'Das Passwort darf nicht leer sein.';
	}
	
    try {
      // connect to MongoHQ assuming your MONGOHQ_URL environment
      // variable contains the connection string
      $connection_url = getenv("MONGOHQ_URL");
 
      // create the mongo connection object
      $m = new Mongo($connection_url);
 
      // extract the DB name from the connection path
      $url = parse_url($connection_url);
      $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
 
      // use the database we connected to
      $db = $m->selectDB($db_name);
	
  	  // get Collection
  	  $collection = $db->users;
	
  	  $qry = array("user_name" => $_POST['username'],"password" => $_POST['password']);
  	  $result = $collection->findOne($qry);
	  
	  if ($result){
    	header('Location: protected.php');
    	die();
	  }

      // disconnect from server
      $m->close();
    } catch ( MongoConnectionException $e ) {
      die('Error connecting to MongoDB server');
    } catch ( MongoException $e ) {
      die('Mongo Error: ' . $e->getMessage());
    } catch ( Exception $e ) {
      die('Error: ' . $e->getMessage());
    }	
}	
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
		if (empty($errors) === false){
    	?>
			
		<ul>
			
		<?php			
		foreach ($errors as $error){
			echo "<li>{$error}</li>";
		}
		?>
			
		</ul>
			
		<?php
		}	
		?>
	  <section id="samples" class="clearfix">	  
		  <form action="" method="post">
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" />
		</p>
		<p>
			<label for="password">Passwort:</label>
			<input type="password" name="password" id="password" />
		</p>
		<p>
			<input type="submit" value="Einloggen" />
		</p>
	</form>
</body>
	</section>
