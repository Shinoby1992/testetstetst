<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
	    $this->theme = $this->ts_functions->current_theme();
	}

    /*********** Check Product Plan and User's Membership  STARTS *******************/

    function checkmembership($prodid='') {
        if($prodid != '') {
            if( isset($this->session->userdata['ts_uid']) ) {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$this->session->userdata('ts_uid')));

                if( $userDetail[0]['user_plans'] == 0 ) {
                    // No plan selected by user
                    $this->session->set_flashdata('plan_message', 'Upgrade your plan to access this product.');
                    redirect(base_url().'home/plans_pricing');
                }

                $prodDetail = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodid,'prod_status'=>1));
                if(!empty($prodDetail)) {
                    redirect(base_url().'dashboard/purchased');
                }
                else {
                    redirect(base_url());
                }
            }
            else {
                redirect(base_url().'home/plans_pricing');
            }
        }
        else {
            redirect(base_url());
        }
    }

    /*********** Check Product Plan and User's Membership ENDS *******************/

    /*********** Add Products to Cart STARTS *******************/
    function add_to_cart($type='',$id = ''){
        if($type == 'plan') {
            $details = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$id,'plan_status'=>1));
        }
        elseif($type == 'vendor_plan') {
            $details = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$id,'vplan_status'=>1));
        }
        else {
            $details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$id,'prod_status'=>1));
        }
        if( !empty($details) ) {

            /***** check for FREE products STARTS *******/

            if( isset($details[0]['prod_free']) && $details[0]['prod_free'] == '1' ) {
                if( isset($this->session->userdata['ts_uid']) ) {
                    redirect(base_url().'dashboard/free_downloads');
                }
                else {
                    redirect(base_url().'authenticate/login');
                }
            }
            /***** check for FREE products ENDS *******/

            /***** check for FREE products STARTS *******/

            if( isset($details[0]['prod_plan']) && $details[0]['prod_plan'] == '1' ) {
                if( isset($this->session->userdata['ts_uid']) ) {
                    redirect(base_url().'dashboard/free_downloads');
                }
                else {
                    redirect(base_url().'authenticate/login');
                }
            }
            /***** check for FREE products ENDS *******/


            if(!isset($_COOKIE['cartCookies'])){
                $cartArr = array();
                $str = base64_encode($type.'#'.$id);
                array_push($cartArr,$str);
            }
            else {
                $cartArr = json_decode($_COOKIE['cartCookies'],true);
                $err = 0;
                for($i=0;$i<count($cartArr);$i++) {
                    $prodDetails = base64_decode($cartArr[$i]);
                    $prodDetailsArr = explode('#',$prodDetails);

                    if($prodDetailsArr[1] == $id) {
                        $err++;
                    }
                }
                if( $err == '0' ) {
                    $str = base64_encode($type.'#'.$id);
                    array_push($cartArr,$str);
                }
            }
            setcookie("cartCookies", json_encode($cartArr,true) , time()+3600 * 24 * 90,'/');
            redirect(base_url().'shop/cart');
        }
        else {
            redirect(base_url());
        }
    }
    /*********** Buy plans ENDS *******************/


    /*********** Buy plans STARTS *******************/
    function cart(){
        $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;

        if(empty($cartArr)) { redirect(base_url()); }
        $data['cartArr'] = $cartArr;
        $data['basepath'] = base_url();
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/cart',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);

    }
    /*********** Buy plans ENDS *******************/

    /*********** Remove Cart STARTS *******************/
    function remove_cart($key='') {
        $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;
        if(empty($cartArr)) { redirect(base_url()); }
        $newCartArr = array();
        for($i=0;$i<count($cartArr);$i++) {
            if($i != $key) {
                array_push($newCartArr,$cartArr[$i]);
            }
        }

        setcookie("cartCookies", json_encode($newCartArr,true) , time()+3600 * 24 * 90,'/');
        redirect(base_url().'shop/cart');
    }
    /*********** Remove Cart ENDS *******************/

    /*********** Initiate payment depending on option STARTS *******************/
    function proceed_payment() {
        if( !isset($this->session->userdata['ts_uid']) ) {
            echo 'EXISTS';
            die();
        }
        if(isset($_POST['paymentmethod'])) {
            $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;

            if(empty($cartArr)) { echo 'empty'; } else {
                $prodStr = $prodCode = '';
                $prodAmount = array();
                for($i=0;$i<count($cartArr);$i++) {
                    $prodDetails = base64_decode($cartArr[$i]);
                    $prodDetailsArr = explode('#',$prodDetails);
                    if( count($prodDetailsArr) == '2' ) {
                        $id = $prodDetailsArr[1];
                        if( $prodDetailsArr[0] == 'products' ) {
                            $details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$id,'prod_status'=>1));
                            if($details[0]['prod_uid'] == $this->session->userdata['ts_uid']){
                                // Owner's Products
                                echo 'OWNER';
                                die();
                            }

                            if(!empty($details)) {
                                $prodStr .= $details[0]['prod_name'].' , ';
                                $prodCode .= $details[0]['prod_uniqid'].' , ';
                                array_push($prodAmount,$details[0]['prod_price']);
                            }
                        }
                        elseif( $prodDetailsArr[0] == 'vendor_plan' ) {
                            $details = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$id,'vplan_status'=>1));
                            if(!empty($details)) {
                                $prodStr .= $details[0]['vplan_name'].' , ';
                                $prodCode .= $details[0]['vplan_id'].' , ';
                                array_push($prodAmount,$details[0]['vplan_amount']);
                            }
                        }
                        else {
                            $details = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$id,'plan_status'=>1));
                            if(!empty($details)) {
                                $prodStr .= $details[0]['plan_name'].' , ';
                                $prodCode .= $details[0]['plan_id'].' , ';
                                array_push($prodAmount,$details[0]['plan_amount']);
                            }
                        }

                    }
                }

                $finalItemName = rtrim( trim($prodStr) ,',');
                $finalItemNumber = rtrim( trim($prodCode) ,',');

                $finalItemAmount = array_sum($prodAmount);

                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$this->session->userdata('ts_uid')));

                if(!empty($userDetail)) {

                /*** Track Payment Details *****/

                    $paymentArr = array(
                        'payment_uid'   =>  $this->session->userdata('ts_uid'),
                        'payment_pid'   =>  $finalItemNumber,
                        'payment_type'   =>  $prodDetailsArr[0]
                    );
                    $checkPreviousPayment = $this->DatabaseModel->access_database('ts_paymentdetails','select','',$paymentArr);

                    if( empty($checkPreviousPayment) ) {
                        $payUniqid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                        $paymentArr['payment_uniqid'] = $payUniqid;
                        $paymentArr['payment_date'] = date('Y-m-d H:i:s');
                        $paymentArr['payment_mode'] = $_POST['paymentmethod'];
                        $this->DatabaseModel->access_database('ts_paymentdetails','insert',$paymentArr,'');

                    }
                    else {

                        if( $checkPreviousPayment[0]['payment_status'] == 'no' ) {
                            //initiate payment
                            if( $_POST['paymentmethod'] == 'paypal' ) {
                                $payUniqid = $checkPreviousPayment[0]['payment_uniqid'];
                            }
                            else {
                                $payUniqid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                            }
                            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_date'=>date('Y-m-d H:i:s'), 'payment_uniqid'=>$payUniqid, 'payment_mode'=>$_POST['paymentmethod']),array('	payment_id'=>$checkPreviousPayment[0]['payment_id']));
                        }
                        else {
                            // Already purchased
                            echo 'EXISTS';
                            die();
                        }
                    }

                    $trackingItemNumber = $payUniqid;  // UNIQUE TRANSACTION ID

                    /*** Track Payment Details *****/

                    if( $_POST['paymentmethod'] == 'paypal' ) {
                    $formData =
                          '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pay_form_name">
                          <input type="hidden" name="business" value="'.$this->ts_functions->getsettings('paypal','email').'">
                          <input type="hidden" name="item_name" value="'.$finalItemName.'">
                          <input type="hidden" name="amount" value="'.$finalItemAmount.'">
                          <input type="hidden" name="item_number" value="'.$trackingItemNumber.'">
                          <input type="hidden" name="no_shipping" value="1">
                          <input type="hidden" name="currency_code" value="'.$this->ts_functions->getsettings('portal','curreny').'">
                          <input type="hidden" name="cmd" value="_xclick">
                          <input type="hidden" name="handling" value="0">
                          <input type="hidden" name="no_note" value="1">
                          <input type="hidden" name="cpp_logo_image" value="'.$this->ts_functions->getsettings('logo','url').'">
                          <input type="hidden" name="custom" value="'.$finalItemNumber.'">
                          <input type="hidden" name="cancel_return" value="'.base_url().'pages/canceled_payment">
                          <input type="hidden" name="return" value="'.base_url().'pages/success_payment">
                            <input type="hidden" name="notify_url" value="'.base_url().'pages/notify_payment">
                         </form>';
                    }
                    elseif( $_POST['paymentmethod'] == 'payu' )  {
                        $MERCHANT_KEY = $this->ts_functions->getsettings('payu','merchantKey');

                        $SALT = $this->ts_functions->getsettings('payu','merchantSalt');

                        $txnid = $trackingItemNumber;

                        $hash_string = $MERCHANT_KEY.'|'.$txnid.'|'.$finalItemAmount.'|'.$finalItemName.'|'.$this->session->userdata('ts_uname').'|'.$userDetail[0]['user_email'].'|||||||||||'.$SALT;
                        $hash = strtolower(hash('sha512', $hash_string));

                    $formData =
                         '<form action="https://secure.payu.in/_payment" method="post" name="payuForm">
                          <input type="hidden" name="key" value="'.$this->ts_functions->getsettings('payu','merchantKey').'" />
                          <input type="hidden" name="hash" value="'.$hash.'"/>
                          <input type="hidden" name="txnid" value="'.$txnid.'" />
                          <input type="hidden" name="amount" value="'.$finalItemAmount.'" />
                          <input type="hidden" name="firstname" id="firstname" value="'.$this->session->userdata('ts_uname').'" />
                          <input type="hidden" name="email" id="email" value="'.$userDetail[0]['user_email'].'" />
                          <input type="hidden" name="phone" value="'.$userDetail[0]['user_mobile'].'" />
                          <input type="hidden" name="productinfo" value="'.$finalItemName.'" />
                          <input type="hidden" name="surl" value="'.base_url().'pages/payu_success_payment">
                          <input type="hidden" name="furl" value="'.base_url().'pages/canceled_payment">
                          <input type="hidden" name="curl" value="'.base_url().'pages/canceled_payment">
                          <input type="hidden" name="service_provider" value="payu_paisa">
                         </form>';
                    }
                    elseif( $_POST['paymentmethod'] == 'stripe' )  {
                        $publishableKey = $this->ts_functions->getsettings('stripe','publishableKey');
                        $finalItemAmount = $finalItemAmount.'00';

                        $_SESSION['stripeSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                    $formData =
                         '<form action="'.base_url().'pages/stripe_checkout" method="POST" name="stripe_form" id="stripe_form"><script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="'.$publishableKey.'" data-image="'.$this->ts_functions->getsettings('logo','url').'" data-name="'.$finalItemName.'" data-description="'.$finalItemName.'" data-amount="'.$finalItemAmount.'" data-locale="auto"/></script></form>';
                    }
                    elseif( $_POST['paymentmethod'] == '2checkout' )  {
                        $accountNumber = $this->ts_functions->getsettings('2checkout','acntnumber');

                        $_SESSION['2checkoutSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $formData = '<form name="2checkout" action="https://www.2checkout.com/checkout/spurchase" method="post"><input type="hidden" name="sid" value="'.$accountNumber.'"/><input type="hidden" name="mode" value="2CO"/><input type="hidden" name="li_0_name" value="'.$finalItemName.'"/><input type="hidden" name="li_0_price" value="'.$finalItemAmount.'"/><input type="hidden" name="x_receipt_link_url" value="'.base_url().'pages/checkout2_return"/></form>';
                    }
                    elseif( $_POST['paymentmethod'] == 'banktransfer' )  {
                        if( $this->ts_functions->getsettings('banktransfer','details') != '' ) {
                            $accountDetails = explode(PHP_EOL, $this->ts_functions->getsettings('banktransfer','details'));
                        }

                        $_SESSION['banktransferSession'] = $finalItemAmount.'@#'.$trackingItemNumber;

                        $detailsStr = '';

                        if( $this->ts_functions->getsettings('banktransfer','details') != '' ) {
                            for($i=0;$i<count($accountDetails);$i++) {
							    $detailsStr .= '<p>'.$accountDetails[$i].'</p>';
							}
                        }

                        $formData = '<div class="banktransfer_div"> '.$detailsStr.' <span> '. $this->ts_functions->getlanguage('banktransfernote','homepage','solo').' </span>
                        <p> <input type="checkbox" id="transactionDone" onclick="transactionDone(this)"> <label for="transactionDone">'. $this->ts_functions->getlanguage('banktransfersecond','homepage','solo').' </label></p>
                        <div class="transactionDone_div" style="display:none;">
                        <span> '. $this->ts_functions->getlanguage('banktransferthird','homepage','solo').' </span>
                        <p> <textarea class="transactionDone_textarea"></textarea> </p>
                        <a onclick="savetransactionmadedetails();" class="ts_btn pull-right"> '. $this->ts_functions->getlanguage('submittext','authentication','solo').' <i class="fa fa-spinner fa-spin ts_transactionDone_wait hideme" aria-hidden="true"></i></a>
                        </div>
                        </div>';
                    }
                    elseif( $_POST['paymentmethod'] == 'bitcoin' )  {
/*
                        $b_publickey = $this->ts_functions->getsettings('bitcoin','publickey');
                        $b_privatekey = $this->ts_functions->getsettings('bitcoin','privatekey');
                        require_once( "Bitcoin/cryptobox.class.php" );

                        $options = array(
                            "public_key"  => $b_publickey,
                            "private_key" => $b_privatekey,
                            "orderID"     => $trackingItemNumber,
                            "userFormat"  => "COOKIE",
                            "amountUSD"   => $finalItemAmount,
                            "period"      => "24 HOUR",
                            "iframeID"    => "",
                            "language"	  => "EN"
                        );

	                    $box = new Cryptobox ($options);

                    	$payment_box = $box->display_cryptobox(true, 560, 230, "border-radius:15px;border:1px solid #eee;padding:3px 6px;margin:10px;",					"display:inline-block;max-width:580px;padding:15px 20px;border:1px solid #eee;margin:7px;line-height:25px;");

                        $message = "";
*/
                        // A. Process Received Payment
                        /*if ($box->is_paid())
                        {
                            $message .= "A. User will see this message during 24 hours after payment has been made!";

                            $message .= "<br>".$box1->amount_paid()." ".$box1->coin_label()."  received<br>";

                            // Your code here to handle a successful cryptocoin payment/captcha verification
                            // For example, give user 24 hour access to your member pages
                            // ...

                            // Please use IPN (instant payment notification) function cryptobox_new_payment() for update db records, etc
                            // Function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") called every time
                            // when a new payment from any user is received.
                            // IPN description: https://gourl.io/api-php.html#ipn
                        }
                        else {
                            $message .= "The payment has not been made yet";
                        }
                        */

/*
                        // B. Optional - One-time Process Received Payment
                        if ($box->is_paid() && !$box->is_processed())
                        {
                            $message .= "B. User will see this message one time after payment has been made!";

                            // Your code here - user see successful payment result
                            // ...

                            // Also you can use $box1->is_confirmed() - return true if payment confirmed
                            // Average transaction confirmation time - 10-20min for 6 confirmations

                            // Set Payment Status to Processed
                            $box->set_status_processed();

                            // Optional, cryptobox_reset() will delete cookies/sessions with userID and
                            // new cryptobox with new payment amount will be show after page reload.
                            // Cryptobox will recognize user as a new one with new generated userID
                            // $box1->cryptobox_reset();


                            // ...
                            // Also you can use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")
                            // for send confirmation email, update database, update user membership, etc.
                            // You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
                            // ...

                        }
*/
                         //$formData =  '<script src="'.base_url().'adminassets/js/bitcoin/cryptobox.min.js" type="text/javascript"></script>'.$payment_box.$message;

                         $formData = '<p style="color:red;text-align:center;"> Please contact support team of Script to complete the integration.</p>';
                    }
                    elseif( $_POST['paymentmethod'] == 'wallet' )  {
                        $_SESSION['walletSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                         $formData = '<script> window.location = "'.base_url().'pages/wallet_payment"; </script>';
                    }
                    elseif( $_POST['paymentmethod'] == 'webmoney' )  {
                        $purseNumber = $this->ts_functions->getsettings('webmoney','purse');

                        $_SESSION['webmoneySession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $formData = '<form id=pay name=pay method="POST" action="https://merchant.wmtransfer.com/lmi/payment.asp"> <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$finalItemAmount.'"> <input type="hidden" name="LMI_PAYMENT_DESC" value="'.$finalItemName.'"> <input type="hidden" name="LMI_PAYMENT_NO" value="1"> <input type="hidden" name="LMI_PAYEE_PURSE" value="'.$purseNumber.'">   <input type="hidden" name="LMI_SIM_MODE" value="0"> <input type="hidden" name="LMI_SUCCESS_URL" value="'.base_url().'pages/webmoney_success">   <input type="hidden" name="LMI_SUCCESS_METHOD" value="1">  <input type="hidden" name="LMI_FAIL_URL" value="'.base_url().'pages/canceled_payment"> <input type="hidden" name="LMI_FAIL_METHOD" value="1"></form>
                        ';
                    }
                    elseif( $_POST['paymentmethod'] == 'yandex' )  {
                        $walletNumber = $this->ts_functions->getsettings('yandex','wallet');

                        $_SESSION['yandexSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $url = urlencode(base_url().'pages/yandex_success');

                        //$formData = '<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account='.$walletNumber.'&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets='.$finalItemName.'&default-sum='.$finalItemAmount.'&button-text=01&successURL='.$url.'" width="450" height="198"></iframe>';

                        $formData = '<iframe frameborder="0" allowtransparency="true" scrolling="no" style="margin-top: 40px;" src="https://money.yandex.ru/quickpay/button-widget?account='.$walletNumber.'&quickpay=small&yamoney-payment-type=on&button-text=02&button-size=m&button-color=orange&targets='.$finalItemName.'&default-sum='.$finalItemAmount.'&successURL='.$url.'" width="125" height="36"></iframe>';
                    }
                    echo $formData;
                }
                else {
                    echo 0;
                }
            }
        }
        else {
            echo 0;
        }
        die();

    }
    /*********** Initiate payment depending on option ENDS *******************/

    /**************** Manual Transactions START ****************/

    function savetransactionmadedetails(){
        if(isset($_POST['txtDetails'])) {
            if( $_POST['txtDetails'] != '' ) {
                if(isset($_SESSION['banktransferSession'])) {
                    $detailss = explode('@#',$_SESSION['banktransferSession']);
                    $payable_amount = $detailss[0];
                    $uid = $this->session->userdata['ts_uid'];
                    $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
                    $this->DatabaseModel->access_database('ts_paymentdetails','update', array('payment_date'=>date('Y-m-d H:i:s'), 'payment_note'=>$_POST['txtDetails'],'payment_amount'=>$payable_amount,'payment_email'=>$userDetail[0]['user_email']) , array('payment_uniqid'=>$detailss[1]));
                    echo 1;
                }
                else {
                    echo 0;
                }
            }
            else {
                echo 0;
            }
        }
        else {
            echo 0;
        }
        die();
    }
    /**************** Manual Transactions ENDS ****************/

}
