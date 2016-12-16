<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $productdetails[0]['prod_name'];?></h3>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Contact wrapper Start -->
<div class="ts_singletheme_wrapper ts_toppadder100 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="ts_theme_detail_wrapper">
					<div class="ts_theme_shortinfo">
						<div class="row">
						<?php
                        $prodName = $this->ts_functions->getProductName($productdetails[0]['prod_id']);
                        ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="ts_theme_boxes">
									<div class="ts_theme_boxes_img">
										<a href="<?php echo $basepath;?>item/<?php echo $prodName.'live_demo/'.$productdetails[0]['prod_uniqid'];?>" target="_blank"><img src="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>" title="<?php echo $productdetails[0]['prod_name'];?>" class="img-responsive"></a>
									</div>
									<!--<span><?php echo $productdetails[0]['cate_name'];?></span>-->

									<div class="ts_theme_boxes_info">
										<?php if($productdetails[0]['prod_demoshow'] == '1') { ?>
										<a href="<?php echo $basepath;?>item/<?php echo $prodName.'live_demo/'.$productdetails[0]['prod_uniqid'];?>" class="ts_btn pull-left"  target="_blank"><?php echo $this->ts_functions->getlanguage('livedemotab','homepage','solo');?></a>
										<?php } ?>
										<?php if($productdetails[0]['prod_gallery'] == '1') { ?>
										<a onclick="openthegalleryimages(<?php echo $productdetails[0]['prod_id'];?>)" class="ts_btn pull-left popup_open_preview"><?php echo $this->ts_functions->getlanguage('gallerybtn','homepage','solo');?></a>
										<?php } ?>
										<div class="ts_share_box">
											<a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>" class="pull-left" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>

											<a href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>&text=<?php echo urlencode($productdetails[0]['prod_name']);?>" class="pull-left" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ts_singletheme_detail">
						<?php echo $productdetails[0]['prod_description'];?>
					</div></div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ts_sidebar_responsive">
								<div class="ts_sidebar_wrapper">
									<aside class="widget widget_license">
										<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('licenseheading','singleproductpage','solo');?></h4>
										<div class="ts_widget_license_info">
											<p><?php echo $this->ts_functions->getlanguage('licensesubheading','singleproductpage','solo');?></p>

											<?php if( $productdetails[0]['prod_free'] == '0') {
												if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>

													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('addtocart','homepage','solo');?> </a>

													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> - <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?> </a>

												<?php } else { ?>
													<a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
											<?php   }
												} else {
													// Free
												?>
													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>

											<?php } ?>


											<!-- <a href="javascript:;" class="ts_about_license">Read about the license</a> -->
										</div>
									</aside>
									<aside class="widget widget_meta_attributese">
											<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('productheading','singleproductpage','solo');?></h4>
											<dl>
											<?php
												$vName = $this->ts_functions->getVendorName($productdetails[0]['prod_uid']);
											?>
												<dt><?php echo $this->ts_functions->getlanguage('vendornametext','singleproductpage','solo');?></dt>
												<dd> : <a href="<?php echo $basepath;?>vendor/<?php echo $vName;?>"><?php echo ucfirst($vName); ?></a> </dd>

												<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('createsubheading','singleproductpage','solo');?></dt>
												<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_date'] ) , 'M d, Y');?> </dd>

												<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('updateddatetext','singleproductpage','solo');?></dt>
												<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_update'] ) , 'M d, Y');?></dd>

												<!--<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('ratingssubheading','singleproductpage','solo');?></dt>
												<dd> : 8.9/10</dd> -->

												<div class="clearfix"></div>

												<?php if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
													$purDetail = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$productdetails[0]['prod_id']));
												?>
												<dt><?php echo $this->ts_functions->getlanguage('downloadssubheading','singleproductpage','solo');?></dt>
												<dd> : <?php echo count($purDetail);?></dd>
												<?php } ?>

												<div class="clearfix"></div>

											</dl>
										</aside>
								<!--	</aside>
											<aside class="widget widget_advertisement">
											<h4 class="widget-title">Advertisement</h4>
											<img src="images/addv_1.jpg" alt="" class="img-responsive">
										</aside> -->
								</div>
							</div>
						</div>
					</div>

					<?php if(!empty($relatedProducts)) { ?>
    					<div class="ts_related_themebox">

						<h3> <?php echo $this->ts_functions->getlanguage('relatedprodtext','commontext','solo'); ?> </h3>
						<div class="row">
						<?php foreach($relatedProducts as $soloRelateProd) {
						    $prodName = $this->ts_functions->getProductName($soloRelateProd['prod_id']);
						    $vendorName = $this->ts_functions->getVendorName($soloRelateProd['prod_uid']);
						?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="ts_theme_boxes">
									<div class="ts_theme_boxes_img">
										<a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloRelateProd['prod_uniqid'];?>"><img src="<?php echo $basepath;?>repo/images/<?php echo $soloRelateProd['prod_image'];?>" title="<?php echo $soloRelateProd['prod_name'];?>" class="img-responsive"></a>
									</div>
									<span><?php echo $soloRelateProd['cate_name'];?></span>
									<div class="ts_theme_boxes_info">
										<div class="ts_theme_details">
											<h4><?php echo $soloRelateProd['prod_name'];?></h4>
											<p> <a href="<?php echo $basepath;?>vendor/<?php echo $vendorName;?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo ucfirst($vendorName);?></a></p>
										</div>
										<div class="ts_theme_price">
								<?php if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
                                /*** buy now section ***/
                                ?>
                                    <a href="javascript:;" class="ts_btn"><?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?></a>
                                <?php } else { ?>
                                    <a href="javascript:;" class="ts_price"><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?> <?php echo $soloRelateProd['prod_price'];?></a>
                                <?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ts_sidebar_responsive_none">
				<div class="ts_sidebar_wrapper">
					<aside class="widget widget_license">
						<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('licenseheading','singleproductpage','solo');?></h4>
						<div class="ts_widget_license_info">
							<p><?php echo $this->ts_functions->getlanguage('licensesubheading','singleproductpage','solo');?></p>

							<?php if( $productdetails[0]['prod_free'] == '0') {
                                if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>

                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('addtocart','homepage','solo');?> </a>

                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> - <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?> </a>

                                <?php } else { ?>
                                    <a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
							<?php   }
							    } else {
							        // Free
							    ?>
							        <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>

							<?php } ?>


							<!-- <a href="javascript:;" class="ts_about_license">Read about the license</a> -->
						</div>
					</aside>
					<aside class="widget widget_meta_attributese">
							<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('productheading','singleproductpage','solo');?></h4>
							<dl>
							<?php
							    $vName = $this->ts_functions->getVendorName($productdetails[0]['prod_uid']);
							?>
							    <dt><?php echo $this->ts_functions->getlanguage('vendornametext','singleproductpage','solo');?></dt>
								<dd> : <a href="<?php echo $basepath;?>vendor/<?php echo $vName;?>"><?php echo ucfirst($vName); ?></a> </dd>

								<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('createsubheading','singleproductpage','solo');?></dt>
								<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_date'] ) , 'M d, Y');?> </dd>

								<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('updateddatetext','singleproductpage','solo');?></dt>
								<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_update'] ) , 'M d, Y');?></dd>

								<!--<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('ratingssubheading','singleproductpage','solo');?></dt>
								<dd> : 8.9/10</dd> -->

								<div class="clearfix"></div>

								<?php if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
								    $purDetail = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$productdetails[0]['prod_id']));
								?>
								<dt><?php echo $this->ts_functions->getlanguage('downloadssubheading','singleproductpage','solo');?></dt>
								<dd> : <?php echo count($purDetail);?></dd>
								<?php } ?>

								<div class="clearfix"></div>

							</dl>
						</aside>
				<!--	</aside>
							<aside class="widget widget_advertisement">
							<h4 class="widget-title">Advertisement</h4>
							<img src="images/addv_1.jpg" alt="" class="img-responsive">
						</aside> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact wrapper End -->
<!-- PopUp wrappe Start -->
<div class="ts_popup_wrapper">
	<div class="ts_popup_close_overlay"></div>
	<a class="ts_popup_close"><i class="fa fa-times" aria-hidden="true"></i></a>
	<span class="ts_left_arrow" onclick="clickarrows('left')"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
	<span class="ts_right_arrow" onclick="clickarrows('right')"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
	<div class="ts_popup_inner" id="popupgallery">
        <ul>
            <li id="img_0" class="currentActive">
                <img src="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>">
            </li>
        </ul>
	</div>
</div>
<!-- PopUp wrappe End -->
