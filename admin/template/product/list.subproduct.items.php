<?php
// Product status
$status = 'แสดง';
if($var['pd_status'] != "active"){
	$status = 'ซ่อน';
}
?>

<div class="subproduct-items product-items-<?php echo $var['pd_status'];?>" id="product-<?php echo $var['pd_id'];?>">
	<div class="detail">
		<h2><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><strong><?php echo $var['pd_title'];?></strong> : <span class="description"><?php echo $var['pd_description'];?></span><i class="fa fa-angle-right"></i></a></h2>
		<p>
			<span class="price"><?php echo number_format($var['pd_price'],2);?> บาท</span>
			<span class="id"> | รหัสสินค้า: <?php echo $var['pd_id'];?></span>
		</p>
		<p class="control">
			แสดงสินค้า : <span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>

			<?php if($var['pd_sort'] > 1){?>
			<span class="status position-btn" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);"><i class="fa fa-arrow-up"></i> เลื่อนขึ้น</span>
			<?php }?>
		</p>
	</div>

	<div class="quantity <?php echo ($var['pd_quantity'] == 0?'quantity-empty':'');?>"><?php echo $var['pd_quantity'];?></div>
</div>