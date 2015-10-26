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
	<div class="content">
		<div class="detail">
			<header class="info">
				<h1><?php echo $product->title;?></h1>
				<p>ราคา <?php echo $product->price;?> บาท  · เริ่มขาย <?php echo $product->create_time;?></p>
			</header>
			<div class="image">
				<?php $product->ListPhotoProduct(array('product_id' => $product->id));?>
			</div>
			<div class="description"><?php echo $product->description;?></div>

			<!-- Subproduct -->
			<div class="subproduct">
				<?php $product->ListSubProduct(array('product_id' => $product->id,'render' => 'subproduct-items'));?>
			</div>

			<!-- Product control -->
			<div class="control">
				<div class="control-items delete" onclick="javascript:DeleteProduct(<?php echo $product->id;?>);"><i class="fa fa-trash"></i></div>

				<a href="product_add.php"><div class="control-items">เติมสินค้า</div></a>
				<div class="control-items">โอนสินค้า</div>
				<a href="product_editor.php?id=<?php echo $product->id;?>"><div class="control-items">แก้ไข</div></a>
				<a href="product_editor.php?parent=<?php echo $product->id;?>"><div class="control-items">สินค้าย่อย</div></a>
			</div>
		</div>
	</div>
</div>

</body>
</html>