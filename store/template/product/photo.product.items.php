<div class="image-items" id="image-<?php echo $var['im_id'];?>">
	<img src="../image/upload/square/<?php echo $var['im_filename'];?>" alt="">

	<?php if($var['im_type'] == "cover"){?>
	<div class="button-cover cover-active"><i class="fa fa-star"></i></div>
	<?}else{?>
	<div class="button-cover" onclick="javascript:SetCover(<?php echo $var['im_product_id'];?>,<?php echo $var['im_id'];?>);"><i class="fa fa-star-o"></i></div>
	<?php }?>

	<?php if($var['im_type'] != "cover"){?>
	<div class="button-delete" onclick="javascript:RemovePhoto(<?php echo $var['im_product_id'];?>,<?php echo $var['im_id'];?>);">ลบภาพ</div>
	<?php }?>
</div>