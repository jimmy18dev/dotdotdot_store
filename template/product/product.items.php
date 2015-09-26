<?php
if($var['pd_type'] == "root"){
	$js_function = "window.location='product_detail.php?id=".$var['pd_id']."';";
}
else{
	$js_function = "AddItemToOrder(".$var['pd_id'].");";
}

if(empty($var['odt_id'])){
	$button_msg = 'Buy';
	$button_price = number_format($var['pd_price'],2).' ฿';
}
else{
	$button_msg = '<i class="fa fa-check"></i>';
	$button_price = 'Checkout';
}
?>

<div class="product-items <?php echo ($var['pd_style'] == "highlight"?'product-higtlight':'');?>">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
			<img src="store/<?php echo $var['im_thumbnail'];?>" alt="">
		</a>
	</div>
	<div class="detail">
		<div class="title">
			<p><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?></a></p>
			<p class="msg">(<?php echo $var['odt_id'];?>) 34 คนสั่งซื้อสินค้าชิ้นนี้แล้ว</p>
		</div>
		<div class="buy-button" id="buy-button-<?php echo $var['pd_id'];?>" onclick="javascript:<?php echo $js_function;?>">
			<p id="buy-button-msg-<?php echo $var['pd_id'];?>" class="animated"><?php echo $button_msg;?></p>
			<p id="buy-button-price-<?php echo $var['pd_id'];?>" class="msg"><?php echo $button_price;?></p>
		</div>
	</div>
</div>