<div class="bank-items">
	<div class="bank-items-icon"><img src="image/bank_icons/<?php echo strtolower($var['bk_code']);?>.png"></div>
	<div class="bank-items-info">
		<strong><?php echo $var['bk_name'];?></strong> สาขา<?php echo $var['bk_account_branch'];?><br>
		ชื่อบัญชี <?php echo $var['bk_account_name'];?><br>
		<?php echo $var['bk_account_number'];?><br>
	</div>
</div>