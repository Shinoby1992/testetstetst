<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("members" => array("general" => 1)));

		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function index($col=0,$sort=0,$page=0) 
	{
		$page = intval($page);
		$col = intval($col);
		$sort = intval($sort);

		$sort_o = $sort;
		$col_o = $col;

		// Pagination
		$config['base_url'] = site_url("members/index/" . $col . "/" . $sort);

		if($col == 1) {
			$col = "users.username";
		} elseif($col == 2) {
			$col = "users.first_name";
		} elseif($col == 3) {
			$col = "users.user_role";
		} elseif($col == 4) {
			$col = "users.joined";
		} elseif($col == 5) {
			$col = "users.oauth_provider";
		}

		if($sort == 1) {
			$sort = "ASC";
		} else {
			$sort = "DESC";
		}

		$members = $this->user_model->get_members($page, $col, $sort);

		$this->load->library('pagination');

		$config['total_rows'] = $this->user_model
			->get_total_members_count();
		$config['per_page'] = 20;
		$config['uri_segment'] = 5;

		include (APPPATH . "/config/page_config.php");

		$this->pagination->initialize($config); 

		$this->template->loadContent("members/index.php", array(
			"members" => $members,
			"sort" => $sort_o,
			"col" => $col_o,
			"page" => $page
			)
		);
	}

	public function search() 
	{

		$search = $this->common->nohtml($this->input->post("search"));

		if(empty($search)) $this->template->error(lang("error_49"));

		$members = $this->user_model->get_members_by_search($search);
		if($members->num_rows() == 0) $this->template->error(lang("error_50"));

		$this->template->loadContent("members/search.php", array(
			"members" => $members,
			"search" => $search
			)
		);
	}

}

?>