<header class="header">
	<div class="logo">Administrator.</div>
	<div class="account">
		<div class="avatar">
			<?php if(empty($user->facebook_id)){?>
			<img src="../image/avatar.png" alt="">
			<?php }else{?>
			<img src="https://graph.facebook.com/<?php echo $user->facebook_id;?>/picture?type=square" alt="">
			<?php }?>
		</div>
	</div>
</header>
<nav class="navigator">
	<ul>
		<a href="index.php"><li class="<?php echo ($current_page == "order"?'active':'');?>">Orders<?php echo ($order->NotificationChecking()>0?' ('.$order->NotificationChecking().')':'');?></li></a>
		<a href="product.php"><li class="<?php echo ($current_page == "product"?'active':'');?>">Products</li></a>
		<a href="analytics.php"><li class="<?php echo ($current_page == "analytics"?'active':'');?>">Analytics</li></a>
		<a href="setting.php"><li class="right <?php echo ($current_page == "setting"?'active':'');?>">Setting</li></a>
	</ul>
</nav>