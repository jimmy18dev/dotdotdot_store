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

<a href="order_detail.php?id=<?php echo $var['od_id'];?>" target="_parent">
<div class="order-items <?php echo ($var['od_admin_read'] == "open"?'order-unread':'');?>">
	<div class="avatar">
		<?php if(empty(!$var['me_fb_id'])){?>
		<img src="https://graph.facebook.com/<?php echo $var['me_fb_id'];?>/picture?type=square" alt="">
		<?php }else{?>
		<img src="../image/avatar.png" alt="">
		<?php }?>
	</div>

	<div class="info">
		<div class="info-name"><span class="order-id"><?php echo $var['od_id'];?></span><?php echo $var['me_name'];?></div>
		<div class="info-desc"><?php echo $var['order_update_time_facebook_format'];?> <span class="status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span></div>
	</div>

	<div class="payment <?php echo ($var['od_status'] == "TransferSuccess" || $var['od_status'] == "Shipping" || $var['od_status'] == "Complete"?'payment-paid':'');?>">
		<?php echo number_format($var['od_payments']+50);?> บาท
		<i class="fa fa-angle-right"></i>
	</div>
</div>
</a>