<div class="subproduct-items">
	<div class="detail">
		<div class="id">รหัสสินค้า: <?php echo $var['pd_id'];?></div>
		<div class="title"><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?></a></div>
		<div class="price">ราคา: <?php echo number_format($var['pd_price'],2);?> บาท</div>
	</div>
	<div class="quantity"><?php echo $var['pd_quantity'];?></div>
</div>