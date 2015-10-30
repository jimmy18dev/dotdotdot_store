<header class="header">
	<div class="logo">Administrator.</div>
	<div class="account">
		<div class="avatar">
			<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">
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