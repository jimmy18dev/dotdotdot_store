<div class="product-items <?php echo ($var['pd_style'] == "highlight"?'product-higtlight':'');?>">
	<div class="product-items-thumbnail">
		<a href="product-<?php echo $var['pd_id'];?>.html" target="_parent">
			<?php if(empty($var['im_filename'])){?>
			<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/image/no-image.jpg" alt="<?php echo $var['pd_title'];?>">
			<?php }else{?>
			<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/image/upload/square/<?php echo $var['im_filename'];?>" alt="<?php echo $var['pd_title'];?>">
			<?php }?>
		</a>
	</div>
	<div class="product-items-detail">
		<h2><a href="product-<?php echo $var['pd_id'];?>.html" target="_parent"><?php echo $var['pd_title'].' Read:'.$var['pd_read'];?></a></h2>
		<?php if($var['pd_quantity'] == 0 && $var['pd_type'] == "normal"){?>
		<p class="empty">สินค้าหมด</p>
		<?php }else{?>
		<p><?php echo number_format($var['pd_price'],2);?> ฿.</p>
		<?php }?>
	</div>
</div>