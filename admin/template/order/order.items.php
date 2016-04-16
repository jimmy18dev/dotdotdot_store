<?php
// icon display
if($var['od_status'] == "Shopping"){
	$status = 'เลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'รอตรวจสอบหลักฐาน<i class="fa fa-clock-o" aria-hidden="true"></i>';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ส่งหลักฐานใหม่!';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'รอส่งของ<i class="fa fa-check" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งแล้ว<i class="fa fa-truck" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Complete"){
	$status = 'เรียบร้อย<i class="fa fa-check-circle" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Cancel"){
	$status = 'ยกเลิก';
}
else{
	// Expire
	$status = 'หมดเวลา';
}
?>


<a href="order_detail.php?id=<?php echo $var['od_id'];?>" target="_parent" class="order-items <?php echo ($var['od_admin_read'] == "open"?'order-unread':'');?>">
	<?php if($var['od_admin_read'] == 'open'){?><div class="unread"></div><?php }?>
	<div class="avatar">
		<?php if(empty(!$var['me_fb_id'])){?>
		<img src="https://graph.facebook.com/<?php echo $var['me_fb_id'];?>/picture?type=square" alt="">
		<?php }else{?>
		<img src="../image/avatar.png" alt="">
		<?php }?>
	</div>
	<div class="info">
		<div class="info-name"><strong><?php echo $var['me_name'];?></strong></div>
		<div class="info-desc">#<?php echo $var['od_id'];?> · <span class="status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span></div>
	</div>
	<div class="time"><?php echo $var['od_paying_time'];?></div>
	<div class="payment <?php echo ($var['od_status'] == "TransferSuccess" || $var['od_status'] == "Shipping" || $var['od_status'] == "Complete"?'payment-paid':'');?>"><?php echo number_format($var['od_payments']+50);?> ฿.</div>
</a>