<header class="header">
	<div class="header-items logo"><a href="index.php">dotdotdot limited</a></div>

	<?php if(MEMBER_ONLINE){?>
	<a href="me.php">
	<div class="header-items avatar">
		<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xat1/v/t1.0-1/p160x160/11262102_10203354443781334_6934107217499553852_n.jpg?oh=c4cb5727426538443f0aafb2060155e9&oe=566E4F8F&__gda__=1453461472_b6d2f73a017aece7244956f2d898de52" alt="">
	</div>
	</a>

	<a href="order_detail.php?id=<?php echo $user->current_order_id;?>">
	<div class="header-items cart animated" id="my-cart">
		<i class="fa fa-shopping-cart <?php echo ($order->payments > 0?'animated infinite pulse':'');?>"></i><span class="payments">Checkout: <span id="payments"><?php echo number_format($order->payments,2);?> ฿</span></span>
	</div>
	</a>
	<?php }else{?>
	<a href="login.php">
	<div class="header-items login">Login</div>
	</a>
	<?php }?>
</header>