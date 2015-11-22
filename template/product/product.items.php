<?php

if(MEMBER_ONLINE){
	if($var['pd_type'] == "root"){
		$js_function = "window.location='product-".$var['pd_id'].".html';";
	}
	else{
		$js_function = "AddItemToOrder(".$var['pd_id'].");";
	}
}
else{
	$js_function = "window.location='login.php';";
}

if(empty($var['odt_id'])){
	$button_msg = '฿'.number_format($var['pd_price'],2).' <i class="fa fa-shopping-cart"></i>';
}
else{
	$button_msg = '<i class="fa fa-arrow-right"></i> ชำระเงิน';
}

// Message setup
if($var['odt_id'] > 5){
	$msg = $var['odt_id']." ท่าน สั่งซื้อสินค้าชิ้นนี้แล้ว";
}
else if($var['pd_quantity'] < 5){
	$msg = 'เหลือเพียง '.$var['pd_quantity'].' เท่านั้น!';
}
else if($var['pd_read'] > 100){
	$msg = $var['pd_read'].'ท่าน กำลังสนใจสินค้านี้';
}
else if($var['pd_view'] > 100){
	$msg = 'แสดงสินค้า '.$var['pd_read'].' ครั้งแล้ว';
}
else{
	$msg = '"คุณอาจจะชอบสินค้าชิ้นนี้"';
}
?>

<div class="product-items <?php echo ($var['pd_style'] == "highlight"?'product-higtlight':'');?>">
	<div class="product-items-thumbnail">
		<a href="product-<?php echo $var['pd_id'];?>.html" target="_parent">
			<img src="image/upload/square/<?php echo $var['im_filename'];?>" alt="">
		</a>
	</div>
	<div class="product-items-detail">
		<h2><a href="product-<?php echo $var['pd_id'];?>.html" target="_parent"><?php echo $var['pd_title'];?></a></h2>
		<div class="buy-btn animated <?php echo (!empty($var['odt_id'])?'buy-btn-active':'');?>" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>"><?php echo $button_msg;?></div>
	</div>
</div>