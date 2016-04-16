<?php
$notif_count = $order->NotificationChecking();
?>

<header class="header">
	<a href="index.php" class="header-items logo"><i class="fa fa-cube" aria-hidden="true"></i>Store</a>
	<a href="index.php" class="header-items orders"><?php echo $notif_count;?> รายการใหม่ <i class="fa fa-angle-right"></i></a>
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
				<li class="navi-items <?php echo ($current_page == "order"?'active':'');?>">สั่งซื้อ</li>
			</a>
			<a href="product.php">
				<li class="navi-items <?php echo ($current_page == "product"?'active':'');?>">สินค้า</li>
			</a>
			<a href="setting.php">
				<li class="navi-items <?php echo ($current_page == "setting"?'active':'');?>">ตั้งค่า</li>
			</a>
			<!-- <a href="analytics.php">
				<li class="navi-items <?php echo ($current_page == "analytics"?'active':'');?>"><span class="icon"><i class="fa fa-area-chart"></i></span><span class="caption">วิเคราะห์</span></li>
			</a> -->
			<!-- <a href="customer.php">
				<li class="navi-items <?php echo ($current_page == "customer"?'active':'');?>"><span class="icon"><i class="fa fa-user"></i></span><span class="caption">ลูกค้า</span></li>
			</a> -->
			<a href="../">
				<li class="navi-items ">หน้าร้าน</li>
			</a>

			<a href="more.php">
				<li class="navi-items right <?php echo ($current_page == "more"?'active':'');?>">เพิ่มเติม</li>
			</a>
		<?php }?>
	</ul>
</nav>