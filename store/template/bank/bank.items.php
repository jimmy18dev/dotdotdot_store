<div class="bank-items" id="bank-<?php echo $var['bk_id'];?>">
	<p><img src="../image/bank_icons/<?php echo $var['bk_code'];?>.png"><?php echo $var['bk_name'];?></p>
	<p class="big"><?php echo $var['bk_account_number'];?></p>
	<p>ชื่อบัญชี <?php echo $var['bk_account_name'];?> สาขา <?php echo $var['bk_account_branch']?> <a href="bank-editor.php?id=<?php echo $var['bk_id'];?>">แก้ไข</a> <span onclick="javascript:DeleteBank(<?php echo $var['bk_id'];?>);">ลบ</span></p>
</div>