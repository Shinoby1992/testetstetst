<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( isset($this->session->userdata['ts_uid']) ) {
			if($this->session->userdata['ts_level'] == 1) {
			    redirect(base_url().'backend'); // Admin
			}
			else {
			    redirect(base_url().'dashboard');
			}
		}


		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
        $this->theme = $this->ts_functions->current_theme();
	}

	public function index()
	{
		redirect(base_url().'authenticate/login');
	}

	// Login page
	public function login($key='')
	{
	    if($key != '') {
	        $res = $this->DatabaseModel->access_database('ts_user','select','',array('user_key'=>$key,'user_status'=>2));
	        if( !empty($res) ) {
	            $data['invalidAccess'] = 1;
	            $this->DatabaseModel->access_database('ts_user','update',array('user_status'=>1,'user_key'=>''),array('user_key'=>$key));
	        }
	        else {
	            $data['invalidAccess'] = 0;
	        }
	    }
	    else {
	        $data['invalidAccess'] = 2;
	    }
		$data['basepath'] = base_url();
		$data['name_of_page'] = 'login';

		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/login',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

    // Register page
    public function register()
	{
		$data['basepath'] = base_url();
		$data['name_of_page'] = 'register';
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/register',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

	// Registeration section / Login p
	function getuserin_section() {
        if( isset($_POST['users_uname']) ) {
        if( isset($_POST['users_pwd']) ) {

            // Check Login
            $result_uname = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$_POST['users_uname'],'user_pwd'=>md5($_POST['users_pwd'])));

            $result_uemail = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$_POST['users_uname'],'user_pwd'=>md5($_POST['users_pwd'])));

            if (!empty($result_uname) || !empty($result_uemail)) {

                $result = !empty($result_uname) ? $result_uname : $result_uemail ;

                if($result[0]['user_status'] == '2') {
                    echo "2#error"; // InActive
                }
                elseif($result[0]['user_status'] == '3') {
                    echo "3#error"; // Blocked
                }
                else
                {
                    $userPlan = $result[0]['user_plans'];
                    $uid = $result[0]['user_id'];
                    if( $userPlan != '0' ) {
                        $planDetails = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$userPlan));
                        $planDuration = explode(' ',$planDetails[0]['plan_duration']);
                        if( $planDuration[1] == 'Time' ) {
                            $planstatus = 1; // Life time
                        }
                        else {
                            if( $planDuration[1] == 'Days' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
                            }
                            elseif( $planDuration[1] == 'Weeks' ) {
                                $n = $planDuration[0] * 7 ;
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
                            }
                            elseif( $planDuration[1] == 'Months' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
                            }
                            elseif( $planDuration[1] == 'Years' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
                            }
                            $p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_plansdate <'=>$p_date));

                            $planstatus = empty($p) ? '1' : '0' ;
                        }
                    }
                    else {
                        $planstatus = '404';
                    }

                    // Vendor Plans

                    $vendorPlan = $result[0]['user_vplans'];
                    if( $vendorPlan != '0' ) {
                        $planDetails = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$vendorPlan));
                        $planDuration = explode(' ',$planDetails[0]['vplan_duration']);
                        if( $planDuration[1] == 'Time' ) {
                            $planstatus = 1; // Life time
                        }
                        else {
                            if( $planDuration[1] == 'Days' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
                            }
                            elseif( $planDuration[1] == 'Weeks' ) {
                                $n = $planDuration[0] * 7 ;
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
                            }
                            elseif( $planDuration[1] == 'Months' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
                            }
                            elseif( $planDuration[1] == 'Years' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
                            }
//echo $p_date;
                            $p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_vplansdate <'=>$p_date));

                            $vplanstatus = empty($p) ? '1' : '0' ;
                        }
                    }
                    else {
                        $vplanstatus = '404';
                    }

                    $user_details	= array(
                        'ts_uid'		=> $uid,
                        'ts_uname'		=> $result[0]['user_uname'],
                        'ts_login'		=> true,
                        'ts_level'		=> $result[0]['user_accesslevel'],
                        'ts_planstatus'		=> $planstatus,
                        'ts_vendorplanstatus'		=> $vplanstatus
                    );

                    $this->session->set_userdata($user_details);

                    if($_POST['rem_me'] == '1'){
                        setcookie("ts_emanu", $_POST['users_uname'] , time()+3600 * 24 * 14,'/');
                        setcookie("ts_dwp", $_POST['users_pwd'] , time()+3600 * 24 * 14,'/');
                    }
                    elseif($_POST['rem_me'] == '0')
                    {
                        setcookie("ts_emanu", $_POST['users_uname'] , time()-3600 * 24 * 365,'/');
                        setcookie("ts_dwp", $_POST['users_pwd'] , time()-3600 * 24 * 365,'/');
                    }

                    echo ( $result[0]['user_accesslevel'] == '1' ) ? '7#adminredirect' : '7#redirect';
                    // Login success
                }
            }
            else {
                if(isset($_POST['users_email'])) {
                    $email = $_POST['users_email'];
                    $un = $_POST['users_uname'];
                    $pwd = $_POST['users_pwd'];

                    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pwd) > 7 && preg_match("/^[a-zA-Z0-9\d]+$/",$un) ) {
                        $checkUsername = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$_POST['users_uname']));

                        if(empty($checkUsername)) {
                            $checkEmail = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$_POST['users_email']));

                            if(empty($checkEmail)) {

                                $key = md5(date('his').$_POST['users_email']);
                                $data_arr	= array('user_uname'=>$_POST['users_uname'],'user_email'=>$_POST['users_email'],'user_pwd'=>md5($_POST['users_pwd']),'user_accesslevel'=>2,'user_status'=>2);
                                $data_arr['user_key'] = $key;

                                $uid = $this->DatabaseModel->access_database('ts_user','insert',$data_arr,'');

                                /* Subscribe to list */
                                $s = $this->ts_functions->subscribeemails( $_POST['users_email'] , 'registeredemails');
                                /* Subscribe to list */

                                echo $this->ts_functions->sendnotificationemails('registrationemail', $_POST['users_email'], 'Verification Link' , $_POST['users_uname'] , base_url().'authenticate/login/'.$key );

                                // Register success

                            }
                            else {
                                echo '7#exists';
                                // Email exists
                            }
                        }
                        else {
                            echo '6#exists';
                            // Username exists
                        }
                    }
                    else {
                        echo '404#js_mistake';
                        // Server Error exists
                    }
                }
                else {
                    echo '0#error';
                    // Login credentials don't match
                }
            }
        }
        else {
            // Forgot Password Section
            $where = "user_email='".$_POST['users_uname']."' OR user_uname='".$_POST['users_uname']."'";
            $result = $this->DatabaseModel->access_database('ts_user','select','',$where);

            if (!empty($result)) {
                if($result[0]['user_status'] == '2') {
                    echo "2#error"; // InActive
                }
                elseif($result[0]['user_status'] == '3') {
                    echo "3#error"; // Blocked
                }
                else
                {
                    $uid = $result[0]['user_id'];
                    $key = md5(date('Ymdhis').$uid);
                    $this->DatabaseModel->access_database('ts_user','update',array('user_key'=>$key),array('user_id'=>$uid));
                    /*

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <help@themeportal.com>' . "\r\n";

                    $msg = '<p>Hi , '.$result[0]['user_uname'].'</p> <p>click on the link below to reset your password <a href="'.base_url().'authenticate/reset_password/'.$key.'">'.base_url().'authenticate/reset_password/'.$key.'</p><br/><br/><p>Thanks, <br/> Team, Themeportal</p>';

                    mail($result[0]['user_email'],'Forgot Password',$msg,$headers);
                    */

                    echo $this->ts_functions->sendnotificationemails('forgotpwdemail', $result[0]['user_email'], 'Forgot Password' , $result[0]['user_uname'] , base_url().'authenticate/reset_password/'.$key );

                    // Forgot email sent
                }
            }
            else {
                echo '5#error';
                // Forgot Email does not match
            }
        }
        }
        else {
            echo '404#error';
            // False access
        }
			die();
	}

	// Forgot Password

	function forgot_password(){
        $data['basepath'] = base_url();
		$data['name_of_page'] = 'forgotpwd';
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/forgot_password',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

	// Reset Password

	function reset_password($key=''){
	    if($key != '') {
	        $res = $this->DatabaseModel->access_database('ts_user','select','',array('user_key'=>$key));
	        $data['invalidAccess'] = (!empty($res)) ? 0 : 1 ;
	        $data['pwdKey'] = $key;
	        $data['basepath'] = base_url();
            $data['name_of_page'] = 'resetpwd';
            $this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
            $this->load->view('themes/'.$this->theme.'/home/authenticate/reset_password',$data);
            $this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	    }
	    else {
	        redirect(base_url());
	    }
	}

	function update_resetpwdform(){
	    if(isset($_POST['users_pwd'])) {
	        $key = $_POST['key'];
	        $this->DatabaseModel->access_database('ts_user','update',array('user_key'=>'','user_status'=>1,'user_pwd'=>md5($_POST['users_pwd'])),array('user_key'=>$key));
            echo "1#suc";
        }
        else {
            echo "1#error";
        }
	}

}
