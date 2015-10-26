<div class="product-items">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>"></a>
	</div>
	<div class="detail">
		<div class="id">รหัสสินค้า: <?php echo $var['pd_id'];?></div>
		<div class="title"><?php echo $var['pd_title'];?></div>
		<div class="price"><?php echo ($var['pd_type']=="root"?'สินค้าย่อย 4 รายการ':'ราคา: '.number_format($var['pd_price'],2).' บาท');?></div>

		<?php if($var['pd_type'] == "root"){{?>
		<div class="subproduct">
			<?php $this->ListSubProduct(array('product_id' => $var['pd_id'],'render' => 'list-subproduct-items'));}?>
		</div>
		<?php }?>
	</div>

	<?php if($var['pd_type'] != "root"){?>
	<div class="quantity"><?php echo $var['pd_quantity'];?></div>
	<?php }?>
</div>