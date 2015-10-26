<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
<div class="product-items">
	<div class="thumbnail">
		<img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>">
	</div>
	<div class="detail">
		<p>รหัสสินค้า <?php echo $var['pd_code'].$var['pd_id'];?> <?php echo $var['pd_title'];?></p>
		<p class="mini">ราคา <?php echo $var['pd_price'];?> ฿ | <i class="fa fa-clock-o"></i><?php echo $var['pd_update_time'];?></p>
	</div>
	<div class="summary">
		<p><?php echo $var['pd_quantity'];?></p>
	</div>
</div>
</a>