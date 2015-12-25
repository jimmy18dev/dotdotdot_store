<?php
$notif_count = $order->NotificationChecking();
?>

<header class="header">
	<div class="menu">
		<a href="index.php"><div class="btn">สั่งซื้อ <?php if($notif_count > 0){?><span class="notif"><?php echo $notif_count;?></span><?php }?></div></a>
	</div>

	<div class="logo"><a href="index.php">Store</a></div>

	<div class="account">
		<div class="avatar">
			<a href="../profile.php">
			<?php if(empty($user->facebook_id)){?>
			<img src="../image/avatar.png" alt="">
			<?php }else{?>
			<img src="https://graph.facebook.com/<?php echo $user->facebook_id;?>/picture?type=square" alt="">
			<?php }?>
			</a>
		</div>
	</div>
</header>
<nav class="navigator">
	<ul>
		<?php if($current_page == "product_editor"){?>
			<?php if(!empty($_GET['parent'])){?>
			<a href="product_detail.php?id=<?php echo $_GET['parent'];?>">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มสินค้าย่อย</span></li>
			</a>
			<?php }else if(!empty($_GET['id'])){?>
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">แก้ไขสินค้า</span></li>
			</a>
			<?php }else{?>
			<a href="product.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มสินค้าใหม่</span></li>
			</a>
			<?php }?>
		<?php }else if($current_page == "bank_editor"){?>
			<?php if(empty($bank->id)){?>
			<a href="bank.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มบัญชีธนาคารใหม่</span></li>
			</a>
			<?php }else{?>
			<a href="bank.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">แก้ไขบัญชีธนาคาร</span></li>
			</a>
			<?php }?>
		<?php }else if($current_page == "product_quantity"){?>
			<?php if($_GET['action'] == "import"){?>
			<a href="product.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">นำเข้าสินค้า</span></li>
			</a>
			<?php }else if($_GET['action'] == "export"){?>
			<a href="product.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">โอนสินค้าออก</span></li>
			</a>
			<?php }?>
		<?php }else if($current_page == "order_detail"){?>
			<a href="index.php">
				<li class="navi-bar"><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">รายการสั่งซื้อที่ <?php echo $order->id;?></span></li>
			</a>
		<?php }else{?>
			<a href="index.php">
				<li class="navi-items <?php echo ($current_page == "order"?'active':'');?>"><span class="icon"><i class="fa fa-comments-o"></i></span><span class="caption">สั่งซื้อ</span></li>
			</a>
			<a href="product.php">
				<li class="navi-items <?php echo ($current_page == "product"?'active':'');?>"><span class="icon"><i class="fa fa-th"></i></span><span class="caption">สินค้า</span></li>
			</a>
			<a href="setting.php">
				<li class="navi-items <?php echo ($current_page == "setting.php"?'active':'');?>"><span class="icon"><i class="fa fa-area-chart"></i></span><span class="caption">ตั้งค่า</span></li>
			</a>
			<a href="analytics.php">
				<li class="navi-items <?php echo ($current_page == "analytics"?'active':'');?>"><span class="icon"><i class="fa fa-area-chart"></i></span><span class="caption">วิเคราะห์</span></li>
			</a>
			<!-- <a href="customer.php">
				<li class="navi-items <?php echo ($current_page == "customer"?'active':'');?>"><span class="icon"><i class="fa fa-user"></i></span><span class="caption">ลูกค้า</span></li>
			</a> -->
			<a href="../">
				<li class="navi-items "><span class="icon"><i class="fa fa-television"></i></span><span class="caption">หน้าร้าน</span></li>
			</a>

			<a href="more.php">
				<li class="navi-items right <?php echo ($current_page == "more"?'active':'');?>"><span class="icon"><i class="fa fa-ellipsis-h"></i></span><span class="caption">เพิ่มเติม</span></li>
			</a>
		<?php }?>
	</ul>
</nav>