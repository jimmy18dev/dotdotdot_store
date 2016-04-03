<?php
// icon display
if($var['od_status'] == "Shopping"){
	$status = 'เลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน<i class="fa fa-credit-card"></i>';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'ยืนยันโอนเงิน';
	$hashtag = '#info-transfer';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ยืนยันอีกครั้ง<i class="fa fa-exclamation-circle"></i>';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'ชำระแล้ว<i class="fa fa-check"></i>';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งแล้ว<i class="fa fa-truck"></i>';
	$hashtag = '#shipping';
}
else if($var['od_status'] == "Complete"){
	$status = 'ปิดแล้ว<i class="fa fa-check-circle-o"></i>';
	$hashtag = '#start';
}
else if($var['od_status'] == "Cancel"){
	$status = 'ยกเลิก<i class="fa fa-ban"></i>';
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
<a href="order-<?php echo $var['od_id'];?>.html<?php echo $hashtag;?>" target="_parent" class="order-items <?php echo ($var['od_owner_read']=="open"?"order-items-unread":"");?>">
	<div class="content">
		<p>หมายเลขของคำสั่งซื้อ <span class="id">#<?php echo $var['od_id'];?></span></p>
		<p class="time">สั่งซื้อเมื่อ <?php echo $var['order_create_time_thai_format'];?></p>
	</div>
	<div class="status">
		<span class="status-box status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span><i class="fa fa-angle-right"></i>
	</div>
</a>
