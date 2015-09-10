<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items">
	<div class="detail">
		<div class="time"><?php echo $var['od_create_time'];?></div>
		<div class="title">Order <?php echo $var['od_id'];?></div>
		<div class="status"><?php echo $var['od_status'];?></div>
	</div>
	<div class="payments">+฿<?php echo $var['od_payments'];?></div>
</div>
</a>