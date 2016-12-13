<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
	}

	public function index() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("test" => array("general" => 1)));

		// Loads HTML page
		$this->template->loadContent("test/index.php", array(
			)
		);
	}

	public function restricted_group() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("restricted" => array("groups" => 1)));

		if(!$this->user_model->check_user_in_group($this->user->info->ID, 2)) {
			$this->template->error("You are not in the User Group Friends so you cannot view this page!");
		}

		// Loads HTML page
		$this->template->loadContent("test/group.php", array(
			)
		);
	}

	public function restricted_admin() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("restricted" => array("general" => 1)));

		if($this->user->info->user_level < 4) {
			$this->template->error("You cannot view this page as you are not an admin!");
		}

		// Loads HTML page
		$this->template->loadContent("test/admin.php", array(
			)
		);
	}

	public function restricted_user() 
	{
		// Assigns the highlight to the sidebar link
		$this->template->loadData("activeLink", 
			array("restricted" => array("users" => 1)));

		if($this->user->info->username != "Admin") {
			$this->template->error("You cannot view this page as you are not the user Admin!");
		}

		// Loads HTML page
		$this->template->loadContent("test/user.php", array(
			)
		);
	}

}

?>