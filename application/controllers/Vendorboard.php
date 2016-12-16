<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendorboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( !isset($this->session->userdata['ts_uid']) ) {
			redirect(base_url());
		}
		if( isset($this->session->userdata['ts_uid']) ) {
    		if($this->session->userdata['ts_level'] == 1) {
			    redirect(base_url().'backend');
			}
			if($this->session->userdata['ts_level'] == 2) {
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

    /******* Index page STARTS ***************/
	public function index(){
//print_r($_SESSION);
	    /**** Check Vendor Plans STARTS ********/
	    if($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' ) {
            if( $this->session->userdata['ts_vendorplanstatus'] == '0' ) {
                $this->session->set_flashdata('vendorplanMsg', 'Your current vendor plan has expired.');
                redirect(base_url().'dashboard/purchased');
            }
        }
	    /**** Check Vendor Plans ENDS ********/

		$data['basepath'] = base_url();

        $uid = $this->session->userdata['ts_uid'];
        $data['productdetails_active'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_uid'=>$uid));
        $data['productdetails_free'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>1,'prod_uid'=>$uid));

        $total_products = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uid'=>$uid));

        $prodUniqIdArr = array();
        $prodDBIdArr = array();
        if(!empty($total_products)) {
            foreach($total_products as $solo_prod) {
                array_push($prodUniqIdArr,$solo_prod['prod_uniqid']);
                array_push($prodDBIdArr,$solo_prod['prod_id']);
            }
        }

        if( !isset($_POST['duration'])) {

            if(!empty($prodUniqIdArr)) {
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','wherein',$prodUniqIdArr,'','prod_analysis_prodid');
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','wherein',$prodDBIdArr,'','purrec_prodid');
            }
            else {
                $data['prodViews'] = $data['prodSales'] = array();
            }

            $data['duration'] = $data['d1'] = $data['d2'] = '';
        }
        else if(isset($_POST['duration'])) {

            if(!empty($prodUniqIdArr)) {
                if( $_POST['duration'] == '' ) {

                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','wherein',$prodUniqIdArr,'','prod_analysis_prodid');
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','wherein',$prodDBIdArr,'','purrec_prodid');

                }
                elseif($_POST['duration'] == 'today'){
                    $todaydate = date('Y-m-d');

                    $like_arr = array('prod_analysis_date'=>$todaydate);
                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select_like',$like_arr,'',array('prod_analysis_prodid',json_encode($prodUniqIdArr)));

                    $like_arr = array('purrec_date'=>$todaydate);
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select_like',$like_arr,'',array('purrec_prodid',json_encode($prodDBIdArr)));

                }
                elseif($_POST['duration'] == 'yesterday'){
                    $yesterdate = date('Y-m-d',strtotime("-1 days"));

                    $havingArr = array('user_accesslevel'=>2);
                    $like_arr = array('user_registerdate'=>$yesterdate);
                    $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','like',$havingArr,$like_arr);

                    $like_arr = array('prod_analysis_date'=>$yesterdate);
                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','like','',$like_arr);

                    $like_arr = array('purrec_date'=>$yesterdate);
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','like','',$like_arr);

                    $like_arr = array('e_date'=>$yesterdate);
                    $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','like','',$like_arr);
                }
                elseif($_POST['duration'] == 'custom'){
                    $fromdate = date_format(date_create ( $_POST['d1'] ) , 'Y-m-d H:i:s');
                    $todate = date_format(date_create ( $_POST['d2'] ) , 'Y-m-d H:i:s');

                    $whr = array(
                            'user_registerdate >=' =>  $fromdate,
                            'user_registerdate <=' =>  $todate,
                            'user_accesslevel'=>2
                    );
                    $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',$whr);

                    $whr = array(
                            'prod_analysis_date >=' =>  $fromdate,
                            'prod_analysis_date <=' =>  $todate
                    );
                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',$whr);

                    $whr = array(
                            'purrec_date >=' =>  $fromdate,
                            'purrec_date <=' =>  $todate
                    );
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select','',$whr);

                    $whr = array(
                            'e_date >=' =>  $fromdate,
                            'e_date <=' =>  $todate
                    );
                    $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','select','',$whr);

                }
            }
            else {
                $data['prodViews'] = $data['prodSales'] = array();
            }

            $data['duration'] = $_POST['duration'];
            $data['d1'] = $_POST['d1'];
            $data['d2'] = $_POST['d2'];
        }


        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/vboard',$data);
	}
	/******* Index page ENDS ***************/

    /*************** Add Products STARTS *****************/

    public function add_products(){
		$data['basepath'] = base_url();
		$data['oldprod_id'] = '0';
		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
		$data['actionUrl'] = base_url().'vendorboard/modify_products';
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('backend/add_products',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}

    /*************** Add Products ENDS *****************/

    public function manage_products(){
        $data['basepath'] = base_url();
		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$uid = $this->session->userdata['ts_uid'];
		$data['productdetails'] = $this->DatabaseModel->access_database('ts_products','','',array('prod_uid'=>$uid),$join_array);
		$data['actionUrl'] = base_url().'vendorboard/modify_products';
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('backend/manage_products',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}

	public function update_products($uniq_id=''){
	    if( $uniq_id == '' ) {
	        redirect(base_url().'vendorboard/manage_products');
	    }
		$data['basepath'] = base_url();

		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
    	$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');

    	$uid = $this->session->userdata['ts_uid'];
		$productdetails = $this->DatabaseModel->access_database('ts_products','','',array('prod_uniqid'=>$uniq_id,'prod_uid'=>$uid),$join_array);
		$data['productdetails'] = $productdetails;
		$data['oldprod_id'] = $productdetails[0]['prod_id'];
		$data['actionUrl'] = base_url().'vendorboard/modify_products';
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('backend/add_products',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}

    /*************** Save Products STARTS *****************/

	public function modify_products() {
	    if(isset($_POST['p_name'])) {

            $imgDataArr = array();
            $errorCounter = 0;
	        if( isset($_FILES) ) {
                $path=dirname(__FILE__);
                $abs_path=explode('/application/',$path);
                $pathToImages = $abs_path[0].'/repo/images/';
                $pathToZip = $abs_path[0].'/repo/mainzipfiles/';
                $pathToGallery = $abs_path[0].'/repo/gallery/';
                $pathToThumbImages = $abs_path[0].'/repo/images/small/';
                $previous_Details = $this->DatabaseModel->access_database('ts_products','select','', array('prod_id'=>$_POST['oldprod_id']));

                if($_FILES['p_image']['name'] != ''){
                    $config['upload_path'] = $pathToImages;
                    $config['max_size'] = 0;
                    $config['allowed_types'] = 'jpg|jpeg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('p_image'))
                    {
                        $uploaddata=$this->upload->data();
                        if( $uploaddata['image_width'] == 750 && $uploaddata['image_height'] == 400 ) {
                            $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
                            $imgNewname = $randomstr;
                            $img_name = $uploaddata['raw_name'];
                            $img_ext = $uploaddata['file_ext'];

                            $imgNewname = $imgNewname.$img_ext;
                            $thumbname = $randomstr.'_thumb'.$img_ext;

                            if(strtolower($img_ext) == '.jpg' || strtolower($img_ext) == '.jpeg'){
                                $img = imagecreatefromjpeg( "{$pathToImages}{$img_name}{$img_ext}" );
                            }
                            elseif(strtolower($img_ext) == '.png')
                            {
                                $img = imagecreatefrompng( "{$pathToImages}{$img_name}{$img_ext}" );
                            }
                            $thumbWidth = '394';
                            $thumbHeight = '210';

                            $width = imagesx( $img );
                            $height = imagesy( $img );

                            $new_width = $thumbWidth;
                            //$new_height = floor( $height * ( $thumbWidth / $width ) );
                            $new_height = $thumbHeight;

                            $tmp_img = imagecreatetruecolor( $new_width, $new_height );

                            imagealphablending($tmp_img, false);
                            imagesavealpha($tmp_img, true);
                            $transparent =  imagecolorallocate($tmp_img, 0, 0, 0);
                            imagecolortransparent($tmp_img, $transparent );

                            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

                            if(strtolower($img_ext) == '.jpg' || strtolower($img_ext) == '.jpeg'){
                                imagejpeg( $tmp_img, "{$pathToThumbImages}{$img_name}{$img_ext}" );
                            }
                            elseif(strtolower($img_ext) == '.png')
                            {
                                imagepng( $tmp_img, "{$pathToThumbImages}{$img_name}{$img_ext}", 9 );
                            }

                            rename($pathToImages.$img_name.$img_ext, $pathToImages.$imgNewname);
                            rename($pathToThumbImages.$img_name.$img_ext, $pathToThumbImages.$thumbname);
                            $imgDataArr['prod_image']=$imgNewname;
                        }
                        else {
                            $this->session->userdata['ts_error_img'] = 'Image should be of mentioned size.';
                            $errorCounter++;
                        }
                    }
                    else {
                        $this->session->userdata['ts_error_img'] = 'Upload JPG or PNG format image.';
                        $errorCounter++;
                    }
                }

                if($_FILES['p_file']['name'] != ''){

                    if( $_FILES["p_file"]["type"] == 'application/octet-stream' || $_FILES["p_file"]["type"] == 'application/x-zip-compressed' || $_FILES["p_file"]["type"] == 'application/zip' || $_FILES["p_file"]["type"] == 'application/x-zip' || $_FILES["p_file"]["type"] == 'application/x-compressed' ){
                        $config1['upload_path'] = $pathToZip;
                        $config1['allowed_types'] = '*';
                        $config1['max_size'] = 0;
                        $this->load->library('upload', $config1);
                        $this->upload->initialize($config1);

                        if($this->upload->do_upload('p_file')){
                            $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
                            $zipNewname = $randomstr;
                            $uploaddata=$this->upload->data();
                            $zip_name = $uploaddata['raw_name'];
                            $zip_ext = $uploaddata['file_ext'];
                            $zipNewname = $zipNewname.$zip_ext;

                            rename($pathToZip.$zip_name.$zip_ext, $pathToZip.$zipNewname);
                            $imgDataArr['prod_filename']=$zipNewname;
                        }
                        else {
                            $this->session->userdata['ts_error_file'] = 'Unable to upload files.';
                            $errorCounter++;
                        }
                    }
                    else {
                        $this->session->userdata['ts_error_file'] = 'Upload ZIP format file for product files.';
                        $errorCounter++;
                    }

                }
                else {
                    if( $_POST['p_downlink'] != '' ) {
                        $imgDataArr['prod_filename']=$_POST['p_downlink'];
                        if(!empty($previous_Details)) {
                            if( $previous_Details[0]['prod_filename'] != '' ) {
                                if( strpos($previous_Details[0]['prod_filename'],'/') === false ) {
                                    $path=dirname(__FILE__);
                                    $abs_path=explode('/application/',$path);
                                    $source_path = $abs_path[0].'/repo/mainzipfiles/';
                                    unlink($source_path.$previous_Details[0]['prod_filename']);
                                }
                            }
                        }
                    }
                }

                $uid = $this->session->userdata['ts_uid'];
                $dataArr = array(
                    'prod_name' =>  trim($_POST['p_name']),
                    'prod_urlname' =>  strtolower(trim($_POST['p_urlname'])),
                    'prod_tags' =>  trim($_POST['p_tags']),
                    'prod_description' =>  trim($_POST['p_description']),
                    'prod_cateid' =>  trim($_POST['p_category']),
                    'prod_demourl' =>  trim($_POST['p_demourl'])
                );

                if(isset($_POST['p_price'])) {
                    $dataArr['prod_price']=$_POST['p_price'];
                }
                else if( isset($_POST['p_plan']) ) {
                    $dataArr['prod_plan']=implode(',',$_POST['p_plan']);
                }

                if(isset($_POST['p_free'])) {
                    $dataArr['prod_free']=1;
                }
                else {
                    $dataArr['prod_free']=0;
                }

                if(isset($_POST['p_showgallery'])) {
                    $dataArr['prod_gallery']=1;
                }
                else {
                    $dataArr['prod_gallery']=0;
                }

                if( $errorCounter == '0' ) {
                    if($_POST['oldprod_id']=='0') {
                        $dataArr['prod_date'] = date('Y-m-d H:i:s');
                        $dataArr['prod_uniqid'] = substr(str_shuffle("01234123456789123489"), 0, 6);
                        $dataArr['prod_uid'] = $uid;
                        $dataArr['prod_status'] = 0;

                        $combineDataArr = array_merge ($dataArr,$imgDataArr);
                        $prodId =  $this->DatabaseModel->access_database('ts_products','insert',$combineDataArr,'');
                        $this->session->userdata['ts_success'] = 'Product added successfully.';
                    }
                    else {
                        $combineDataArr = array_merge ($dataArr,$imgDataArr);
                        $this->DatabaseModel->access_database('ts_products','update',$combineDataArr, array('prod_id'=>$_POST['oldprod_id']));
                        $this->session->userdata['ts_success'] = 'Product updated successfully.';

                        $prodId = $_POST['oldprod_id'];
                    }

                    if($_FILES['p_gallery']['name'] != ''){

                        if( $_FILES["p_gallery"]["type"] == 'application/octet-stream' || $_FILES["p_gallery"]["type"] == 'application/x-zip-compressed' || $_FILES["p_gallery"]["type"] == 'application/zip' || $_FILES["p_gallery"]["type"] == 'application/x-zip' || $_FILES["p_gallery"]["type"] == 'application/x-compressed' ){
                            $config2['upload_path'] = $pathToGallery;
                            $config2['allowed_types'] = '*';
                            $config2['max_size'] = 0;
                            $this->load->library('upload', $config2);
                            $this->upload->initialize($config2);

                            $productFolderName = 'p_'.$prodId;

                            function deleteCompleteDir($finaldirectory) {
                                if (substr($finaldirectory, strlen($finaldirectory) - 1, 1) != '/') {
                                    $finaldirectory .= '/';
                                }
                                $files = glob($finaldirectory . '*', GLOB_MARK);
                                foreach ($files as $file) {
                                    if (is_dir($file)) {
                                        deleteCompleteDir($file);
                                    } else {
                                        unlink($file);
                                    }
                                }
                            }

                            if($this->upload->do_upload('p_gallery')){

                                $finaldirectory = $abs_path[0].'/repo/gallery/'.$productFolderName;

                                if( !file_exists( $finaldirectory ) ) {
                                    mkdir ($finaldirectory);
                                }
                                else {
                                    deleteCompleteDir($finaldirectory);

                                    $this->DatabaseModel->access_database('ts_prodgallery','delete','', array('prodgallery_pid'=>$prodId));
                                }

                                $uploaddata=$this->upload->data();

                                $zip_name=$uploaddata['raw_name'];
                                $zip_ext = $uploaddata['file_ext'];

                                $zip = new ZipArchive();
                                $x = $zip->open($pathToGallery.$zip_name.$zip_ext);
                                if ($x === true) {
                                    $zip->extractTo($finaldirectory);
                                    $zip->close();
                                }
                                $img_str = "";
                                if ($handle = opendir($finaldirectory)) {
                                    while (false !== ($ImageName = readdir($handle))) {

                                        $ext_array = explode('.',$ImageName);

                                        if(count($ext_array) == 2 && $ext_array[0] != '') {
                                        $img_ext = $ext_array[1];
                                        $imgExtensions = array("jpg", "jpeg", "png", "gif");

                                        if (in_array($img_ext, $imgExtensions))
                                            $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);

                                            $imgdbname = $randomstr.'.'.$img_ext;
                                            rename($finaldirectory.'/'.$ImageName, $finaldirectory.'/'.$imgdbname);

                                            $this->DatabaseModel->access_database('ts_prodgallery','insert', array('prodgallery_img'=>$imgdbname ,'prodgallery_pid'=>$prodId) , '');
                                        }
                                    }
                                    closedir($handle);
                                }

                                unlink($pathToGallery.$zip_name.$zip_ext);
                            }
                            else {
                                $this->session->userdata['ts_error_file'] = 'Unable to upload gallery zip.';
                                $errorCounter++;
                            }
                        }
                        else {
                            $this->session->userdata['ts_error_file'] = 'Upload ZIP format file for gallery images.';
                            $errorCounter++;
                        }
                }

                }

            }

            redirect($_SERVER['HTTP_REFERER']);
	    }
	    else {
	        redirect(base_url());
	    }
	    die();
	}


    /*************** Save Products ENDS *****************/

    /****************** Products Download STARTS ********************/

    function self_product_download($uniqid='') {
        if($uniqid != '') {
            $userId = $this->session->userdata['ts_uid'];
            $productDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid , 'prod_uid'=>$userId));
            if(empty($productDetails)) {
                if( $this->session->userdata['ts_level'] != '1' ) {
                    redirect(base_url());
                }
            }
            $productDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid));

            if( strpos($productDetails[0]['prod_filename'],'/') === false ) {

                $filename = $productDetails[0]['prod_filename'];
                $productname = $this->ts_functions->getProductName($productDetails[0]['prod_id']);
                $productname = rtrim($productname,'/');

                $path=dirname(__FILE__);
                $abs_path=explode('/application/',$path);
                $source_path = $abs_path[0].'/repo/mainzipfiles/';
                $destination_path = $abs_path[0].'/repo/temp/';

                copy ( $source_path.$filename , $destination_path.$filename );
                rename ( $destination_path.$filename , $destination_path.$productname.'.zip' );

                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="'.$productname.'.zip');
                readfile($destination_path.$productname.'.zip');		// push it out

                unlink($destination_path.$productname.'.zip');
                exit();
            }
            else {
                // Direct URL Download
                redirect($productDetails[0]['prod_filename']);
            }
        }
        else {
            redirect(base_url());
        }
    }
    /**************** View Products STARTS ****************/

    public function view_products($uniqid=''){
        if($uniqid != '') {

            $uid = $this->session->userdata['ts_uid'];
            $data['basepath'] = base_url();
            $productdetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid,'prod_uid'=>$uid));
            if(empty($productdetails)) {
                redirect(base_url().'vendorboard');
            }
            $data['controller'] = 'vendorboard';
            $data['productdetails'] = $productdetails;
            $data['prodDownloads'] = $this->DatabaseModel->access_database('ts_downloadtbl','select','',array('download_pid'=>$productdetails[0]['prod_id']));

            if( !isset($_POST['duration'])) {
                $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid));
                $data['duration'] = $data['pagetype'] = $data['d1'] = $data['d2'] = '';
            }
            else if(isset($_POST['duration'])) {

                if( $_POST['duration'] == '' && $_POST['pagetype'] == '' ) {
                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid));
                }
                elseif($_POST['duration'] == '' && $_POST['pagetype'] != ''){
                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid, 'prod_analysis_pagetype'=>$_POST['pagetype']));
                }
                elseif($_POST['duration'] == 'today'){
                    $todaydate = date('Y-m-d');
                    $like_arr = array('prod_analysis_date'=>$todaydate);

                    $havingArr = ($_POST['pagetype']!='') ? array('prod_analysis_pagetype'=>$_POST['pagetype']) : '' ;

                    if( $havingArr == '' ) {
                        $havingArr = array('prod_analysis_prodid'=>$uniqid);
                    }
                    else {
                        $havingArr['prod_analysis_prodid'] = $uniqid;
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','like',$havingArr,$like_arr);

                }
                elseif($_POST['duration'] == 'yesterday'){
                    $yesterdate = date('Y-m-d',strtotime("-1 days"));
                    $like_arr = array('prod_analysis_date'=>$yesterdate);

                    $havingArr = ($_POST['pagetype']!='') ? array('prod_analysis_pagetype'=>$_POST['pagetype']) : '' ;

                    if( $havingArr == '' ) {
                        $havingArr = array('prod_analysis_prodid'=>$uniqid);
                    }
                    else {
                        $havingArr['prod_analysis_prodid'] = $uniqid;
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','like',$havingArr,$like_arr);
                }
                elseif($_POST['duration'] == 'custom'){
                    $fromdate = date_format(date_create ( $_POST['d1'] ) , 'Y-m-d H:i:s');
                    $todate = date_format(date_create ( $_POST['d2'] ) , 'Y-m-d H:i:s');

                    $whr = array(
                            'prod_analysis_date >=' =>  $fromdate,
                            'prod_analysis_date <=' =>  $todate
                    );
                    $whr['prod_analysis_prodid']=$uniqid;

                    if( $_POST['pagetype'] != '' ) {
                        $whr['prod_analysis_pagetype']=$_POST['pagetype'];
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',$whr);

                }
                $data['duration'] = $_POST['duration'];
                $data['pagetype'] = $_POST['pagetype'];
                $data['d1'] = $_POST['d1'];
                $data['d2'] = $_POST['d2'];
            }


            $this->load->view('vendor/include/vheader',$data);
            $this->load->view('backend/view_products',$data);
        }
        else {
            redirect(base_url());
        }
	}

	/**************** View Products ENDS ****************/

    /******************* Transaction START **************/

    function sales_history(){

	    $uid = $this->session->userdata['ts_uid'];
        $data['transactionDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , array('payment_status'=>'yes','payment_type'=>'products'));
        $data['uid'] = $uid;
        $data['basepath'] = base_url();
        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/sales_history',$data);
        $this->load->view('vendor/include/vfooter',$data);
	}

    function transaction_history_detail(){
        if(isset($_POST['currentId'])){

            $join_array = array('ts_user','ts_user.user_id = ts_paymentdetails.payment_uid');
		    $transactionDetails = $this->DatabaseModel->access_database('ts_paymentdetails','','',array('payment_id'=>$_POST['currentId']),$join_array);

            if(empty($transactionDetails)) {
                echo '<p>Data can not be fetched.</p>';
            }
            else {
                $custom = trim($transactionDetails[0]['payment_pid']);
                $customArr = explode(',',$custom);
                $outputStr = '';

                $outputStr .= '<p> User Details </p> <p> Username : <b>'.$transactionDetails[0]['user_uname'].'</b></p> <p> Email : <b>'.$transactionDetails[0]['user_email'].'</b></p> <p> Registration Date : <b>'.date_format(date_create ( $transactionDetails[0]['user_registerdate'] ) , 'M d, Y').'</b></p> <p> Transaction Mode : <b>'.ucfirst($transactionDetails[0]['payment_mode']).'</b></p> <p> Payer\'s Email : <b>'.$transactionDetails[0]['payment_email'].'</b></p><hr />';

                if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                    $outputStr .= ' <p> Total amount paid : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$transactionDetails[0]['payment_amount'].'</b> </p> <p> Commission got : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$transactionDetails[0]['payment_earning'].'</b> </p> <hr />';
                }

                for($i=0;$i<count($customArr);$i++) {

                    $pId = $customArr[$i];
                    if( $transactionDetails[0]['payment_type'] == 'vendor_plan' ) {
                        $findPlan = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$pId,'vplan_status'=>1));
                    }
                    else {
                        $findPlan = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$pId,'plan_status'=>1));
                    }

                    $findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId,'prod_status'=>1));

                    if(!empty($findPlan) || !empty($findProduct)) {

                        if(!empty($findPlan)) {
                            if( $transactionDetails[0]['payment_type'] == 'vendor_plan' ) {
                                $outputStr .= '<p> Vendor Plan Name: <b>'.$findPlan[0]['vplan_name'].'</b></p>';
                                $outputStr .= '<p> Vendor Plan Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findPlan[0]['vplan_amount'].'</b></p>';
                            }
                            else {
                                $outputStr .= '<p> Product Plan Name : <b>'.$findPlan[0]['plan_name'].'</b></p>';
                                $outputStr .= '<p> Product Plan Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findPlan[0]['plan_amount'].'</b></p>';
                            }

                            if( $transactionDetails[0]['payment_mode'] == 'banktransfer' ) {
                                $outputStr .= '<p> User Note : <b>'.$transactionDetails[0]['payment_note'].'</b></p>';
                                if( $transactionDetails[0]['payment_status'] == 'no' ) {
                                    $outputStr .= '<p> <a class="btn theme_btn" href="'.base_url().'backend/approve_transaction/'.$transactionDetails[0]['payment_id'].'" > Approve </a></p>';
                                }
                            }
                            $outputStr .= '<hr />';
                        }

                        if(!empty($findProduct)) {
                            $outputStr .= '<p> Product Name : <b>'.$findProduct[0]['prod_name'].'</b></p>';
                            $outputStr .= '<p> Product Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findProduct[0]['prod_price'].'</b></p>';

                            if( $transactionDetails[0]['payment_mode'] == 'banktransfer' ) {
                                $outputStr .= '<p> User Note : <b>'.$transactionDetails[0]['payment_note'].'</b></p>';
                                if( $transactionDetails[0]['payment_status'] == 'no' ) {
                                    $outputStr .= '<p> <a class="btn theme_btn" href="'.base_url().'backend/approve_transaction/'.$transactionDetails[0]['payment_id'].'" > Approve </a></p>';
                                }
                            }
                            $outputStr .= '<hr />';
                        }
                    }
                }
                echo $outputStr;
            }
        }
        else {
            echo '<p>Data can not be fetched.</p>';
        }
        die();
    }

    /******************* Transaction ENDS **************/
    /********************* Withdrawal Section STARTS ***************/

    function withdrawal(){
        $data['basepath'] = base_url();
        $uid = $this->session->userdata['ts_uid'];
        $data_array = array(
            'venwith_uid'   =>  $uid,
            'venwith_type'  =>  'paypal_email'
        );
        $data['withdrawalDetails_paypal'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);

        $data_array = array(
            'venwith_uid'   =>  $uid,
            'venwith_type'  =>  'banktransfer_details'
        );
        $data['withdrawalDetails_bnkdetails'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);

        $productdetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uid'=>$uid));
        $venCommArr = array();
        if(!empty($productdetails)) {
            $transactionDetailsArray = array();
            foreach($productdetails as $solo_prod) {
                $trDet = $this->DatabaseModel->access_database('ts_paymentdetails','like', '' , array('payment_pid'=>$solo_prod['prod_uniqid']));
                if(!empty($trDet)) {
                    foreach($trDet as $solotransaction) {
                        $custom = trim($solotransaction['payment_pid']);
                        $customArr = explode(',',$custom);

                        $venStr = trim($solotransaction['payment_vendor_commission']);
                        if( $venStr != '' ) {
                            $venArr = explode(',',$venStr);

                            for($i=0;$i<count($venArr);$i++) {
                                $venSplitArr = explode('@#', trim($venArr[$i]));

                                if($solo_prod['prod_uniqid'] == $venSplitArr[0] ) {
                                    $venCommArr[] = $venSplitArr[1];
                                }
                            }
                        }
                    }
                }
            }
            $data['totalCommissionAmount'] = array_sum($venCommArr);
        }
        else {
            $data['totalCommissionAmount'] = 0;
        }

        $data['withdrawalDetails_received'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','totalvalue', array('venwith_text','totalReceivedAmount') , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

        $data['withdrawalReceivedDetails'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select', '' , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/withdrawal',$data);
        $this->load->view('vendor/include/vfooter',$data);
    }

    /**** Ajax function to handel updation of Withdrawal settings ****/
	public function update_withdrawaldetails() {
	    if(isset($_POST['updateform'])) {
	        $updatedata = json_decode($_POST['updatedata']);
	        foreach( $updatedata as $soloKey=>$soloValue ) {
	            $uid = $this->session->userdata['ts_uid'];
	            $data_array = array(
                    'venwith_uid'   =>  $uid,
                    'venwith_type'  =>  $soloKey
                );
                $res = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);

                if(!empty($res)) {
                    $this->DatabaseModel->access_database('ts_vendorwithdrawal','update',array('venwith_text'=>$soloValue) , array('venwith_id'=>$res[0]['venwith_id']));
                }
                else {
                    $data_array['venwith_text'] = $soloValue;
                    $this->DatabaseModel->access_database('ts_vendorwithdrawal','insert', $data_array , '');
                }
	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}
    /********************* Withdrawal Section ENDS ***************/

    /************** Wallet Statements STARTS ************/
	public function wallet_statement() {
	    $uid = $this->session->userdata['ts_uid'];
	    echo $uid.' VIVEK';
        $data['walletDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , array('payment_status'=>'yes','payment_mode'=>'wallet','payment_uid'=>$uid));
        $data['uid'] = $uid;
        $data['basepath'] = base_url();
        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/wallet_statement',$data);
        $this->load->view('vendor/include/vfooter',$data);
	}
    /********************* Wallet Statements ENDS ***************/

}
?>
