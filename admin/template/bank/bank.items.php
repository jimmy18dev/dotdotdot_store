<div class="bank-items" id="bank-<?php echo $var['bk_id'];?>">
	<div class="bank-items-icon">
		<img src="../image/bank_icons/<?php echo strtolower($var['bk_code']);?>.png">
	</div>
	<div class="bank-items-detail">
		<p><?php echo $var['bk_name'];?> <a href="bank-editor.php?id=<?php echo $var['bk_id'];?>">แก้ไข</a></p>
		<p><strong><?php echo $var['bk_account_number_format'];?></strong></p>
		<p>ชื่อบัญชี <?php echo $var['bk_account_name'];?> | สาขา<?php echo $var['bk_account_branch']?><!-- <span onclick="javascript:DeleteBank(<?php echo $var['bk_id'];?>);">ลบ</span> --></p>
	</div>
</div>