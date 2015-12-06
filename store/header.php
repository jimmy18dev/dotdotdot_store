<header class="header">
	<div class="menu">
		<a href="index.php"><div class="btn">รายการสั่งซื้อ<span class="notif"><?php echo $order->NotificationChecking();?></span></div></a>
	</div>

	<div class="logo"><a href="index.php">Administrator</a></div>

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
		<a href="product.php"><li class="<?php echo ($current_page == "product"?'active':'');?>">
			<span class="icon"><i class="fa fa-th"></i></span><span class="caption">สินค้า</span></li>
		</a>
		<a href="analytics.php"><li class="<?php echo ($current_page == "analytics"?'active':'');?>">
			<span class="icon"><i class="fa fa-area-chart"></i></span><span class="caption">วิเคราะห์</span></li>
		</a>
		<a href="setting.php"><li class="<?php echo ($current_page == "setting"?'active':'');?>">
			<span class="icon"><i class="fa fa-cog"></i></span><span class="caption">ตั้งค่า</span></li>
		</a>
		<a href="more.php"><li class="<?php echo ($current_page == "more"?'active':'');?>">
			<span class="icon"><i class="fa fa-ellipsis-h"></i></span><span class="caption">เพิ่มเติม</span></li>
		</a>
		<a href="../"><li class="right"><span class="icon"><i class="fa fa-television"></i></span><span class="caption">หน้าร้าน</span></li></a>
	</ul>
</nav>