<?php

class Admin_Model extends CI_Model 
{

	public function updateSettings($data) 
	{
		$this->db->where("ID", 1)->update("site_settings", $data);
	}

	public function add_ipblock($ip, $reason) 
	{
		$this->db->insert("ip_block", array(
			"IP" => $ip,
			"reason" => $reason,
			"timestamp" => time()
			)
		);
	}

	public function get_ip_blocks() 
	{
		return $this->db->get("ip_block");
	}

	public function get_ip_block($id) 
	{
		return $this->db->where("ID", $id)->get("ip_block");
	}

	public function delete_ipblock($id) {
		$this->db->where("ID", $id)->delete("ip_block");
	}

	public function get_email_templates() 
	{
		return $this->db->get("email_templates");
	}

	public function get_email_template($id) 
	{
		return $this->db->where("ID", $id)->get("email_templates");
	}

	public function update_email_template($id, $title, $message) 
	{
		$this->db->where("ID", $id)->update("email_templates", array(
			"title" => $title,
			"message" => $message
			)
		);
	}
	
	public function get_user_groups() 
	{
		return $this->db->get("user_groups");
	}

	public function add_group($name, $default) 
	{
		$this->db->insert("user_groups", array("name" => $name, "default" => $default));
	}

	public function get_user_group($id) 
	{
		return $this->db->where("ID", $id)->get("user_groups");
	}

	public function delete_group($id) {
		$this->db->where("ID", $id)->delete("user_groups");
	}

	public function delete_users_from_group($id) 
	{
		$this->db->where("groupid", $id)->delete("user_group_users");
	}

	public function update_group($id, $name, $default) 
	{
		$this->db->where("ID", $id)->update("user_groups", array(
			"name" => $name,
			"default" => $default
			)
		);
	}

	public function get_users_from_groups($id, $page) 
	{
		return $this->db->where("user_group_users.groupid", $id)->select("users.ID as userid, users.username, user_groups.name, user_groups.ID as groupid, user_groups.default")->join("users", "users.ID = user_group_users.userid")->join("user_groups", "user_groups.ID = user_group_users.groupid")->limit(20, $page)->get("user_group_users");
	}

	public function get_all_group_users($id) 
	{
		return $this->db->where("user_group_users.groupid", $id)->select("users.ID as userid, users.email, users.username, user_groups.name, user_groups.ID as groupid, user_groups.default")->join("users", "users.ID = user_group_users.userid")->join("user_groups", "user_groups.ID = user_group_users.groupid")->get("user_group_users");
	}

	public function get_total_user_group_members_count($groupid) 
	{
		$s= $this->db->where("groupid", $groupid)->select("COUNT(*) as num")->get("user_group_users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_user_from_group($userid, $id) 
	{
		return $this->db->where("userid", $userid)->where("groupid", $id)->get("user_group_users");
	}

	public function delete_user_from_group($userid, $id) 
	{
		$this->db->where("userid", $userid)->where("groupid", $id)->delete("user_group_users");
	}

	public function add_user_to_group($userid, $id) 
	{
		$this->db->insert("user_group_users", array("userid" => $userid, "groupid" => $id));
	}

	public function get_all_users() 
	{
		return $this->db->select("users.email, users.ID as userid")->get("users");
	}
}

?>