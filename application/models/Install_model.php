<?php

class Install_Model extends CI_Model 
{

	public function createAdmin($username, $email, $password) 
	{
		$this->db->insert("users", 
			array(
				"username" => $username,
				"email" => $email,
				"first_name" => "Project",
				"last_name" => "Admin",
				"user_level" => 4,
				"password" => $password,
				"IP" => $_SERVER['REMOTE_ADDR'],
				"joined" => time(),
				"joined_date" => date("n-Y")
			)
		);
	}

	public function updateSite($name, $desc, $dir) 
	{
		$this->db->update("site_settings", 
			array(
				"site_name" => $name, 
				"site_desc" => $desc, 
				"upload_path" => $dir . "uploads",
				"upload_path_relative" => "uploads"
			)
		);
	}

	public function checkAdmin() 
	{
		$s = $this->db->where("user_level", 4)->get("users");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>
