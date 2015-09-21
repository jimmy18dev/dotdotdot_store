<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items">
	<div class="order-icon"><i class="fa fa-clock-o"></i></div>
	<div class="order-detail">
		<div class="title">รายการสั่งซื้อ #<?php echo $var['od_id'];?></div>
		<div class="time"><?php echo $var['od_create_time'];?></div>
	</div>
	<div class="order-payments">
		<div class="quantity"><?php echo $var['od_total'];?></div>
		<div class="payments"><?php echo number_format($var['od_payments']);?></div>
	</div>
</div>
</a>