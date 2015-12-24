<?php
if($var['product_type'] == "sub"){
	$link 	= $var['parent_id'];
	$title 	= '<strong>'.$var['product_title'].'</strong> – '.$var['parent_title'];
	$image 	= $var['parent_image_filename'];
}
else{
	$link 	= $var['product_id'];
	$title 	= $var['product_title'];
	$image 	= $var['product_image_filename'];
}

$reference_id = $var['order_id'].$var['product_id'];
$product_payments = $var['product_amount'] * $var['product_price'];
$order_amount = $var['product_amount'];
$product_quantity = $var['product_quantity'];
?>

<div class="items-in-order" id="items-in-order-<?php echo $var['product_id'];?>">
	<div class="items-in-order-thumbnail">
		<a href="product-<?php echo $link;?>.html">
		<img src="image/upload/thumbnail/<?php echo $image;?>" alt="">
		</a>
	</div>

	<div class="items-in-order-detail">
		<p class="detail-title"><?php echo $title;?></p>
		<p class="detail-description">฿ <?php echo number_format($var['product_price'],2);?> <?php if($order_status == "Shopping"){?><span class="remove-btn" onclick="javascript:RemoveItemInOrder(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);">ลบรายการ</span><?php }?></p>
	</div>
	<div class="items-in-order-quantity">

		<?php if($order_status != "Shopping"){?>
		<div class="value"><?php echo $order_amount;?></div>
		<?php }else{?>
		<select class="input-select" id="product-quantity-<?php echo $reference_id;?>" onchange="javascript:ChangeQuantity(<?php echo $var['order_id'];?>,<?php echo $var['product_id'];?>);">
			<?php
			if($product_quantity < 10){
				for($i=1;$i<=$product_quantity;$i++){
					?><option value="<?php echo $i;?>" <?php echo ($order_amount == $i?'selected':'');?>><?php echo $i;?></option><?php
				}
			}
			else{
				for($i=1;$i<=10;$i++){
					?><option value="<?php echo $i;?>" <?php echo ($order_amount == $i?'selected':'');?>><?php echo $i;?></option><?php
				}
			}
			?>
		</select>
		<?php }?>
	</div>
	<div class="items-in-order-total"><span id="payments-display-<?php echo $reference_id;?>"><?php echo number_format($product_payments,2);?></span></div>

	<input type="hidden" id="product-payments-<?php echo $reference_id;?>" class="items-payments" value="<?php echo $product_payments;?>">
	<input type="hidden" id="product-price-<?php echo $reference_id;?>" value="<?php echo $var['product_price'];?>">
</div>