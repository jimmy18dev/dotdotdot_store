<div class="bank-items" id="bank-<?php echo $var['bk_id'];?>">
	<div class="bank-items-icon">
		<img src="../image/bank_icons/<?php echo $var['bk_code'];?>.png">
	</div>
	<div class="bank-items-detail">
		<p><?php echo $var['bk_name'];?></p>
		<p><strong><?php echo $var['bk_account_number'];?></strong></p>
		<p>ชื่อบัญชี <?php echo $var['bk_account_name'];?> | สาขา<?php echo $var['bk_account_branch']?> <a href="bank-editor.php?id=<?php echo $var['bk_id'];?>"><i class="fa fa-cog"></i>แก้ไข</a> <!-- <span onclick="javascript:DeleteBank(<?php echo $var['bk_id'];?>);">ลบ</span> --></p>
	</div>
</div>