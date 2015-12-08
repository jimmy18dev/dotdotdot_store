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
		<?php if($current_page == "product_editor"){?>
			<?php if(!empty($_GET['parent'])){?>
			<a href="product_detail.php?id=<?php echo $_GET['parent'];?>">
				<li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มสินค้าย่อย</span></li>
			</a>
			<?php }else if(!empty($_GET['id'])){?>
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>">
				<li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">แก้ไขสินค้า</span></li>
			</a>
			<?php }else{?>
			<a href="product.php">
				<li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มสินค้าใหม่</span></li>
			</a>
			<?php }?>
		<?php }else if($current_page == "bank_editor"){?>
			<?php if(empty($bank->id)){?>
			<a href="bank.php"><li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">เพิ่มบัญชีธนาคารใหม่</span></li></a>
			<?php }else{?>
			<a href="bank.php"><li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">แก้ไขบัญชีธนาคาร</span></li></a>
			<?php }?>
		<?php }else if($current_page == "product_quantity"){?>
			<?php if($_GET['action'] == "import"){?>
			<a href="product.php"><li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">นำเข้าสินค้า</span></li></a>
			<?php }else if($_GET['action'] == "export"){?>
			<a href="product.php"><li><span class="icon"><i class="fa fa-arrow-left"></i></span><span class="caption">โอนสินค้าออก</span></li></a>
			<?php }?>
		<?php }else{?>
		<a href="product.php"><li class="<?php echo ($current_page == "product"?'active':'');?>">
			<span class="icon"><i class="fa fa-th"></i></span><span class="caption">สินค้า</span></li>
		</a>
		<a href="analytics.php"><li class="<?php echo ($current_page == "analytics"?'active':'');?>">
			<span class="icon"><i class="fa fa-area-chart"></i></span><span class="caption">วิเคราะห์</span></li>
		</a>
		<a href="more.php"><li class="<?php echo ($current_page == "more"?'active':'');?>">
			<span class="icon"><i class="fa fa-ellipsis-h"></i></span><span class="caption">เพิ่มเติม</span></li>
		</a>
		<a href="../"><li class="right"><span class="icon"><i class="fa fa-television"></i></span><span class="caption">หน้าร้าน</span></li></a>
		<?php }?>
	</ul>
</nav>