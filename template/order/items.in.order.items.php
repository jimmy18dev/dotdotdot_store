<p id="items-in-order-<?php echo $var['odt_product_id'];?>">
	<input id="product-amount-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" type="number" value="<?php echo $var['odt_amount'];?>"> [<?php echo $var['odt_id'];?>] <?php echo $var['pd_title'];?> ราคา <input type="text" id="product-price-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" value="<?php echo $var['pd_price'];?>"> <input type="text" class="items-payments" id="product-payments-<?php echo $var['odt_order_id'].$var['odt_product_id'];?>" value="<?php echo $var['odt_amount']*$var['pd_price'];?>">

	<button onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'up');">+</button>
	<button onclick="javascript:ChangeAmount(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>,'down');">-</button>
	<span onclick="javascript:RemoveItemInOrder(<?php echo $var['odt_order_id'];?>,<?php echo $var['odt_product_id'];?>);">[ลบรายการ]</span>
</p>