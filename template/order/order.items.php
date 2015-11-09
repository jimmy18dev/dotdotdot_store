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
	$status = '<i class="fa fa-clock-o"></i>หมดเวลา';
}
?>

<a href="order-<?php echo $var['od_id'];?>.html">
<div class="order-items <?php echo ($var['od_owner_read']=="open"?"order-items-unread":"");?>">
	<div class="order-items-status">
		<span class="status <?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span>
		<span class="time"><?php echo $var['order_update_time_facebook_format'];?></span>
	</div>
	<div class="order-items-id">ใบสั่งซื้อหมายเลข <?php echo $var['od_id'];?></div>
	<div class="order-items-info">ชำระเงิน <strong><?php echo number_format($var['od_payments']+50,2);?></strong> บาท · สินค้า <?php echo $var['od_amount'];?> ชิ้น · <?php echo $var['od_amount'];?> รายการ</div>
</div>
</a>