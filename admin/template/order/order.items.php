<?php
// icon display
if($var['od_status'] == "Shopping"){
	$status = 'กำลังเลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'รอตรวจสอบหลักฐานการโอนเงิน<i class="fa fa-clock-o" aria-hidden="true"></i>';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ส่งหลักฐานการโอนเงินใหม่!';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'ชำระเงินแล้ว รอส่งสิน้คา<i class="fa fa-check" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งสินค้าแล้ว<i class="fa fa-truck" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Complete"){
	$status = 'ปิดการขาย<i class="fa fa-check-circle" aria-hidden="true"></i>';
}
else if($var['od_status'] == "Cancel"){
	$status = 'ยกเลิกการสั่งซื้อ';
}
else{
	// Expire
	$status = 'หมดเวลาโอนเงิน';
}
?>


<a href="order_detail.php?id=<?php echo $var['od_id'];?>" target="_parent" class="order-items <?php echo ($var['od_admin_read'] == "open"?'order-unread':'');?>">
	<div class="avatar">
		<?php if(empty(!$var['me_fb_id'])){?>
		<img src="https://graph.facebook.com/<?php echo $var['me_fb_id'];?>/picture?type=square" alt="">
		<?php }else{?>
		<img src="../image/avatar.png" alt="">
		<?php }?>
	</div>
	<div class="info">
		<div class="info-name"><?php echo $var['me_name'];?></div>
		<div class="info-desc">หมายเลขการสั่งซื้อที่ #<?php echo $var['od_id'];?> ยอดชำระ <?php echo number_format($var['od_payments']+50);?> บาท สั่งซื้อเมื่อวันที่ <?php echo $var['od_paying_time'];?> สถานะล่าสุด : <span class="status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span></div>
	</div>
	<div class="icons"><i class="fa fa-angle-right"></i></div>
</a>