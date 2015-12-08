<div class="user-items">
	<div class="user-items-avatar">
		<?php if(empty($var['facebook_id'])){?>
		<img src="../image/avatar.png" alt="">
		<?php }else{?>
		<img src="https://graph.facebook.com/<?php echo $var['facebook_id'];?>/picture?type=square" alt="">
		<?php }?>
	</div>
	<div class="user-items-info">
		<p><?php echo $var['me_name'];?></p>
		<p class="mini"><?php echo $var['me_phone'];?> <?php echo $var['me_email'];?> Verified</p>
	</div>
</div>