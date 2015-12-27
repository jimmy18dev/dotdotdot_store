<?php
// icon display
if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'โอนเงินแล้ว';
}
else if($var['od_status'] == "TransferAgain"){
	$status = '<i class="fa fa-exclamation-triangle"></i>ส่งอีกครั้ง!';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = '<i class="fa fa-check"></i>ชำระแล้ว';
}
else if($var['od_status'] == "Shipping"){
	$status = '<i class="fa fa-check"></i>จัดส่งแล้ว';
}
else{
	// Expire
	$status = '<i class="fa fa-frown-o"></i>เกินกำหนด';
}
?>

<a href="order-<?php echo $var['od_id'];?>.html" class="order-progress-items">
	<i class="fa fa-file-text-o"></i>ใบสั่งซื้อที่ <?php echo $var['od_id'];?> – ยอดชำระ <?php echo number_format($var['od_payments']+50,2);?> บาท <span class="status-box status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span>
</a>