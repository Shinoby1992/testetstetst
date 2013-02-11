<?php 
include('init.inc.php');
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

				
			}
			else{		
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
	}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DiscGo Official Manager</title>

<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 


<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');

	
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 


<!-- Start: page-top-outer -->
<div id="page-top-outer">
	<!-- Start: page-top -->
	<div id="page-top">
		<!-- start logo -->
		<div id="logo">
			<a href=""><img src="images/shared/logo2.png" width="80" height="80" alt="" /></a>
			<p style="font-weight:bold;color:#FFFFFF;letter-spacing:2pt;word-spacing:3pt;font-size:32px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:1;">DiscGo</p>
		</div>
		<!-- end logo -->
	</div>
</div>

<div class="clear">&nbsp;</div>

<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 
		<!-- start nav-right -->
		<div id="nav-right">
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account">
				<!-- <img src="images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" />-->
				<h2 style="color:white"><?php echo $_SESSION['username'];?></h2>
			</div>
			<div class="nav-divider">&nbsp;</div>
			<a href="logout.php" id="logout"><img src="images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		</div>
		<!-- end nav-right -->

		<!--  start nav -->
		<div class="nav">
		<div class="table">
		                    
		<ul class="current"><li><a href="#nogo"><b>Veranstaltung</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li class="sub_show"><a href="#nogo">Hinzufügen</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>

	<!--  start nav -->
	</div>
	<div class="clear"></div>
	<!--  start nav-outer -->
	</div>
	<!--  start nav-outer-repeat................................................... END -->

	<div class="clear"></div>
	 
	<!-- start content-outer -->
	<div id="content-outer">
	<!-- start content -->
	<div id="content">

		<!--  start page-heading -->
		<div id="page-heading"><h1>Veranstaltung Hinzufügen</h1></div>
		<!-- end page-heading -->

		<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
		<tr>
			<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
			<th class="topleft"></th>
			<td id="tbl-border-top">&nbsp;</td>
			<th class="topright"></th>
			<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
		</tr>

<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">

	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>

							<!--  start message-red -->
				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Error. <a href="">Please try again.</a></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-red -->


		<!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no">1</div>
			<div class="step-dark-left"><a href="">Veranstaltung</a></div>
			<div class="step-dark-right">&nbsp;</div>
			<div class="step-no-off">2</div>
			<div class="step-light-left">Vorschau</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">3</div>
			<div class="step-light-left">Hinzufügen</div>
			<div class="step-light-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

		<form method="post" action="">
		<tr>
			<th valign="top">Stadt:</th>
			<td><input type="text" id="destination" name="destination" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
		</tr>
		<tr>
			<th valign="top">Datum:</th>
			<td><input type="text" id="timedate" name="timedate" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
		</tr>
		<tr>
			<th valign="top">Facebook Seite:</th>
			<td><input type="text" id="firstline" name="firstline" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
		</tr>
		<tr>
			<th valign="top">Facebook EventID:</th>
			<td><input type="text" id="secline" name="secline" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
		</tr>
		<tr>
			<th valign="top">Adresse:</th>
			<td><input type="text" id="fourthline" name="fourthline" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
		</tr>
		<tr>
			<th valign="top">Informationen:</th>
			<td><textarea rows="" cols="" id="fifthline" name="fifthline" class="form-textarea"></textarea></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Link zum Flyer</th>
			<td><input type="text" id="thirdline" name="thirdline" class="inp-form-error" /></td>
			<td>
			<div class="error-left"></div>
			<div class="error-inner">Muss angegeben werden</div>
			<div class="bubble-left"></div>
			<div class="bubble-inner">Optimale Größe 680x960</div>
			<div class="bubble-right"></div>
			</td>
		</td>
		</tr>
		<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit" />
		</td>
		<td></td>
		</tr>
		</form>
	</table>
	<!-- end id-form  -->

	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<img src="images/forms/header_related_act.gif" width="271" height="43" alt="" />
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Stadt</h5>
					<ul class="greyarrow">
					<li>Musterstadt</li> 
					</ul>
				</div>

				<div class="clear"></div>
				<div class="lines-dotted-short"></div>

				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Datum</h5>
					<ul class="greyarrow">
					Veranstaltungs Datum
					<li>year-mm-dd (2013-01-31)</li>
					</ul>
				</div>

				<div class="clear"></div>
				<div class="lines-dotted-short"></div>

				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Facebook Seite</h5>
					<ul class="greyarrow">
					https://www.facebook.com/xxxxxx
					<li>xxxxxx = Facebook Seite</li> 
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Facebook EventID</h5>
					<ul class="greyarrow">
					https://www.facebook.com/events/xxxxxx
					<li>xxxxxx = Veranstaltungs ID</li> 
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Adresse</h5>
					<ul class="greyarrow">
					<li>Musterstraße 15, 12345 Musterstadt</li> 
					</ul>
				</div>

				<div class="clear"></div>
				<div class="lines-dotted-short"></div>

				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Informationen</h5>
					<ul class="greyarrow">
					Bsp: Einlass ab 22Uhr;Eintritt 8€; MdvZ 3€
					<li>Zum Trennen ; benutzen keine neuen Zeilen(Entertaste)!!!</li> 
					</ul>
				</div>

				<div class="clear"></div>
				<div class="lines-dotted-short"></div>

				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Link zum Flyer</h5>
					<ul class="greyarrow">
					<li>Kompletten Link zum Bild</li> 
					</ul>
				</div>

				<div class="clear"></div>
				
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr>

<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	DiscGo &copy; Copyright Human Khoobsirat 2013. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
</body>
</html>