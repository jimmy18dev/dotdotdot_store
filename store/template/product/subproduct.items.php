<div class="sub-items">
	<div class="sub-items-detail">
		<p><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><strong><?php echo $var['pd_title'];?></strong> – <?php echo $var['pd_description'];?></a></p>
		<p class="mini">รหัสสินค้า: <?php echo $var['pd_id'];?> | ราคา <?php echo $var['pd_price'];?> บาท <a href="product_editor.php?id=<?php echo $var['pd_id'];?>" class="edit-btn">แก้ไข</a></p>
	</div>
	<div class="sub-items-summary">
		<p><?php echo $var['pd_quantity'];?></p>
	</div>
</div>