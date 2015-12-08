<?php
// Product status
$status = '<i class="fa fa-circle"></i> แสดง';
if($var['pd_status'] != "active"){
	$status = '<i class="fa fa-circle"></i> ไม่แสดง';
}
?>

<div class="product-items product-items-<?php echo $var['pd_status'];?>" id="product-<?php echo $var['pd_id'];?>">
	<div class="product-thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
		<?php if(empty($var['im_filename'])){?>
		<img src="image/no-image.jpg" alt="">
		<?php }else{?>
		<img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>">
		<?php }?>
		</a>
	</div>

	<?php if($var['pd_type'] == "root"){{?>
	<div class="product-subproduct">
		<div class="subproduct-title"><?php echo $var['pd_title'];?></div>
		<div id="status-<?php echo $var['pd_id'];?>" class="subproduct-status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></div>
		<div class="subproduct-status" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);"><i class="fa fa-arrow-up"></i> ย้ายขึ้น</div>

		<?php $this->ListSubProduct(array('product_id' => $var['pd_id'],'render' => 'list-subproduct-items'));}?>
	</div>
	<?php }else{?>
	<div class="product-content">
		<div class="detail">
			<h2><?php echo $var['pd_title'];?></h2>

			<p>
				<span class="price"><?php echo ($var['pd_type']=="root"?'สินค้าย่อย 4 รายการ':''.number_format($var['pd_price'],2).' บาท');?></span>
				<?php if($var['pd_type'] != "root"){?>
				<span class="id"> · รหัสสินค้า: <?php echo $var['pd_id'];?></span>
				<?php }?>
			</p>
			<p>
				<span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>
				<span class="status" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);"><i class="fa fa-arrow-up"></i> ย้ายขึ้น</span>

				<a href="product_editor.php?id=<?php echo $var['pd_id'];?>"><i class="fa fa-cog"></i> <span class="link-caption">แก้ไข</span></a>
				<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=export"><i class="fa fa-arrow-left"></i> <span class="link-caption">โอนออก</span></a>
				<a href="quantity.php?id=<?php echo $var['pd_id'];?>&action=import"><i class="fa fa-plus"></i> <span class="link-caption">นำเข้า</span></a>
				
				<a href="product_editor.php?parent=<?php echo $var['pd_id'];?>"><i class="fa fa-files-o"></i> เพิ่มสินค้าย่อย</a>
			</p>
		</div>
		<div class="quantity"><?php echo $var['pd_quantity'];?></div>
	</div>
	<?php }?>
</div>