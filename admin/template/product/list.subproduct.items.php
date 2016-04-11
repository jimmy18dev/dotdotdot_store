<?php
// Product status
$status = '<i class="fa fa-circle"></i> แสดง';
if($var['pd_status'] != "active"){
	$status = '<i class="fa fa-circle"></i> ไม่แสดง';
}
?>

<div class="product-items product-items-<?php echo $var['pd_status'];?> subproduct-items" id="product-<?php echo $var['pd_id'];?>">
	<div class="product-icon"><i class="fa fa-files-o"></i></div>
	<div class="product-content">
		<h2><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?> – <span class="description"><?php echo $var['pd_description'];?></span></a></h2>
		<p>
			<span class="price"><?php echo number_format($var['pd_price'],2);?> บาท</span>
			<span class="id"> | รหัสสินค้า: <?php echo $var['pd_id'];?></span>
		</p>
		<p class="control">
			<span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>

			<?php if($var['pd_sort'] > 1){?>
			<span class="status position-btn" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);"><i class="fa fa-arrow-up"></i> เลื่อนขึ้น</span>
			<?php }?>

			<span class="option-control">
				<a href="product_editor.php?id=<?php echo $var['pd_id'];?>" title="แก้ไขข้อมูล"><i class="fa fa-cog"></i><span class="link-caption"></span></a>
				<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=export" title="โอนสินค้าออก"><i class="fa fa-arrow-left"></i> <span class="link-caption"></span></a>
				<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=import" title="นำเข้าสินค้า"><i class="fa fa-plus"></i> <span class="link-caption"></span></a>
			</span>
		</p>
	</div>

	<div class="product-quantity <?php echo ($var['pd_quantity'] == 0?'quantity-empty':'');?>"><?php echo $var['pd_quantity'];?></div>
</div>