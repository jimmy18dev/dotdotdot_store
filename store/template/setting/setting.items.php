<div class="config-items">
	<div class="cogfig-caption"><?php echo $var['cf_caption'];?></div>
	<div class="config-input">
		<?php if($var['cf_inputtype'] == "textarea"){?>
		<textarea id="<?php echo $var['cf_key'];?>" class="input-text input-textarea" placeholder="<?php echo $var['cf_key'];?>"><?php echo $var['cf_value'];?></textarea>
		<?php }else if($var['cf_inputtype'] == "text"){?>
		<input type="text" id="<?php echo $var['cf_key'];?>" class="input-text" placeholder="<?php echo $var['cf_key'];?>" value="<?php echo $var['cf_value'];?>">
		<?php }?>
	</div>
</div>