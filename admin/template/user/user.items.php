<div class="user-items">
	<div class="user-items-avatar">
		<?php if(empty($var['facebook_id'])){?>
		<img src="../image/avatar.png" alt="">
		<?php }else{?>
		<img src="https://graph.facebook.com/<?php echo $var['me_fb_id'];?>/picture?type=square" alt="">
		<?php }?>
	</div>
	<div class="user-items-info">
		<p class="name"><?php echo $var['me_name'];?> <?php if($var['me_type'] == "administrator"){?><span class="admin">(Administrator)</span><?php }?></p>
		<p class="mini">
			<?php echo $var['me_phone'];?> – <?php echo $var['me_email'];?> 

			<?php if($current_id != $var['me_id']){?>
			<span id="control-btn-<?php echo $var['me_id'];?>" title="Add to administrator" class="control-btn" onclick="javascript:SetAdmin(<?php echo $var['me_id'];?>,'<?php echo $var['me_type'];?>');"><?php echo ($var['me_type'] == 'administrator'?'Remove an Admin<i class="fa fa-times"></i>':'Add to Admin<i class="fa fa-key"></i>');?></span>
			<?php }?>
		</p>
	</div>
</div>