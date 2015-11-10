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
	$button_msg = 'Buy';
	$button_price = number_format($var['pd_price'],2).' ฿';
}
else{
	$button_msg = '<i class="fa fa-check"></i>';
	$button_price = 'Checkout';
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
	$msg = 'คุณอาจจะชอบสินค้าชิ้นนี้!';
}
?>

<div class="product-items <?php echo ($var['pd_style'] == "highlight"?'product-higtlight':'');?>">
	<div class="product-items-thumbnail">
		<a href="product-<?php echo $var['pd_id'];?>.html" target="_parent">
			<img src="image/upload/square/<?php echo $var['im_filename'];?>" alt="">
		</a>
	</div>
	<div class="product-items-detail">
		<div class="detail-title">
			<h2><a href="product-<?php echo $var['pd_id'];?>.html" target="_parent"><?php echo $var['pd_title'];?></a></h2>
			<p>
				<span class="buy-btn" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>"><span id="buy-button-msg-<?php echo $var['pd_id'];?>" class="animated"><?php echo $button_msg;?></span>
			<span id="buy-button-price-<?php echo $var['pd_id'];?>" class="msg"><?php echo $button_price;?></span>
			</span><span><?php echo $msg;?></span>
			</p>
		</div>
	</div>
</div>