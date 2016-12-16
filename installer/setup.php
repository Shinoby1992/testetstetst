 <?php
    ini_set('display_errors', 0);
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    $cur_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $cur_url_arr=explode('/installer',$cur_url);
    $basepath = $cur_url_arr[0].'/';

    /*** Checking STARTS ***/
    $ckText = file_get_contents('check_install.txt');
    if( trim($ckText) != 'no' ) {
        echo '<script>window.location="'.$basepath.'"</script>';
    }
    /*** Checking ENDS ***/

    if(isset($_POST['db_submit'])) {
        if($_POST['db_name'] != '' && $_POST['db_uname'] != '' && $_POST['db_pwd'] != ''  && $_POST['admin_email'] != ''  && $_POST['admin_pwd'] != '' && $_POST['db_host'] != '') {
            $path=dirname(__FILE__);
            $abs_path=explode('/installer',$path);

            $pathToDBfile = $abs_path[0].'/application/config/';

            /***** Check DB Details STARTS ******/

            $testConnection = mysqli_connect($_POST['db_host'], $_POST['db_uname'], $_POST['db_pwd'],$_POST['db_name']);

            /***** Check DB Details ENDS ******/

            if ($testConnection) {

                // Check email
                if (filter_var($_POST['admin_email'], FILTER_VALIDATE_EMAIL)) {
                    // password length
                     if(strlen($_POST['admin_pwd']) > 7) {

                        /*** DB config STARTS ***/
                        $dummyDB = file_get_contents('db_dummy.txt');

                        $final_db_text = str_replace('{DB_UNAME}',$_POST['db_uname'],$dummyDB);
                        $final_db_text = str_replace('{DB_NAME}',$_POST['db_name'],$final_db_text);
                        $final_db_text = str_replace('{DB_PASSWORD}',$_POST['db_pwd'],$final_db_text);
                        $final_db_text = str_replace('{DB_HOST}',$_POST['db_host'],$final_db_text);

                        file_put_contents($pathToDBfile.'database.php',$final_db_text);
                        /*** DB config ENDS ***/

                        /*** Base config STARTS ***/
                        $dummyConfig = file_get_contents('config_dummy.txt');

                        $final_config_text = str_replace('{BASE_URL}',$basepath,$dummyConfig);
                        file_put_contents($pathToDBfile.'config.php',$final_config_text);
                        /*** Base config ENDS ***/

                        /*** Checking Text STARTS ***/
                        file_put_contents('check_install.txt','yes');
                        /*** Checking Text ENDS ***/

                        /**** Import SQL file STARTS *******/

                            $default_sqlfile = 'default.sql';

                            mysql_connect($_POST['db_host'], $_POST['db_uname'], $_POST['db_pwd']);
                            mysql_select_db($_POST['db_name']);

                            // Temporary variable, used to store current query
                            $templine = '';
                            // Read in entire file
                            $lines = file($default_sqlfile);
                            // Loop through each line
                            foreach ($lines as $line)
                            {
                            // Skip it if it's a comment
                            if (substr($line, 0, 2) == '--' || $line == '')
                                continue;

                            // Add this line to the current segment
                            $templine .= $line;
                            // If it has a semicolon at the end, it's the end of the query
                            if (substr(trim($line), -1, 1) == ';')
                            {
                                // Perform the query
                                mysql_query($templine);
                                // Reset temp variable to empty
                                $templine = '';
                            }
                            }
                        /**** Import SQL file ENDS *******/

                        /***** Create admin account STARTS ******/

                            $admin_sql = "INSERT INTO ts_user (user_uname,user_email, user_pwd, user_status, user_accesslevel) VALUES ('admin', '".$_POST['admin_email']."', '".md5($_POST['admin_pwd'])."', '1', '1')";

                            mysql_query($admin_sql);
                            
                            /***** Create admin account ENDS ******/
                            
                            /***** Update Image URL STARTS ******/
                            $logo_url = $basepath.'assets/images/web/logo.png';
                            $logo_url_sql = "UPDATE ts_settings SET value_text='".$logo_url."' WHERE key_text='logo_url'";

                            mysql_query($logo_url_sql);
                            
                            $favicon_url = $basepath.'assets/images/web/favicon.ico';
                            $favicon_url_sql = "UPDATE ts_settings SET value_text='".$favicon_url."' WHERE key_text='favicon_url'";

                            mysql_query($favicon_url_sql);
                            
                            $preloader_url = $basepath.'assets/images/web/preloader.gif';
                            $preloader_url_sql = "UPDATE ts_settings SET value_text='".$preloader_url."' WHERE key_text='preloader_url'";

                            mysql_query($preloader_url_sql);

                            /***** Update Image URL ENDS ******/

                           echo '<script>window.location="'.$basepath.'authenticate/login"</script>';

                    }
                    else {
                        $message = '<span style="color:red;">Password should be more than 7 characters.</span>';
                    }
                }
                else {
                    $message = '<span style="color:red;">Email is not correct.</span>';
                }

            }
            else {
                $message = '<span style="color:red;">Database connection failed.</span>';
            }
        }
        else {
            $message = '<span style="color:red;">Fields can not be empty.</span>';
        }
    }
?>
 <!DOCTYPE html>
<!--
Script Name: Themeportal Script
Version: 1.0
Author: kamleshyadav
Website: http://himanshusofttech.com
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if IE 10]> <html lang="en" class="ie10 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
  <!--
<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title> ThemePortal - Installer Page</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="author"  content="KamleshYadav"/>
<meta name="MobileOptimized" content="320">
<!--srart theme style -->
<link href="<?php echo $basepath;?>adminassets/css/admin_main.css" rel="stylesheet" type="text/css"/>
<!-- end theme style -->
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $basepath;?>webimage/favicon.ico" />
</head>
<!-- Header End -->
  <!-- Body Start -->
<body>
<!-- add user modal start -->
<!-- wrapper start -->
<div class="th_installer_panel">
	<div class="th_form_wrapper">
		<div class="th_theme_logo">
			<a href="javascript:;"><img src="<?php echo $basepath;?>webimage/logo.png" class="img-responsive" alt="Themeportal"></a>
			<h6 id="errText"> <?php echo isset($message) ? $message : 'Welcome to Theme Portal.' ;?> </h6>
		</div>
		<form action="" method="post">
		<div class="th_installer_form">
			<h4>database detail</h4>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Database Host</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" name="db_host" value="<?php echo isset($_POST['db_host']) ? $_POST['db_host'] : 'localhost';?>" />
				<!--<span class="help_text">helping text here</span>-->
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Database Name</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" name="db_name" value="<?php echo isset($_POST) ? $_POST['db_name'] : '';?>" />
				<!--<span class="help_text">helping text here</span>-->
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Database Username</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" name="db_uname" value="<?php echo isset($_POST) ? $_POST['db_uname'] : '';?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Database Password</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="password" class="form-control" name="db_pwd" value="<?php echo isset($_POST) ? $_POST['db_pwd'] : '';?>" />
				</div>
			</div>
		</div>
		<div class="th_installer_form">
			<h4>login detail</h4>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Admin Email</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" name="admin_email" value="<?php echo isset($_POST) ? $_POST['admin_email'] : '';?>" /></div>
			</div>
			<div class="form-group">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><label>Admin Password</label></div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="password" class="form-control" name="admin_pwd" value="<?php echo isset($_POST) ? $_POST['admin_pwd'] : '';?>" /></div>
			</div>
			<div class="col-lg-12 col-md-12">
				<input type="submit" class="btn theme_btn" name="db_submit" value="Set up Mysite" />
			</div>
		</div>
		</form>
	</div>
</div>

<!-- wrapper end -->
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jquery-1.12.3.js"></script>

<script  type="text/javascript">
    jQuery(document).ready(function($) {
        var h = $(window).innerHeight();
        $(".th_installer_panel").css("height", h);
    });
</script>
</body>
</html>