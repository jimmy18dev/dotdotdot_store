<?php
if($var['product_type'] == "sub"){
	$link 	= $var['parent_id'];
	$title 	= $var['parent_title'].' ('.$var['product_title'].')';
	$image 	= $var['parent_image_thumbnail'];
}
else{
	$link 	= $var['product_id'];
	$title 	= $var['product_title'];
	$image 	= $var['product_image_thumbnail'];
}

$reference_id = $var['order_id'].$var['product_id'];
$product_payments = $var['product_amount'] * $var['product_price'];
$product_quantity = $var['product_amount'];
?>

<div class="items-in-order" id="items-in-order-<?php echo $var['product_id'];?>">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $link;?>">
		<img src="store/<?php echo $image;?>" alt="">
		</a>
	</div>

	<div class="detail">
		<div class="product-title">
			<p class="title"><?php echo $title;?></p>

			<p class="description">Product ID #<?php echo $var['product_id'];?> · <?php echo number_format($var['product_price'],2);?> ฿ <?php if($order_status == "Shopping"){?><span class="remove-button" onclick="javascript:RemoveItemInOrder(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);">Remove items</span><?php }?>
			</p>
		</div>
		<div class="product-payments">
			<div class="quantity">
				<input type="text" id="product-quantity-<?php echo $reference_id;?>" type="number" value="<?php echo $product_quantity;?>" onblur="javascript:ChangeQuantity(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);" <?php echo ($order_status != "Shopping"?'disabled':'');?>>
			</div>
			<div class="payments">
				<span id="payments-display-<?php echo $reference_id;?>"><?php echo number_format($product_payments,2);?></span>
				<span class="currency">฿</span>
			</div>
		</div>
	</div>

	<input type="hidden" id="product-payments-<?php echo $reference_id;?>" class="items-payments" value="<?php echo $product_payments;?>">
	<input type="hidden" id="product-price-<?php echo $reference_id;?>" value="<?php echo $var['product_price'];?>">
</div>