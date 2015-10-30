<?php
// icon display
if($var['od_status'] == "Shopping"){
	$status = 'เลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$status = 'ชำระเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'ยืนยันโอนเงิน';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ยืนยันอีกครั้ง!';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'รอส่งของ';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งแล้ว';
}
else if($var['od_status'] == "Complete"){
	$status = 'เรียบร้อย';
}
else if($var['od_status'] == "Cancel"){
	$status = 'ยกเลิก';
}
else{
	// Expire
	$status = 'หมดเวลา';
}
?>

<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items <?php echo ($var['od_status'] == "Cancel"||$var['od_status'] == "Expire"?'order-items-cancel':'');?> <?php echo ($var['od_admin_read'] == "open"?'order-unread':'');?>">
	<div class="notification-icon <?php echo strtolower($var['od_status']);?>">
		<?php echo ($var['od_admin_read']=='open'?'<i class="fa fa-circle"></i>':'<i class="fa fa-circle-o"></i>');?>
	</div>
	<div class="detail">
		<p>ใบสั่งซื่อที่ <?php echo $var['od_id'];?> : <?php echo $var['me_name'];?></p>
		<p class="mini"><?php echo $status;?> · <?php echo $var['order_update_time_facebook_format'];?></p>
	</div>
	<div class="summary">
		<p class="total"><span class="currency">฿</span> <?php echo number_format($var['od_payments']+50,2);?></p>
	</div>
</div>
</a>