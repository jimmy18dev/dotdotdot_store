<?php
if($var['product_type'] == "sub"){
	$link 	= $var['parent_id'];
	$title 	= $var['parent_title'].' – <strong>'.$var['product_title'].'</strong>';
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

<div class="items-in-order">
	<div class="items-in-order-thumbnail">
		<a href="product_detail.php?id=<?php echo $link;?>">
		<img src="../image/upload/thumbnail/<?php echo $image;?>" alt="">
		</a>
	</div>
	<div class="items-in-order-detail">
		<p class="detail-title"><?php echo $title;?></p>
		<p class="detail-description">รหัสสินค้า: <?php echo $var['product_id'];?> · ราคา <?php echo number_format($var['product_price']);?> บาท</p>
	</div>
	<div class="items-in-order-quantity">
		<?php echo $product_quantity;?>
	</div>
	<div class="items-in-order-total"><?php echo number_format($product_payments);?> <span class="currency">บาท</span></div>
</div>