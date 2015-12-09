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
		<p>
			<?php if($var['od_admin_read'] == "open"){?><span class="unread"><i class="fa fa-circle"></i></span><?php }?>
			<?php echo $var['od_id'];?> – <?php echo $var['me_name'];?> <span class="status <?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span></p>
		<p class="mini">
			<span class="payment"><?php echo number_format($var['od_payments']+50);?> บาท</span>
			<span class="time"><i class="fa fa-clock-o"></i><?php echo $var['order_update_time_facebook_format'];?></span>
			<span class="admin"><i class="fa fa-user"></i>Puwadon Sricharoen</span>
		</p>
	</div>
	<div class="summary">
		<p>
			<?php if($var['od_status'] == "TransferSuccess" || $var['od_status'] == "Shipping" || $var['od_status'] == "Complete"){?>
			<span class="paid"><i class="fa fa-check"></i>จ่ายแล้ว</span>
			<?php }else{?>
			<span class="pay">ยังไม่จ่าย</span>
			<?php }?>
		</p>
	</div>
</div>
</a>