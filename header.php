<header class="header <?php echo ($current_page == "order" || $current_page == "profile"?"header-fix":"");?>">
	<div class="header-items logo">
		<a href="index.php">dotdotdot limited <div class="mini">Born and made in thailand</div>
		</a>
	</div>

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

	<?php if($user->type == "administrator" && ($current_page == "index" || $current_page == "product")){?>
	<a href="/store">
	<div class="header-items admin-btn">
		<i class="fa fa-cogs"></i>
	</div>
	</a>
	<?php }?>

	<a href="order-<?php echo $user->current_order_id;?>.html#product-list">
	<div class="header-items cart animated" id="my-cart" title="สินค้า <?php echo $user->current_order_amount;?> ชิ้น <?php echo $user->current_order_total;?> รายการ">
		<?php if($current_page != "order"){?>
		<i class="fa fa-shopping-cart <?php echo ($order->payments > 0?'animated infinite pulse':'');?>"></i>
		<?php if($user->current_order_payments > 0){?>
		<span class="payments"><span id="payments"><?php echo number_format($user->current_order_payments);?> ฿</span></span>
		<?php }else{?>
		<span class="payments"><span id="payments">ตะกร้า</span></span>
		<?php }?>
		<?php }?>
	</div>
	</a>
	<?php }else{?>
	<a href="login.php">
	<div class="header-items login"><i class="fa fa-shopping-cart"></i>เข้าสู่ระบบ</div>
	</a>
	<?php }?>
</header>