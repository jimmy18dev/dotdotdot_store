<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "product";
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

<title>รายการสินค้า</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="container">
	<div class="topic">
		<div class="topic-caption">สินค้า</div>

		<a href="product_editor.php">
		<div class="button">เพิ่มสินค้าใหม่</div>
		</a>
	</div>

	<div class="content">
		<div class="product-topic-caption">
			<div class="product-topic-caption-img">รูปภาพ</div>
			<div class="product-topic-caption-title">รายการ</div>
			<div class="product-topic-caption-quantity">จำนวน</div>
		</div>
		<?php $product->ListProduct(array('null' => 0));?>
	</div>
</div>
</body>
</html>