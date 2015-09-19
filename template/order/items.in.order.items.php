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
		<div class="product-control">
			<div class="product-id">รหัสสินค้า <?php echo $var['pd_id'];?></div>
			<div class="control"><span onclick="javascript:RemoveItemInOrder(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>);"><i class="fa fa-trash-o"></i> ลบ</span></div>
		</div>
		<div class="product-title">Notebook "he is our king" Stamp Foiled ขนาด A5 ปกแข็งไม่มีเส้น</div>

		<div class="product-payments">
			<div class="quantity">
				<div class="quantity-caption">ราคาชิ้นละ <?php echo number_format($var['pd_price']);?> x </div>
				<div class="quantity-button" onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'down');">-</div>
				<div class="quantity-value" id="quantity-display-<?php echo $reference_id;?>"><?php echo $product_quantity;?></div>
				<div class="quantity-button" onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'up');">+</div>
			</div>
			<div class="payments" id="payments-display-<?php echo $reference_id;?>"><?php echo number_format($product_payments);?></div>
		</div>
	</div>

	<input type="hidden" id="product-amount-<?php echo $reference_id;?>" type="number" value="<?php echo $product_quantity;?>">
	<input type="hidden" id="product-payments-<?php echo $reference_id;?>" value="<?php echo $product_payments;?>">
	<input type="hidden" id="product-price-<?php echo $reference_id;?>" value="<?php echo $var['pd_price'];?>">
</div>