<header class="header <?php echo ($current_page == "order" || $current_page == "profile"?"header-fix":"");?>">
	<div class="header-items logo"><a href="index.php">dotdotdot limited<span class="beta"></span></a></div>

	<?php if(MEMBER_ONLINE){?>
	<a href="profile.php">
	<div class="header-items avatar">
		<?php if(empty($user->facebook_id)){?>
		<img src="image/avatar.png" alt="">
		<?php }else{?>
		<img src="https://graph.facebook.com/<?php echo $user->facebook_id;?>/picture?type=square" alt="">
		<?php }?>

		<?php if($user->notification_count > 0){?>
		<div class="notifications">
			<i class="fa fa-circle"></i>
		</div>
		<?php }?>
	</div>
	</a>

	<a href="order-<?php echo $user->current_order_id;?>.html#product">
	<div class="header-items cart animated" id="my-cart" title="สินค้า <?php echo $user->current_order_amount;?> ชิ้น <?php echo $user->current_order_total;?> รายการ">
		<?php if($current_page != "order"){?>
		<i class="fa fa-shopping-cart <?php echo ($order->payments > 0?'animated infinite pulse':'');?>"></i><span class="payments"><span id="payments"><?php echo number_format($user->current_order_payments);?> ฿</span></span>
		<?php }?>
	</div>
	</a>
	<?php }else{?>
	<a href="login.php">
	<div class="header-items login"><i class="fa fa-user"></i>เข้าสู่ระบบ</div>
	</a>
	<?php }?>
</header>