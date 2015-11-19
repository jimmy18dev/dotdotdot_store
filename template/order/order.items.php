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
	<div class="order-items-icon"><i class="fa fa-file-text-o"></i></div>
	<div class="order-items-info">
		<p>
			<span class="id">ใบสั่งซื้อ <?php echo $var['od_id'];?> <i class="fa fa-long-arrow-right"></i> <span class="status <?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span>
				<?php if($var['od_owner_read']=="open"){?>
				<span class="read-icon"> <i class="fa fa-circle"></i></span>
				<?php }?>
			</span>
			<span class="time"><?php echo $var['order_update_time_facebook_format'];?></span>
		</p>
		<p>ยอดชำระ <strong><?php echo number_format($var['od_payments']+50,2);?></strong> บาท · รวมสินค้า <?php echo $var['od_amount'];?> ชิ้น · <?php echo $var['od_amount'];?> รายการ</p>
	</div>
</div>
</a>