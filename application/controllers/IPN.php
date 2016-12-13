<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IPN extends CI_Controller 
{

	public $project = null;

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("ipn_model");
		$this->load->model("user_model");
		$this->config->set_item('csrf_protection', FALSE);

	}

	public function index() 
	{
		exit();
	}

	public function process2() 
	{
		require_once('paypal/config.php');
		$this->ipn_model->log_ipn("Attempted to pay Funds");
		// Read the post from PayPal system and add 'cmd'   
		$req = 'cmd=_notify-validate';  

		// Store each $_POST value in a NVP string: 1 string encoded 
		// and 1 string decoded   
		$ipn_email = '';  
		$ipn_data_array = array();
		foreach ($_POST as $key => $value)   
		{   
		 $value = urlencode(stripslashes($value));   
		 $req .= "&" . $key . "=" . $value;   
		 $ipn_email .= $key . " = " . urldecode($value) . '<br />';  
		 $ipn_data_array[$key] = urldecode($value);
		}

		// Store IPN data serialized for RAW data storage later
		$ipn_serialized = serialize($ipn_data_array);
		  
		// Validate IPN with PayPal
		require_once('paypal/validate.php');

		// Load IPN data into PHP variables
		require_once('paypal/parse-ipn-data.php');

		$ipn_log_data['ipn_data_serialized'] = $ipn_serialized;

		if(strtoupper($txn_type) == 'WEB_ACCEPT') {
			$this->ipn_model->log_ipn($ipn_log_data['ipn_data_serialized']);
			// Invoice Payment
			$userid = intval($this->common->nohtml($custom));
			$id = intval($item_number);
			$this->ipn_model->log_ipn("Tried to pay Funds ($mc_gross): " . 
				$id . " Userid:" . $userid);

			// Get amount
			$amount = abs($mc_gross);
			$this->user_model->add_points($userid, $amount);
			$this->ipn_model->log_ipn("Payment Added to user: $userid, $amount");
			$this->ipn_model->add_payment(array(
				"userid" => $userid, 
				"amount" => $amount, 
				"timestamp" => time(), 
				"email" => $this->common->nohtml($payer_email)
				)
			);
		}
	}

}

?>