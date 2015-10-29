<?php
// icon display
if($var['od_status'] == "Shopping"){
	$icon = '<i class="fa fa-cart-arrow-down"></i>';
	$status = 'เลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$icon = '<i class="fa fa-barcode"></i>';
	$status = 'ชำระเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$icon = '<i class="fa fa-barcode"></i>';
	$status = 'ยืนยันโอนเงิน';
}
else if($var['od_status'] == "TransferAgain"){
	$icon = '<i class="fa fa-refresh"></i>';
	$status = 'ยืนยันอีกครั้ง!';
}
else if($var['od_status'] == "TransferSuccess"){
	$icon = '<i class="fa fa-thumbs-up"></i>';
	$status = 'รอส่งของ';
}
else if($var['od_status'] == "Shipping"){
	$icon = '<i class="fa fa-truck"></i>';
	$status = 'จัดส่งแล้ว';
}
else if($var['od_status'] == "Complete"){
	$icon = '<i class="fa fa-check"></i>';
	$status = 'เรียบร้อย';
}
else if($var['od_status'] == "Cancel"){
	$icon = '<i class="fa fa-times"></i>';
	$status = 'ยกเลิก';
}
else{
	// Expire
	$icon = '<i class="fa fa-clock-o"></i>';
	$status = 'หมดเวลา';
}
?>

<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items <?php echo ($var['od_status'] == "Cancel"||$var['od_status'] == "Expire"?'order-items-cancel':'');?>">
	<div class="detail">
		<p><?php echo ($var['od_admin_read'] == "open"?'<span class="notification"><i class="fa fa-circle"></i></span>':'');?>รายการสั่งซื่อที่ <?php echo $var['od_id'];?></p>
		<p class="mini"><?php echo $var['me_name'];?> · <?php echo $var['order_update_time_facebook_format'];?></p>
	</div>
	<div class="status">
		<p><?php echo $icon;?></p>
		<p class="mini"><?php echo $status;?></p>
	</div>
	<div class="summary">
		<p class="total"><span class="currency">฿</span> <?php echo number_format($var['od_payments']+50,2);?></p>
		<p class="mini"><?php echo $var['od_amount'];?> ชิ้น</p>
	</div>
</div>
</a>