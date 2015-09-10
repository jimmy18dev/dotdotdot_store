<div class="items-in-order" id="items-in-order-<?php echo $var['odt_product_id'];?>">
	<div class="thumbnail">
		<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xaf1/v/t1.0-9/11781638_10203630039191047_164862492384789278_n.jpg?oh=8d5d9eb132f959084ac1ed8f4c15b046&oe=56A74F3A" alt="">
	</div>
	<div class="detail">
		<div class="product-code">รหัสสินค้า <?php echo $var['pd_id'];?></div>
		<div class="product-title"><?php echo $var['pd_title'];?></div>
		<div class="product-price">ราคา <?php echo $var['pd_price'];?> บาท</div>
		<input type="hidden" id="product-price-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" value="<?php echo $var['pd_price'];?>">
	</div>
	<div class="pay">
		<div class="quantity">
			<div class="caption">จำนวน</div>
			<input type="text" class="input" id="product-amount-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" type="number" value="<?php echo $var['odt_amount'];?>">
		</div>
		<div class="payments"><?php echo $var['odt_amount']*$var['pd_price'];?></div>

		<input type="hidden" id="product-payments-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" value="<?php echo $var['odt_amount']*$var['pd_price'];?>">
	</div>

	<div class="control">
		<button onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'up');">+</button>
		<button onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'down');">-</button>
		<span onclick="javascript:RemoveItemInOrder(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>);">[ลบรายการ]</span>	
	</div>
</div>