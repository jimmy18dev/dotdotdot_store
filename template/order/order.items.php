<?php

if($var['od_status'] == "Shopping"){
	$order_icon = '<i class="fa fa-shopping-cart"></i>';
	$order_status = 'เลือกสินค้า';
	$order_note = 'กำลังเลือกสินค้า';
}
else if($var['od_status'] == "Paying"){
	$order_icon = '<i class="fa fa-barcode"></i>';
	$order_status = 'ชำระเงิน';
	$order_note = 'กรุณาโอนเงินก่อน '.$var['order_expire_time_thai_format'].' (อีก '.$var['order_expire_time_datediff'].')';
}
else if($var['od_status'] == "TransferAgain" || $var['od_status'] == "TransferRequest"){
	$order_icon = '<i class="fa fa-money"></i>';
	$order_status = 'โอนเงิน';
	$order_note = 'ยืนยันการโอนเงินเมื่อ '.$var['order_confirm_time_thai_format'];
}
else if($var['od_status'] == "TransferSuccess"){
	$order_icon = '<i class="fa fa-check"></i>';
	$order_status = 'กำลังจัดส่ง';
	$order_note = 'โอนเงินแล้วแล้ว เมื่อ '.$var['order_confirm_time_thai_format'];
}
else if($var['od_status'] == "Shipping"){
	$order_icon = '<i class="fa fa-truck"></i>';
	$order_status = 'รอรับสินค้า';
	$order_note = 'จัดส่งสินค้า เมื่อ '.$var['order_shipping_time_facebook_format'];
}
else if($var['od_status'] == "Complete"){
	$order_icon = '<i class="fa fa-smile-o"></i>';
	$order_status = 'เรียบร้อย';
	$order_note = 'ยืนยันการรับสินค้า เมื่อ '.$var['order_update_time_thai_format'];
}
else if($var['od_status'] == "Expire"){
	$order_icon = '<i class="fa fa-clock-o"></i>';
	$order_status = 'หมดเวลา';
}
else{
	$order_icon = '<i class="fa fa-circle-thin"></i>';
	$order_status = 'ไม่ระบุ';
}
?>

<a href="order_detail.php?id=<?php echo $var['od_id'];?>">
<div class="order-items">
	<div class="order-icon"><?php echo $order_icon;?></div>
	<div class="order-detail">
		<div class="title"><span class="status"><?php echo $order_status;?></span> รายการสั่งซื้อ #<?php echo $var['od_id'];?></div>
		<div class="note"><?php echo $order_note;?></div>
	</div>
	<div class="order-payments">
		<div class="quantity"><?php echo $var['od_total'];?></div>
		<div class="payments"><?php echo number_format($var['od_payments'],2);?> <span class="currency">฿</span></div>
	</div>
</div>
</a>