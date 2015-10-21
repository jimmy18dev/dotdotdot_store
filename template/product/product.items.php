<?php

if(MEMBER_ONLINE){
	if($var['pd_type'] == "root"){
		$js_function = "window.location='product_detail.php?id=".$var['pd_id']."';";
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
else if($var['pd_read'] > 100){
	$msg = $var['pd_read'].'ท่าน กำลังสนใจสินค้านี้';
}
else if($var['pd_view'] > 100){
	$msg = 'แสดงสินค้า '.$var['pd_read'].' ครั้งแล้ว';
}
else{
	$msg = 'NEW Product Available Now!';
}
?>

<div class="product-items <?php echo ($var['pd_style'] == "highlight"?'product-higtlight':'');?>">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
			<img src="store/image/upload/square/<?php echo $var['im_filename'];?>" alt="">
		</a>
	</div>
	<div class="detail">
		<div class="title">
			<p><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?></a></p>
			<p class="msg"><?php echo $msg;?></p>
		</div>
		<div class="buy-button" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>">
			<p id="buy-button-msg-<?php echo $var['pd_id'];?>" class="animated"><?php echo $button_msg;?></p>
			<p id="buy-button-price-<?php echo $var['pd_id'];?>" class="msg"><?php echo $button_price;?></p>
		</div>
	</div>
</div>