<div class="product-items">
	<div class="product-thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>"></a>
	</div>

	<?php if($var['pd_type'] == "root"){{?>
	<div class="product-subproduct">
		<div class="subproduct-title"><?php echo $var['pd_title'];?></div>
		<?php $this->ListSubProduct(array('product_id' => $var['pd_id'],'render' => 'list-subproduct-items'));}?>
	</div>
	<?php }else{?>
	<div class="product-content">
		<div class="detail">
			<?php if($var['pd_type'] != "root"){?>
			<div class="id">รหัสสินค้า: <?php echo $var['pd_id'];?></div>
			<?php }?>
			<div class="title"><?php echo $var['pd_title'];?></div>
			<div class="price"><?php echo ($var['pd_type']=="root"?'สินค้าย่อย 4 รายการ':number_format($var['pd_price'],2).' บาท');?></div>
		</div>
		<div class="quantity"><?php echo $var['pd_quantity'];?></div>
	</div>
	<?php }?>
</div>