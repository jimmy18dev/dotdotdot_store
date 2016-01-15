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

if($var['od_shipping_type'] == "Ems"){
	$shipping_pay = 50;
}
else if($var['od_shipping_type'] == "Register"){
	$shipping_pay = 30;
}
else{
	$shipping_pay = 0;
}
?>

<a href="order-<?php echo $var['od_id'];?>.html" class="order-items <?php echo ($var['od_owner_read']=="open"?"order-items-unread":"");?>">รายการที่ <?php echo $var['od_id'];?> – ยอดชำระ <?php echo number_format($var['od_payments'] + $shipping_pay);?> บาท<span class="status-box status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span>
	<p class="time"><?php echo $var['order_update_time_facebook_format'];?><i class="fa fa-clock-o"></i></p>
</a>