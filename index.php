<?php
session_start();

$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;

/**
 * This sample app is provided to kickstart your experience using Facebook's
 * resources for developers.  This sample app provides examples of several
 * key concepts, including authentication, the Graph API, and FQL (Facebook
 * Query Language). Please visit the docs at 'developers.facebook.com/docs'
 * to learn more about the resources available to you
 */

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
  
  if (!isset($_SESSION['eventid'])) {
    $_SESSION['eventid'] = 0;
  }
  
  // This fetches some things that you like . 'limit=*" only returns * values.
  // To see the format of the data you are retrieving, use the "Graph API
  // Explorer" which is at https://developers.facebook.com/tools/explorer/

 
  // Here is an example of a FQL call that fetches all of your friends that are
  // using this app
  $app_using_friends = $facebook->api(array(
    'method' => 'fql.query',
    'query' => 'SELECT uid, name FROM user WHERE uid IN(SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1'
  ));
}

// Fetch the basic info of the app that they are using
$app_info = $facebook->api('/'. AppInfo::appID());

$app_name = idx($app_info, 'name', '');

?>

<?php
function ausgabe_uhrzeit()
{
    echo "<p>Es ist gerade: ". date("H:i:s"). "</p>";
	
	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
	   session_destroy();
	   echo "Your session has expire !";
    }
	
}
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

    <script type="text/javascript" src="/javascript/jquery-1.7.1.min.js"></script>

    <script type="text/javascript">
      function logResponse(response) {
        if (console && console.log) {
          console.log('The response was', response);
        }
      }

      $(function(){
        // Set up so we handle click on the buttons
        $('#postToWall').click(function() {
          FB.ui(
            {
              method : 'feed',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });

        $('#sendToFriends').click(function() {
          FB.ui(
            {
              method : 'send',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });

        $('#sendRequest').click(function() {
          FB.ui(
            {
              method  : 'apprequests',
              message : $(this).attr('data-message')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });
      });
    </script>

    <!--[if IE]>
      <script type="text/javascript">
        var tags = ['header', 'section'];
        while(tags.length)
          document.createElement(tags.pop());
      </script>
    <![endif]-->
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

        <div id="share-app">
          <p>App Teilen:</p>
          <ul>
            <li>
              <a href="#" class="facebook-button" id="postToWall" data-url="<?php echo AppInfo::getUrl(); ?>">
                <span class="plus">Auf Pinnwand Posten</span>
              </a>
            </li>
            <li>
              <a href="#" class="facebook-button speech-bubble" id="sendToFriends" data-url="<?php echo AppInfo::getUrl(); ?>">
                <span class="speech-bubble">Nachricht Senden</span>
              </a>
            </li>
            <li>
              <a href="#" class="facebook-button apprequests" id="sendRequest" data-message="Mein Event Script kann dir für deine Veranstaltung 				arbeit abnehmen">
                <span class="apprequests">Sende Anfrage</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <?php } else { ?>
      <div>
        <h1>Willkommen</h1>
        <div class="fb-login-button" data-scope="user_events,friends_events,user_groups,user_website"></div>
      </div>
      <?php } ?>
    </header>

	<section id="samples" class="clearfix">
		        <form method="POST" enctype="multipart/form-data">
		        <dl>
		            <dt><label for="destination">Stadt der Veranstaltung<label</dt><dd><input type="text" id="destination" name="destination"></dd>
		            <dt><label for="file"></label>File</dt><dd><input type="file" id="file" name="file"></dd>
		            <dd><input type="submit" value="Event Hinzufügen!"></dd>
		        </dl>
	</section>

	<?php
	if ($_POST) {
	    require 'DropboxUploader.php';

	    try {
	        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK)
	            throw new Exception('Event erfolgreich hinzugefügt');
    
	        if ($_FILES['file']['name'] === "")
	            throw new Exception('Dateiname Fehlerhaft.');
        
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









	<?php
	
	if ($_POST['submitid']){
		$_SESSION['eventid'] = $_POST['evidbox'];
	}
	
	?>
	
	
	<?php
		echo he($_SESSION['eventid']);

		$attending = idx($facebook->api('/'.he($_SESSION['eventid']).'/attending'), 'data', array());
		$maybe = idx($facebook->api('/'.he($_SESSION['eventid']).'/maybe'), 'data', array());
		$declined = idx($facebook->api('/'.he($_SESSION['eventid']).'/declined'), 'data', array());
		$noreply = idx($facebook->api('/'.he($_SESSION['eventid']).'/noreply'), 'data', array());
		$eventwall = idx($facebook->api('/'.he($_SESSION['eventid']).'/feed?limit=2000'), 'data', array());
		
		foreach ($eventwall as $eventwalle) {
		 	$name = idx($eventwalle, 'message');
			if ($name == "") {
				
			}
			else{
				$array[] = $name;
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
		            <dt><label for="destination">Stadt der Veranstaltung<label</dt><dd><input type="text" id="destination" name="destination"></dd>
		            <dt><label for="file"></label>File</dt><dd><input type="file" id="file" name="file"></dd>
		            <dd><input type="submit" value="Event Hinzufügen!"></dd>
		        </dl>
	</section>




    <section id="samples" class="clearfix">
      <h1>Informationen</h1>
	  
	  <div class="list">
        <h3>Zugesagt</h3>
		<h3><?php echo count($attending) ?></h3>
		
		<form id="form1" name="tets" method="post" action="<? PHP_SELF ?>">
		<input name="showlist" type="submit" value="Liste anzeigen" />
		</form>
		<?
			if ($_POST['exportattend'])
				{
				echo "der button wurde gedrückt";
			}
			if ($_POST['showlist'])
				{
				echo '<ul class="attending">';
				foreach ($attending as $attendee) {
	  				$id = idx($attendee, 'id');
	            	$name = idx($attendee, 'name');
				
				echo '<li>';
					echo '<a href="https://www.facebook.com/'.he($id).'target="_top">';
					echo '<img src="https://graph.facebook.com/'.he($id).'/picture?type=square" alt="'.he($name).'">';
					echo he($name);
				echo "</a>";
				echo '</li>';
				}
				echo '</ul>';
				}
		?>
	</div> 
	  
	  
	  <div class="list">
        <h3>Vielleicht</h3>
		<h3><?php echo count($maybe) ?></h3>
		
		<form id="form2" name="tets2" method="post" action="<? PHP_SELF ?>">
		<input name="showlist2" type="submit" value="Liste anzeigen" />
		</form>
		<?
			if ($_POST['exportmaybe'])
				{
				echo "der button wurde gedrückt";
			}
			if ($_POST['showlist2'])
				{
				echo '<ul class="attending">';
				foreach ($maybe as $maybee) {
	  				$id = idx($maybee, 'id');
	            	$name = idx($maybee, 'name');
				
				echo '<li>';
					echo '<a href="https://www.facebook.com/'.he($id).'target="_top">';
					echo '<img src="https://graph.facebook.com/'.he($id).'/picture?type=square" alt="'.he($name).'">';
					echo he($name);
				echo "</a>";
				echo '</li>';
				}
				echo '</ul>';
				}
		?>
	</div> 	
    
	  <div class="list">
        <h3>Abgesagt</h3>
		<h3><?php echo count($declined) ?></h3>

		<form id="form3" name="tets3" method="post" action="<? PHP_SELF ?>">
		<input name="showlist3" type="submit" value="Liste anzeigen" />
		</form>
		<?
			if ($_POST['exportdecline'])
				{
				echo "der button wurde gedrückt";
			}
			if ($_POST['showlist3']){
				echo '<ul class="attending">';
				foreach ($declined as $declineed) {
	  				$id = idx($declineed, 'id');
	            	$name = idx($declineed, 'name');
				
				echo '<li>';
					echo '<a href="https://www.facebook.com/'.he($id).'target="_top">';
					echo '<img src="https://graph.facebook.com/'.he($id).'/picture?type=square" alt="'.he($name).'">';
					echo he($name);
				echo "</a>";
				echo '</li>';
				}
				echo '</ul>';
				}
		?>
	</div>
	
	  <div class="list">
        <h3>Unbeantwortet</h3>
		<h3><?php echo count($noreply) ?></h3>

		<form id="form3" name="tets3" method="post" action="<? PHP_SELF ?>">
		<input name="showlist4" type="submit" value="Liste anzeigen" />
		</form>
		<?
			if ($_POST['exportdecline'])
				{
				echo "der button exportdecline gedrückt";
			}
			if ($_POST['showlist4']){
				echo '<ul class="attending">';
				foreach ($noreply as $noreplyd) {
	  				$id = idx($noreplyd, 'id');
	            	$name = idx($noreplyd, 'name');
				
				echo '<li>';
					echo '<a href="https://www.facebook.com/'.he($id).'target="_top">';
					echo '<img src="https://graph.facebook.com/'.he($id).'/picture?type=square" alt="'.he($name).'">';
					echo he($name);
				echo "</a>";
				echo '</li>';
				}
				echo '</ul>';
				}
		?>
      </div>
	</section>
    <?php
  }
    ?>