<?php
function file_upload_increment($){
	$query = "UPDATE `uploads` SET files = (files + 1) WHERE `user_id` = ". $_SESSION['user_id'] .""; 
	mysql_query ($query);
}
?>