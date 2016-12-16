<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">
<?php $topText = (isset($productdetails) ? 'Update Products' : 'Add Products' );?>
    <div class="theme_panel_section">
                    <h4 class="th_title">
                    <?php echo $topText;?>
                    </h4>
                <div class="th_content_section">
                <form action="<?php echo $actionUrl;?>" enctype="multipart/form-data" method="post" id="modify_products_form">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Name</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" name="p_name" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_name']; } ?>">
                            <span class="input_help_info">Name , will be displayed to customers.</span>
                            <span class="p_name_counter name_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_name']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>URL Name</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" name="p_urlname" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_urlname']; } ?>">
                            <span class="input_help_info">URL Name can have hyphen(-), space( ), numbers(0-9) but not other special characters.<br/> This will be used for links and URLs.</span>
                            <span class="p_name_counter urlname_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_urlname']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Product Category</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control productfields" name="p_category">
                             <option value="0">Choose one</option>
                             <?php
                             foreach($categoryList as $soloCate) {
                                if( isset($productdetails) ) {
                                    $selected = ($productdetails[0]['prod_cateid'] == $soloCate['cate_id']) ? 'selected' : '' ;
                                }
                                else {
                                    $selected = '';
                                }
                                echo '<option value="'.$soloCate['cate_id'].'" '.$selected.'>'.$soloCate['cate_name'].'</option>';
                              } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Show live preview link</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <div class="th_checkbox">
                                <input type="checkbox" name="p_showpreview" id="p_showpreview"  <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_demoshow'] == '1') ? 'checked' : '' ; } ?>><label for="p_showpreview">Show</label></div>
                            <span class="input_help_info">Checked means, YES </span>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Live preview link</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" name="p_demourl" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_demourl']; } ?>">
                        </div>
                    </div>

                   <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Tags</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control productfields" name="p_tags"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_tags']; } ?></textarea>
                            <span class="input_help_info">Separate each tag by comma (,)</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Description</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control productfields" name="p_description"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_description']; } ?></textarea>
                            <span class="input_help_info">Paste HTML content here</span>
                        </div>
                    </div>

                    <?php if( isset($productdetails) ) { ?>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Feature image</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <img src="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>">
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Upload feature Image</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="file" class="form-control productfields" name="p_image">
                            <span class="input_help_info">Image dimension should be 750 x 400 px , and size should be low for better page load speed.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Upload product zip</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="file" class="form-control" name="p_file">
                            <?php if( isset($productdetails) ) {
                                if( $productdetails[0]['prod_filename'] != '' && strpos($productdetails[0]['prod_filename'],'/') === false ) {
                            ?>
                            <span class="input_help_info" style="font-size: 15px;color: #8BC34A;">New uploaded zip , will replace the previous one. </span>
                            <?php } else { ?>
                                <span class="input_help_info">Which customer will get after purchase </span>
                            <?php } } else { ?>
                            <span class="input_help_info">Which customer will get after purchase </span>
                            <?php } ?>
                        </div>
                    </div>

                    <span class="ts_separater"> OR </span>
                    <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product download link</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control" name="p_downlink" value="<?php if(isset($productdetails)) {  if( strpos($productdetails[0]['prod_filename'],'/') !== false ) { echo $productdetails[0]['prod_filename']; } } ?>">
                                <span class="input_help_info">Any server URL which customer will get after purchase  </span>
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Show image gallery</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <div class="th_checkbox">
                                <input type="checkbox" name="p_showgallery" id="p_showgallery"  <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_gallery'] == '1') ? 'checked' : '' ; } ?>><label for="p_showgallery">Show</label></div>
                            <span class="input_help_info">Checked means, YES </span>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Upload image gallery zip</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="file" class="form-control" name="p_gallery">
                            <?php if( isset($productdetails) ) {
                                if( $productdetails[0]['prod_gallery'] == '1' ) {
                            ?>
                            <span class="input_help_info" style="font-size: 15px;color: #8BC34A;">New image folder zip , will replace the previous one. </span>
                            <?php } else { ?>
                                <span class="input_help_info">Please name the images like , 1.jpg or 1.png , 2.jpg and so on.</span>
                            <?php } } else { ?>
                            <span class="input_help_info">Please name the images like , 1.jpg or 1.png , 2.jpg and so on. </span>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                        $revenueModel = $this->ts_functions->getsettings('portal','revenuemodel');
                        if( $revenueModel == 'singlecost') {
                            // Single Cost
                        ?>

                          <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Price</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control productfields" name="p_price" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_price']; } ?>">
                                <span class="input_help_info">Just the number </span>
                            </div>
                        </div>

                    <?php } else { ?>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Plans</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <?php
                            // Subscription Based on Time
                            $plandetails_time = $this->DatabaseModel->access_database('ts_plans','select','','');
                            foreach($plandetails_time as $solo_time) {
                                if( isset($productdetails) ) {
                                    $pos = strpos($productdetails[0]['prod_plan'] , $solo_time['plan_id']);
                                    $checked = ( $pos === false ) ? '' : 'checked' ;
                                }
                                else {
                                    $checked = '';
                                }
                                echo '<div class="th_checkbox">
                                <input type="checkbox" name="p_plan[]" id="p_plan_'.$solo_time['plan_id'].'" value="'.$solo_time['plan_id'].'" '.$checked.' onclick="checkProductsPlans('.$solo_time['plan_id'].')"><label for="p_plan_'.$solo_time['plan_id'].'">'.$solo_time['plan_name'].'</label></div><br/>';
                            }
                            ?>
                            <span class="input_help_info">This product will come under selected plan </span>
                            </div>
                        </div>

                    <?php }
                    ?>


                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Make product <b>FREE</b> for all</label>
                        </div>
                        <div class="col-lg-6 col-md-6">

                            <div class="th_footer_text">
                                <div class="th_checkbox">
                                    <input type="checkbox" name="p_free" id="p_free" value="1" <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_free'] == '1') ? 'checked' : '' ; } ?> >
                                <label for="p_free"></label>

                                </div>
                                <input type="text" class="form-control" readonly value="FREE">
                                <span class="input_help_info">It will overwrite all other Price or plan settings.</span><br/>
                                <span class="input_help_info" style="color:#f0ad4e;">User can access this product after registration only.</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                    <?php $btnText = (isset($productdetails) ? 'UPDATE' : 'ADD' );?>
                            <a class="btn theme_btn" onclick="addproductsbutton(this)"><?php echo $btnText; ?></a>
                        </div>
                    </div>
                    <input type="hidden" name="oldprod_id" id="oldprod_id" value="<?php echo $oldprod_id;?>">
                </form>
                </div>
    </div>
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>
