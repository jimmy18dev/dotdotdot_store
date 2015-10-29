<div class="image-items">
	<img src="../image/upload/square/<?php echo $var['im_filename'];?>" alt="">

	<?php if($var['im_type'] == "cover"){?>
	<div class="button-cover cover-active"><i class="fa fa-star"></i></div>
	<?}else{?>
	<div class="button-cover" onclick="javascript:SetCover(<?php echo $var['im_product_id'];?>,<?php echo $var['im_id'];?>);"><i class="fa fa-star-o"></i></div>
	<?php }?>
	<div class="button-delete">ลบภาพ</div>
</div>