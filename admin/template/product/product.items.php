<?php
// Product status
$status = 'แสดง';
if($var['pd_status'] != "active"){
	$status = 'ซ่อน';
}
?>

<?php if($var['pd_type'] == "root"){?>
<div class="product-root-items product-items-<?php echo $var['pd_status'];?>" id="product-<?php echo $var['pd_id'];?>">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
		<?php if(empty($var['im_filename'])){?>
		<img src="image/no-image.jpg" alt="">
		<?php }else{?>
		<img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>">
		<?php }?>
		</a>
	</div>
	<div class="detail">
		<h2><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?></a></h2>
		<p><?php echo (empty($var['pd_description'])?'...':$var['pd_description']);?></p>
		<p class="control">
			แสดงสินค้า : <span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>

			<?php if($var['pd_sort'] > 1){?>
			<span class="status position-btn" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);" title="เลื่อนขึ้น"><i class="fa fa-arrow-up"></i> เลื่อนขึ้น</span>
			<?php }?>
		</p>
	</div>
	<div class="subitems">
		<?php $this->ListSubProduct(array('product_id' => $var['pd_id'],'render' => 'list-subproduct-items'));?>	
	</div>
</div>
<?php }else{?>
<div class="product-normal-items product-items-<?php echo $var['pd_status'];?>" id="product-<?php echo $var['pd_id'];?>">
	<div class="thumbnail">
		<a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent">
		<?php if(empty($var['im_filename'])){?>
		<img src="image/no-image.jpg" alt="">
		<?php }else{?>
		<img src="../image/upload/thumbnail/<?php echo $var['im_filename'];?>">
		<?php }?>
		</a>
	</div>
	<div class="detail">
		<h2 class="title"><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_title'];?></a></h2>
		<p>
			<span class="price"><?php echo ($var['pd_type']=="root"?'':''.number_format($var['pd_price'],2).' ฿.');?></span>
			<?php if($var['pd_type'] != "root"){?>
			<span class="id"> | รหัสสินค้า: <?php echo $var['pd_id'];?></span>
			<?php }?>
		</p>
		<p class="control">
			แสดงสินค้า : 
			<span id="status-<?php echo $var['pd_id'];?>" class="status status-<?php echo $var['pd_status'];?>" onclick="javascript:ChangeStatus(<?php echo $var['pd_id'];?>,'<?php echo $var['pd_status'];?>');"><?php echo $status;?></span>
			
			<?php if($var['pd_sort'] > 1){?>
			<span class="status position-btn" onclick="javascript:ChangePosition(<?php echo $var['pd_id'];?>);" title="เลื่อนขึ้น"><i class="fa fa-arrow-up"></i> เลื่อนขึ้น</span>
			<?php }?>
		</p>
	</div>
	<div class="quantity <?php echo ($var['pd_quantity'] == 0?'quantity-empty':'');?>"><?php echo ($var['pd_quantity'] > 0?$var['pd_quantity']:'หมด');?></div>
</div>
<?php }?>