<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once("PasswordHash.php");

class Common 
{

    public function nohtml($message) 
    {
        $message = trim($message);
        $message = strip_tags($message);
        $message = htmlspecialchars($message, ENT_QUOTES);
        return $message;
    }

	public function encrypt($password) 
    {
        $phpass = new PasswordHash(12, false);
        $hash = $phpass->HashPassword($password);
    	return $hash;
    }

    public function randomPassword() 
    {
    	$letters = array(
            "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q",
            "r","s","t","u","v","w","x","y","z"
        );
    	$pass = "";
    	for($i=0;$i<10;$i++) {
    		shuffle($letters);
    		$letter = $letters[0];
    		if(rand(1,2) == 1) {
	    		$pass .= $letter;
    		} else {
	    		$pass .= strtoupper($letter);
    		}
    		if(rand(1,3)==1) {
    			$pass .= rand(1,9);
    		}
    	}
    	return $pass;
    }

    public function getAccessLevel($level) 
    {
        if($level == 0) {
            return "Member";
        } elseif($level == 1) {
            return "Moderator";
        } elseif($level == 2) {
            return "Power Moderator";   
        } elseif($level == 3) {
            return "User Admin";
        } elseif($level == 4) {
            return "Admin";
        } elseif($level == -1) {
            return "Banned";
        } else {
            return "Invalid Level";
        }
    }

    public function checkAccess($level, $required) 
    {
        $CI =& get_instance();
        if($level < $required) {
            $CI->template->error(
                "You do not have the required access to use this page. 
                You must be a ". $this->getAccessLevel($required)
                . "to use this page."
            );
        }
    }

    public function send_email($subject, $body, $emailt) 
    {
        $CI =& get_instance();
        $CI->load->library('email');

        $CI->email->from($CI->settings->info->site_email, $CI->settings->info->site_name);
        $CI->email->to($emailt);

        $CI->email->subject($subject);
        $CI->email->message($body);

        $CI->email->send();
    }

    public function check_mime_type($file) {
        return true;
    }

    public function replace_keywords($array, $message) {
        foreach($array as $k=>$v) {
            $message = str_replace($k, $v, $message);
        }
        return $message;
    }

}

?>
