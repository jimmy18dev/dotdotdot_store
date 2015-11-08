<?php
if($var['product_type'] == "sub"){
	$link 	= $var['parent_id'];
	$title 	= $var['parent_title'].' ('.$var['product_title'].')';
	$image 	= $var['parent_image_filename'];
}
else{
	$link 	= $var['product_id'];
	$title 	= $var['product_title'];
	$image 	= $var['product_image_filename'];
}

$reference_id = $var['order_id'].$var['product_id'];
$product_payments = $var['product_amount'] * $var['product_price'];
$product_quantity = $var['product_amount'];
?>

<div class="items-in-order" id="items-in-order-<?php echo $var['product_id'];?>">
	<div class="items-in-order-thumbnail">
		<a href="product-<?php echo $link;?>.html">
		<img src="image/upload/thumbnail/<?php echo $image;?>" alt="">
		</a>
	</div>

	<div class="items-in-order-detail">
		<p class="detail-title"><a href="product-<?php echo $link;?>.html"><?php echo $title;?></a></p>
		<p class="detail-description">รหัสสินค้า: <?php echo $var['product_id'];?> · ราคา <?php echo number_format($var['product_price'],2);?> ฿  · <?php if($order_status == "Shopping"){?><span class="remove-btn" onclick="javascript:RemoveItemInOrder(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);">Remove items</span><?php }?></p>
	</div>
	<div class="items-in-order-quantity">
		<input type="text" id="product-quantity-<?php echo $reference_id;?>" type="number" value="<?php echo $product_quantity;?>" onblur="javascript:ChangeQuantity(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);" <?php echo ($order_status != "Shopping"?'disabled':'');?>>
	</div>
	<div class="items-in-order-total">
		<span class="currency">฿</span>
		<span id="payments-display-<?php echo $reference_id;?>"><?php echo number_format($product_payments,2);?></span>
	</div>

	<input type="hidden" id="product-payments-<?php echo $reference_id;?>" class="items-payments" value="<?php echo $product_payments;?>">
	<input type="hidden" id="product-price-<?php echo $reference_id;?>" value="<?php echo $var['product_price'];?>">
</div>