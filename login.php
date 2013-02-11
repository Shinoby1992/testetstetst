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
	
	if (!valid_credentials($_POST['username'], $_POST['password'])){
		$errors[] = 'Benutzername / Passwort falsch.';
	}

	if (empty($errors)){
		$_SESSION['username'] = htmlentities($_POST['username']);
		
		header('Location: protected.php');
		die();
	}
	
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DiscGo Official Manager</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

<div id="logo-changing">
	<a href="index.php"><img src="images/shared/logo2.png" width="120" height="120" alt="" /></a>
</div>
	
	<!-- start logo -->
	<div id="logo-login">
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
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
		<table border="0" cellpadding="0" cellspacing="0">

		<form action="" method="post">
		<tr>
			<th>Benutzer</th>
			<td><input type="text"  name="username" id="username" class="login-inp" /></td>
		</tr>
		<tr>
			<th>Passwort</th>
			<td><input type="password" name="password" id="password" value="************"  onfocus="this.value=''" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" name="submitbu" class="submit-login"  /></td>
		</tr>
		</form>
		</table>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>

</div>
<!-- End: login-holder -->
</body>
</html>