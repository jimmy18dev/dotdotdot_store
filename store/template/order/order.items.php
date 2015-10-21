<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items">
	<div class="detail">
		<p>ใบสั่งซื่อที่ <?php echo $var['od_id'];?></p>
		<p class="mini"><?php echo $var['me_name'];?> | <?php echo $var['od_update_time'];?></p>
	</div>
	<div class="status">
		<p><i class="fa fa-cart-arrow-down"></i></p>
		<p class="mini"><?php echo $var['od_status'];?></p>
	</div>
	<div class="summary">
		<p><?php echo $var['od_payments']+50;?> ฿</p>
		<p class="mini"><?php echo $var['od_amount'];?> ชิ้น</p>
	</div>
</div>
</a>