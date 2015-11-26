<div class="subproduct-items">
	<div class="subproduct-detail">
		<h3><?php echo $var['pd_title'];?> · <span class="description"><?php echo $var['pd_description'];?></span></h3>

		<p>
			<span class="price"><?php echo number_format($var['pd_price'],2);?> บาท</span>
			<span class="id"> · รหัสสินค้า: <?php echo $var['pd_id'];?></span>
		</p>
		<p>
			<span class="status"><i class="fa fa-circle"></i> แสดง</span>
			<a href="product_editor.php?id=<?php echo $var['pd_id'];?>"><i class="fa fa-cog"></i> <span class="link-caption">แก้ไข</span></a>
			<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=export"><i class="fa fa-arrow-left"></i> <span class="link-caption">โอนออก</span></a>
			<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=import"><i class="fa fa-plus"></i> <span class="link-caption">นำเข้า</span></a>
		</p>
	</div>
	<div class="subproduct-quantity"><?php echo $var['pd_quantity'];?></div>
</div>