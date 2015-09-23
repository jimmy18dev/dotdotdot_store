<?php
$reference_id = $var['odt_order_id'].$var['odt_product_id'];
$product_payments = $var['odt_amount']*$var['pd_price'];
$product_quantity = $var['odt_amount'];
?>

<div class="items-in-order" id="items-in-order-<?php echo $var['odt_product_id'];?>">
	<div class="thumbnail">
		<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xaf1/v/t1.0-9/11781638_10203630039191047_164862492384789278_n.jpg?oh=8d5d9eb132f959084ac1ed8f4c15b046&oe=56A74F3A" alt="">
	</div>

	<div class="detail">
		<div class="product-title">
			<p class="title"><?php echo $var['pd_title'];?></p>
			<p class="description">รหัสสินค้า <?php echo $var['pd_id'];?> ราคาชื้นละ <?php echo number_format($var['pd_price']);?> บาท <?php if($order_status == "Shopping"){?><span class="remove-button" onclick="javascript:RemoveItemInOrder(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>);">ลบจากรายการ</span><?php }?>
			</p>
		</div>
		<div class="product-payments">
			<div class="quantity">
				<input type="text" id="product-amount-<?php echo $reference_id;?>" type="number" value="<?php echo $product_quantity;?>" onblur="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>);" <?php echo ($order_status != "Shopping"?'disabled':'');?>>
			</div>
			<div class="payments">
				<span id="payments-display-<?php echo $reference_id;?>"><?php echo number_format($product_payments);?></span>
				<span class="currency">฿</span>
			</div>
		</div>
	</div>

	<input type="hidden" id="product-payments-<?php echo $reference_id;?>" class="items-payments" value="<?php echo $product_payments;?>">
	<input type="hidden" id="product-price-<?php echo $reference_id;?>" value="<?php echo $var['pd_price'];?>">
</div>