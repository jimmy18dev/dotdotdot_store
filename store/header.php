<header class="header">
	<div class="logo">Administrator.</div>
	<div class="account">
		<div class="avatar">
			<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">
		</div>
	</div>
</header>
<navigator class="navigator">
	<ul>
		<a href="index.php"><li class="<?php echo ($current_page == "order"?'active':'');?>"><i class="fa fa-list"></i>Orders</li></a>
		<a href="product.php"><li class="<?php echo ($current_page == "product"?'active':'');?>"><i class="fa fa-database"></i>Products</li></a>
		<a href="analytics.php"><li class="<?php echo ($current_page == "analytics"?'active':'');?>"><i class="fa fa-line-chart"></i>Analytics</li></a>
		<a href="../" target="_blank"><li class="right"><i class="fa fa-share"></i>Go to site</li></a>
	</ul>
</navigator>