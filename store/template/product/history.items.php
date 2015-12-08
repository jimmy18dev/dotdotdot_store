<?php
$action = strtolower($var['pdac_action']);

if($action == "import"){
	$action = "นำเข้า";
	$detail = '<strong>คุณ'.$var['admin_name'].'</strong>';
	$icon = '<i class="fa fa-plus"></i>';
}
else if($action == "export"){
	$action = "ส่งออก";
	$detail = '<strong>คุณ'.$var['admin_name'].'</strong>';
	$icon = '<i class="fa fa-arrow-left"></i>';
}
else if($action == "soldout"){
	$action = "ขายออก";
	$detail = '<strong>คุณ'.$var['customer_name'].'</strong> รายการที่ '.$var['od_id'];
	$icon = '<i class="fa fa-truck"></i>';
}
else{
	$action = 'ไม่ทราบ!';
	$detail = 'ไม่มีรายละเอียดของการกระทำนี้';
	$icon = '<i class="fa fa-check"></i>';
}
?>

<div class="history-items">
	<div class="history-items-icon"><?php echo $icon;?></div>
	<div class="history-items-info">
		<p><strong><?php echo $action?></strong> โดย <?php echo $detail;?></p>
		<p class="time"><?php echo $var['create_time_thai_format'];?><i class="fa fa-clock-o"></i></p>
	</div>
	<div class="history-items-amount"><?php echo $var['pdac_value'];?></div>
</div>