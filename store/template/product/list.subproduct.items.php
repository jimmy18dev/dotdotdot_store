<?php
// Product status
$status = '<i class="fa fa-circle"></i> แสดง';
if($var['pd_status'] != "active"){
	$status = '<i class="fa fa-circle"></i> ไม่แสดง';
}
?>

<div class="subproduct-items product-items-<?php echo $var['pd_status'];?>" id="product-<?php echo $var['pd_id'];?>">
	<div class="subproduct-detail">
		<h3><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?> – <span class="description"><?php echo $var['pd_description'];?></span></a></h3>

		<p>
			<span class="price"><?php echo number_format($var['pd_price'],2);?> บาท</span>
			<span class="id"> | รหัสสินค้า: <?php echo $var['pd_id'];?></span>
		</p>
		<p>
			<span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>

			<span class="status" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);"><i class="fa fa-arrow-up"></i> ย้ายขึ้น</span>


			<a href="product_editor.php?id=<?php echo $var['pd_id'];?>"><i class="fa fa-cog"></i> <span class="link-caption">แก้ไข</span></a>
			<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=export"><i class="fa fa-arrow-left"></i> <span class="link-caption">โอนออก</span></a>
			<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=import"><i class="fa fa-plus"></i> <span class="link-caption">นำเข้า</span></a>
		</p>
	</div>
	<div class="subproduct-quantity"><?php echo $var['pd_quantity'];?></div>
</div>