<?php
// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
require_once('AppInfo.php');

// Enforce https on production
if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}

// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');


/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/

require_once('sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => true,
  'trustForwarded' => true,
));
$user_id = $facebook->getUser();

if ($user_id) {
  try {
    // Fetch the viewer's basic information
    $basic = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    // If the call fails we check if we still have a user. The user will be
    // cleared if the error is because of an invalid accesstoken
    if (!$facebook->getUser()) {
      header('Location: '. AppInfo::getUrl($_SERVER['REQUEST_URI']));
      exit();
    }
  }
}

// Fetch the basic info of the app that they are using
$app_info = $facebook->api('/'. AppInfo::appID());

$app_name = idx($app_info, 'name', '');

?>

<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

    <title><?php echo he($app_name); ?></title>
    <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
    <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />

    <!--[if IEMobile]>
    <link rel="stylesheet" href="mobile.css" media="screen" type="text/css"  />
    <![endif]-->

    <!-- These are Open Graph tags.  They add meta data to your  -->
    <!-- site that facebook uses when your content is shared     -->
    <!-- over facebook.  You should fill these tags in with      -->
    <!-- your data.  To learn more about Open Graph, visit       -->
    <!-- 'https://developers.facebook.com/docs/opengraph/'       -->
    <meta property="og:title" content="<?php echo he($app_name); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo AppInfo::getUrl(); ?>" />
    <meta property="og:image" content="<?php echo AppInfo::getUrl('/logo.png'); ?>" />
    <meta property="og:site_name" content="<?php echo he($app_name); ?>" />
    <meta property="og:description" content="My first app" />
    <meta property="fb:app_id" content="<?php echo AppInfo::appID(); ?>" />
  </head>
  <body>
    <div id="fb-root"></div>
    <script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo AppInfo::appID(); ?>', // App ID
          channelUrl : '//<?php echo $_SERVER["HTTP_HOST"]; ?>/channel.html', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true // parse XFBML
        });

        // Listen to the auth.login which will be called when the user logs in
        // using the Login button
        FB.Event.subscribe('auth.login', function(response) {
          // We want to reload the page now so PHP can read the cookie that the
          // Javascript SDK sat. But we don't want to use
          // window.location.reload() because if this is in a canvas there was a
          // post made to this page and a reload will trigger a message to the
          // user asking if they want to send data again.
          window.location = window.location;
        });

        FB.Canvas.setAutoGrow();
      };

      // Load the SDK Asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <header class="clearfix">
      <?php if (isset($basic)) { ?>
      <p id="picture" style="background-image: url(https://graph.facebook.com/<?php echo he($user_id); ?>/picture?type=normal)"></p>

      <div>
        <h1>Hallo, <strong><?php echo he(idx($basic, 'name')); ?></strong></h1>
        <p class="tagline">
          Appname: 
          <a href="<?php echo he(idx($app_info, 'link'));?>" target="_top"><?php echo he($app_name); ?></a>
        </p>
      </div>
      <?php } else { ?>
      <div>
        <h1>Willkommen</h1>
        <div class="fb-login-button" data-scope="user_events"></div>
      </div>
      <?php } ?>
    </header>

	<?php
	if ($_POST) {
	    require 'DropboxUploader.php';
		$fileName = $_POST['timedate'].'_00.txt';
		$linkvalid = fopen('https://dl.dropbox.com/u/23084518/' .$_POST['destination'].'/'.$fileName, 'r');

		
		if (!$linkvalid) {
		    echo "<p>Datei konnte nicht geöffnet werden.\n";
		    exit;
		}
		while (!feof ($linkvalid)) {
		    $zeile = fgets ($linkvalid, 1024);
		    /* Funktioniert nur, wenn Titel und title-Tags in einer Zeile stehen */
		    if (preg_match ("@\<title\>(.*)\</title\>@i", $zeile, $treffer)) {
		        $title = $treffer[1];
		        break;
		    }
		}
		fclose($linkvalid);

		$myFile = "testFile.txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$lineone = $_POST['firstline']."\n";
		$linetwo = $_POST['secline']."\n";
		$linethree = $_POST['thirdline']."\n";
		$linefour = $_POST['fourthline']."\n";
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
	        echo '<span style="color: red">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
	    }

	}
	?>

</section>
    <?php
      	if ($user_id) {
    ?>
	
	<section id="samples" class="clearfix">
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
    <?php
  }
    ?>