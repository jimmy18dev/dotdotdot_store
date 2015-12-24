<header class="header <?php echo ($current_page == "index" || $current_page == "product"?"header-fix":"");?>">
	<a href="index.php" class="header-items logo">dotdotdot limited <div class="mini">Born and made in thailand</div>
		</a>

	<?php if(MEMBER_ONLINE){?>
	<a href="profile.php">
	<div class="header-items avatar <?php echo ($current_page == 'profile'?'avatar-active':'');?>">
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

	<a href="order-<?php echo $user->current_order_id;?>.html#product-list" target="_parent" class="header-items cart <?php echo ($current_page == 'order'?'cart-active':'');?> animated" id="my-cart" title="สินค้า <?php echo $user->current_order_amount;?> ชิ้น <?php echo $user->current_order_total;?> รายการ">
		<span class="icon">
		<i class="fa fa-shopping-cart <?php echo ($order->payments > 0?'animated infinite pulse':'');?>"></i>
		</span>
		<?php if($user->current_order_payments > 0){?>
		<span class="payments"><span id="payments"><?php echo number_format($user->current_order_payments,2);?> ฿</span></span>
		<?php }else{?>
		<span class="payments"><span id="payments">ตะกร้า</span></span>
		<?php }?>
	</a>
	<?php }else{?>
	<?php if($current_page != 'login'){?>
	<a href="login.php" class="header-items login"><span class="icon"><i class="fa fa-shopping-cart"></i></span>เข้าสู่ระบบ</a>
	<?php }?>
	<?php }?>
</header>