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
<script type="text/javascript" src="js/service/order.service.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="content">
	<div class="product">
		<!-- Photo -->
		<div class="product-photos">
			<img src="store/<?php echo $product->image_normal;?>" alt="">
			<img src="image/site/2.jpg" alt="">
			<img src="image/site/1.jpg" alt="">
			<img src="image/site/3.jpg" alt="">
			<img src="image/site/4.jpg" alt="">
			<img src="image/site/1.jpg" alt="">
		</div>

		<!-- Detail -->
		<div class="product-details">
			<h1><?php echo $product->title;?></h1>
			<p class="code">รหัสสินค้า #<?php echo $product->id;?></p>
			<p><?php echo $product->price;?></p>
			<div class="description"><?php echo $product->description;?></div>

			<div class="action">
				<div class="action-items">
					<div class="caption">เบอร์ S (21x30)</div>
					<div class="buy">
						<div class="buy-button">390.00 ฿</div>
					</div>
				</div>
				<div class="action-items">
					<div class="caption">เบอร์ M (21x30)</div>
					<div class="buy">
						<div class="buy-button">390.00 ฿</div>
					</div>
				</div>
				<div class="action-items">
					<div class="caption">เบอร์ L (21x30)</div>
					<div class="buy">
						<div class="buy-button">390.00 ฿</div>
					</div>
				</div>
				<div class="action-items">
					<div class="caption">เบอร์ XL (21x30)</div>
					<div class="buy">
						<div class="buy-button">390.00 ฿</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="picture">
			<div class="picture-items">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/4.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/4.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/4.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/4.jpg" alt="">
			</div>
		</div> -->
	</div>
</div>
<label for="">จำนวน <input type="number" id="amount" value="1"></label>
<button onclick="javascript:AddItemToOrder(<?php echo $product->id;?>);">ซื้อเลย <?php echo $product->price;?> บาท</button>

<?php
include'footer.php';
?>

</body>
</html>