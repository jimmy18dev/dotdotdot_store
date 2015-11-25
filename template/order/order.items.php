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
<div class="box-items <?php echo ($var['od_owner_read']=="open"?"box-items-unread":"");?>">
	<div class="icon"><?php echo ($var['od_status'] == "Complete"?'<i class="fa fa-check"></i>':'<i class="fa fa-file-text-o"></i>');?></div>
	<div class="box">
		<p class="big">รายการสั่งซื้อ : <?php echo $var['od_id'];?></p>
		<p>ยอดชำระ <?php echo number_format($var['od_payments']+50);?> บาท รวมสินค้า <?php echo $var['od_amount'];?> ชิ้น <?php echo $var['od_amount'];?> รายการ</p>
		<p class="caption"><?php echo $var['order_update_time_facebook_format'];?> <i class="fa fa-long-arrow-right"></i> <span class="status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span></p>
	</div>
</div>
</a>