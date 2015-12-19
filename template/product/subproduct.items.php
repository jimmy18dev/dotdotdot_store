<?php
if($var['pd_type'] == "root"){
	$js_function = "window.location='product-".$var['pd_id'].".html';";
}
else{
	$js_function = "AddItemToOrder(".$var['pd_id'].");";
}

if(empty($var['odt_id'])){
	$button_msg = 'ซื้อสินค้า';
}
else{
	$button_msg = 'จ่ายเงิน<i class="fa fa-arrow-right"></i>';
}
?>

<div class="action-items">
	<div class="detail">
		<h3><span class="price">฿<?php echo number_format($var['pd_price'],2);?></span> – <?php echo $var['pd_title'];?></h3>
		<p><?php echo $var['pd_description'];?></p>
	</div>
	<div class="buy">
		<?php if($var['pd_quantity'] > 0){?>
		<div class="buy-btn animated <?php echo (!empty($var['odt_id'])?'buy-btn-active':'');?>" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>"><?php echo $button_msg;?></div>
		<?php }else{?>
		<div class="buy-btn buy-btn-disable">สินค้าหมด!</div>
		<?php }?>
	</div>
</div>