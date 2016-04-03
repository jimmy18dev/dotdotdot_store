<?php
// icon display
if($var['od_status'] == "Paying"){
	$status = 'รอโอนเงิน';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferRequest"){
	$status = 'โอนเงินแล้ว';
	$hashtag = '#info-transfer';
}
else if($var['od_status'] == "TransferAgain"){
	$status = 'ส่งอีกครั้ง!';
	$hashtag = '#money-transfer';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = 'ชำระแล้ว<i class="fa fa-check"></i>';
}
else if($var['od_status'] == "Shipping"){
	$status = 'จัดส่งแล้ว<i class="fa fa-truck"></i>';
	$hashtag = '#shipping';
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

<a class="order-progress-items" href="order-<?php echo $var['od_id'];?>.html<?php echo $hashtag;?>">
	<span class="content">หมายเลขคำสั่งซื้อ #<?php echo $var['od_id'];?></span>
	<span class="status"><?php echo $status;?></span>
</a>