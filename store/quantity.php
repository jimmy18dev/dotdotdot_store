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
		<div class="quantity-form">
			<input type="text" id="quantity" placeholder="quantity...">
			<input type="text" id="product_id" value="<?php echo $_GET['id'];?>">
			<input type="text" id="action" value="<?php echo $_GET['action'];?>">

			<button onclick="javascript:UpdateQuantity();">SAVE</button>
		</div>
	</div>
</div>

</body>
</html>