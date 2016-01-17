<?php
// icon display
if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'โอนเงินแล้ว';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ส่งอีกครั้ง!';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'ชำระแล้ว';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งแล้ว';
}
else{
	// Expire
	$status = 'เกินกำหนด';
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

<a href="order-<?php echo $var['od_id'];?>.html<?php echo $hashtag;?>" class="order-progress-items">
	ใบสั่งซื้อที่ <?php echo $var['od_id'];?> – ยอดชำระ <?php echo number_format($var['od_payments'] + $shipping_pay,2);?> ฿.<span class="status-box status-<?php echo strtolower($var['od_status']);?>"><?php echo $status;?></span>
</a>