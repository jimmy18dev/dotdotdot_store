<?php
if($var['pd_type'] == "root"){
	$js_function = "window.location='product-".$var['pd_id'].".html';";
}
else{
	$js_function = "AddItemToOrder(".$var['pd_id'].");";
}

if(empty($var['odt_id'])){
	$button_msg = 'สั่งซื้อ';
	$button_price = number_format($var['pd_price'],2).' ฿';
}
else{
	$button_msg = '<i class="fa fa-arrow-right"></i>';
	$button_price = 'ชำระเงิน';
}
?>

<div class="action-items">
	<div class="detail">
		<div class="caption"><?php echo $var['pd_title'];?></div>
		<div class="desc"><?php echo $var['pd_description'];?></div>
	</div>
	<div class="detail-buy-btn" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>">
		<p id="buy-button-msg-<?php echo $var['pd_id'];?>" class="animated"><?php echo $button_msg;?></p>
		<p id="buy-button-price-<?php echo $var['pd_id'];?>" class="msg"><?php echo $button_price;?></p>
	</div>
</div>