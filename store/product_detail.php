<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

$product->GetProduct(array('product_id' => $_GET['id']));
?>

<!DOCTYPE html>
<html lang="th" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">	

<?php
//include'favicon.php';
?>

<title>Product Detail</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/product.service.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="container">
	<div class="topic">
		<div class="topic-caption">รหัสสินค้า <?php echo $product->id;?></div>
	</div>
	<div class="content content-container">
		<div class="navi">
			<a href="">ข้อมูลสินค้า</a>
			<a href="">ประวัติการขาย</a>
			<a href="">ประวัตการนำเข้าส่งออก</a>
			<a href="">แกไข</a>
		</div>

		<div class="detail">
			<header class="info">
				<h1><?php echo $product->title;?></h1>
				<p>ราคา <?php echo $product->price;?> บาท  · เริ่มขาย <?php echo $product->create_time;?></p>
			</header>
			<div class="image">
				<img src="../image/upload/square/<?php echo $product->image_filename;?>" alt="">
			</div>
			<div class="imageset">
				<?php $product->ListPhotoProduct(array('product_id' => $product->id));?>
			</div>
			<div class="description"><?php echo $product->description;?></div>

			<!-- Subproduct -->
			<div class="subproduct">
				<?php $product->ListSubProduct(array('product_id' => $product->id,'render' => 'subproduct-items'));?>
			</div>

			<div class="stat">
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->view);?><span class="unit">ครั้ง</span></div>
					<div class="caption">แสดงสินค้า</div>
				</div>
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->read);?><span class="unit">ครั้ง</span></div>
					<div class="caption">สนใจสินค้า</div>
				</div>
				<div class="stat-items">
					<div class="value <?php echo ($product->interest_ratio>80?'green':'');?>"><?php echo number_format($product->interest_ratio);?><span class="unit">%</span></div>
					<div class="caption">ความน่าสนใจ</div>
				</div>
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->total_in_order);?><span class="unit">ชิ้น</span></div>
					<div class="caption">สั่งซื้อสินค้า</div>
				</div>
			</div>

			<div class="history">
				<div class="history-topic">Seller</div>
			</div>

			<div class="history">
				<div class="history-topic">Import / Export</div>
				<?php $product->HistoryProduct(array('product_id' => $product->id));?>
			</div>

			<!-- Product control -->
			<div class="control">
				<!-- <div class="control-items delete" onclick="javascript:DeleteProduct(<?php echo $product->id;?>);">ลบ</div> -->

				<a href="quantity.php?id=<?php echo $product->id;?>&action=import"><div class="control-items">เติม</div></a>
				<a href="quantity.php?id=<?php echo $product->id;?>&action=export"><div class="control-items">โอน</div></a>
				<a href="product_editor.php?id=<?php echo $product->id;?>"><div class="control-items">แก้ไข</div></a>
				<a href="product_editor.php?parent=<?php echo $product->id;?>"><div class="control-items">สินค้าย่อย</div></a>
			</div>
		</div>

		<a href="">ลบสินค้า</a>
	</div>
</div>

</body>
</html>