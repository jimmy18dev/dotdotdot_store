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

<div class="order-items">
	<div class="order-items-thumbnail">
		<a href="product_detail.php?id=<?php echo $link;?>">
		<img src="../image/upload/thumbnail/<?php echo $image;?>" alt="">
		</a>
	</div>
	<div class="order-items-detail">
		<p class="detail-title"><?php echo $title;?></p>
		<p class="detail-description">Product ID #<?php echo $var['product_id'];?> · <?php echo number_format($var['product_price'],2);?> ฿ </p>
	</div>
	<div class="order-items-quantity">
		<?php echo $product_quantity;?>
	</div>
	<div class="order-items-total">
		<?php echo number_format($product_payments,2);?>
	</div>
</div>