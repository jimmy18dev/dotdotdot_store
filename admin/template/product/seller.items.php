<?php
if($var['pdac_action'] == "import"){
	$action = '<i class="fa fa-arrow-right"></i>นำเข้าสินค้า';
}
else if($var['pdac_action'] == "export"){
	$action = '<i class="fa fa-arrow-left"></i>โอนสินค้าออก';
}
else{
	$action = 'ไม่ทราบ!';
}
?>

<div class="history-items">
	<div class="history-items-action <?php echo $var['pdac_action'];?>"><?php echo $action;?></div>
	<div class="history-items-info"><?php echo $var['create_time_thai_format'];?> โดย <?php echo $var['me_name'];?> จำนวน <span class="quantity"><?php echo $var['pdac_value'];?> ชิ้น</span></div>
</div>