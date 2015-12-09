<?php
$action = strtolower($var['pdac_action']);

if($action == "import"){
	$action = "นำเข้าสินค้า";
	$detail = 'คุณ'.$var['admin_name'];
	$icon = '<i class="fa fa-plus"></i>';
	$amount = '+'.$var['pdac_value'];
}
else if($action == "export"){
	$action = "โอนสินค้าออก";
	$detail = 'คุณ'.$var['admin_name'];
	$icon = '<i class="fa fa-arrow-left"></i>';
	$amount = '-'.$var['pdac_value'];
}
else if($action == "soldout"){
	$action = "ขายออก";
	$detail = '<strong>คุณ'.$var['customer_name'].'</strong> รายการที่ '.$var['od_id'];
	$icon = '<i class="fa fa-truck"></i>';
	$amount = '-'.$var['pdac_value'];
}
else{
	$action = 'ไม่ทราบ!';
	$detail = 'ไม่มีรายละเอียดของการกระทำนี้';
	$icon = '<i class="fa fa-check"></i>';
	$amount = '#'.$var['pdac_value'];
}
?>

<div class="history-items">
	<div class="history-items-info">
		<p><strong><?php echo $action?></strong> – <?php echo $detail;?></p>
		<p class="mini"><?php echo $var['create_time_thai_format'];?><i class="fa fa-clock-o"></i></p>
	</div>
	<div class="history-items-amount"><?php echo $amount;?></div>
</div>