<?php
if($var['pd_type'] == "root"){
	$js_function = "window.location='product-".$var['pd_id'].".html';";
}
else{
	$js_function = "AddItemToOrder(".$var['pd_id'].");";
}

if(empty($var['odt_id'])){
	$button_msg = 'ตะกร้า<i class="fa fa-plus"></i>';
}
else{
	$button_msg = 'ชำระเงิน<i class="fa fa-arrow-right"></i>';
}
?>

<div class="action-items">
	<div class="detail">
		<h3>ราคา <strong><?php echo number_format($var['pd_price']);?></strong> บาท · <?php echo $var['pd_title'];?></h3>
		<p><?php echo $var['pd_description'];?></p>
	</div>
	<div class="buy">
		<div class="buy-btn animated <?php echo (!empty($var['odt_id'])?'buy-btn-active':'');?>" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>"><?php echo $button_msg;?></div>
	</div>
</div>