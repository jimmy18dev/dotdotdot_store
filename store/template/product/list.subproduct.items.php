<div class="subproduct-items">
	<div class="subproduct-detail">
		<div class="title">รหัสสินค้า: <?php echo $var['pd_id'];?> · <?php echo $var['pd_title'];?> · <span class="description"><?php echo $var['pd_description'];?></span></div>
		<div class="price"><?php echo number_format($var['pd_price'],2);?> บาท</div>
	</div>
	<div class="subproduct-quantity"><?php echo $var['pd_quantity'];?></div>
</div>