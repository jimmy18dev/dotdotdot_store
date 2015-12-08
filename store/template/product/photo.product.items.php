<div class="photo-items" id="image-<?php echo $var['im_id'];?>">
	<img src="../image/upload/square/<?php echo $var['im_filename'];?>" alt="">
	<div class="setcover-btn" onclick="javascript:SetCover(<?php echo $var['im_product_id'];?>,<?php echo $var['im_id'];?>);">ตั้งเป็นภาพหน้าปก</div>
	<?php if($var['im_type'] != "cover"){?>
	<div class="photodelete-btn" onclick="javascript:RemovePhoto(<?php echo $var['im_product_id'];?>,<?php echo $var['im_id'];?>);"><i class="fa fa-trash-o"></i></div>
	<?php }?>
</div>