				<div class="ts_download_table">
					<table class="table">
						<tr>
							<th><?php echo $this->ts_functions->getlanguage('freeprodtext','userdashboard','solo');?></th>
							<th><i class="fa fa-tags"></i></th>
							<th><?php echo $this->ts_functions->getlanguage('previewtext','userdashboard','solo');?></th>
							<th><?php echo $this->ts_functions->getlanguage('downloadtext','userdashboard','solo');?></th>
						</tr>
					<?php if(!empty($freeProducts)) {
					    foreach($freeProducts as $soloProd) {
					    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
					?>
						<tr>
							<td data-title="<?php echo $this->ts_functions->getlanguage('freeprodtext','userdashboard','solo');?>"><p><?php echo $soloProd['prod_name'];?></p></td>

                            <td data-title="Categories"><p><?php echo $soloProd['cate_name'];?></p></td>

							<td data-title="<?php echo $this->ts_functions->getlanguage('previewtext','userdashboard','solo');?>"><span><a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
							</span></td>

							<td data-title="<?php echo $this->ts_functions->getlanguage('downloadtext','userdashboard','solo');?>"><span><a href="<?php echo $basepath;?>dashboard/free_download_product/<?php echo $soloProd['prod_uniqid'];?>"><i class="fa fa-download" aria-hidden="true"></i></a></span></td>
						</tr>
					<?php } } else { ?>

					<tr>
						<td colspan="4" align="center"> <?php echo $this->ts_functions->getlanguage('emptyfreetext','userdashboard','solo');?></td>
					</tr>

					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Cart Table wrapper End -->
