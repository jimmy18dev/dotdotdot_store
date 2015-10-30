<div class="sub-items">
	<div class="sub-items-detail">
		<p class="id">รหัสสินค้า: <?php echo $var['pd_id'];?></p>
		<p class="title"><strong><?php echo $var['pd_title'];?></strong> <?php echo $var['pd_description'];?></p>
		<p class="info">ราคา <?php echo $var['pd_price'];?> บาท · <a href="product_editor.php?id=<?php echo $var['pd_id'];?>">แก้ไข</a></p>
	</div>
	<div class="sub-items-summary">
		<p><?php echo $var['pd_quantity'];?></p>
	</div>
</div>