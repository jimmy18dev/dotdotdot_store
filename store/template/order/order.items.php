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
<div class="order-items <?php echo ($var['od_admin_read'] == "open"?'order-unread':'');?>">
	<div class="detail">
		<p><span class="status <?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span> ใบสั่งซื้อ: <?php echo $var['od_id'];?> <i class="fa fa-user"></i> <?php echo $var['me_name'];?></p>
		<p class="mini">ยอดชำระ <?php echo number_format($var['od_payments']+50,2);?> บาท · สินค้า <?php echo $var['od_amount'];?> ชิ้น · <?php echo $var['od_total'];?> รายการ</p>
	</div>
	<div class="summary">
		<p class="total"><?php echo $var['order_update_time_facebook_format'];?></p>
	</div>
</div>
</a>