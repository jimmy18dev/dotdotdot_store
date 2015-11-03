<?php
// icon display
if($var['od_status'] == "Shopping"){
	$status = '<i class="fa fa-shopping-cart"></i>เลือกสินค้า...';
}
else if($var['od_status'] == "Paying"){
	$status = '<i class="fa fa-barcode"></i>ชำระเงิน';
}
else if($var['od_status'] == "TransferRequest"){
	$status = '<i class="fa fa-money"></i>ยืนยันโอนเงิน';
}
else if($var['od_status'] == "TransferAgain"){
	$status = '<i class="fa fa-money"></i>ยืนยันอีกครั้ง!';
}
else if($var['od_status'] == "TransferSuccess"){
	$status = '<i class="fa fa-check"></i>รอส่งของ';
}
else if($var['od_status'] == "Shipping"){
	$status = '<i class="fa fa-truck"></i>จัดส่งแล้ว';
}
else if($var['od_status'] == "Complete"){
	$status = '<i class="fa fa-check"></i>เรียบร้อย';
}
else if($var['od_status'] == "Cancel"){
	$status = 'ยกเลิก';
}
else{
	// Expire
	$status = '<i class="fa fa-clock-o"></i>หมดเวลา';
}
?>

<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items">
	<div class="order-items-status <?php echo strtolower($var['od_status']);?>"><?php echo $status;?></div>
	<div class="order-items-id">ใบสั่งซื้อหมายเลข <?php echo $var['od_id'];?></div>
	<div class="order-items-info">ชำระเงิน <?php echo number_format($var['od_payments']+50,2);?> บาท · สินค้า <?php echo $var['od_amount'];?> ชิ้น · <span class="time"><?php echo $var['order_update_time_facebook_format'];?></span></div>
</div>
</a>