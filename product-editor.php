<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

$product->GetProduct(array(
	'product_id' => $_GET['id'],
	'order_id' => $user->current_order_id,
));

$product->UpdateView(array('product_id' => $product->id));
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
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/service/product.service.js"></script>
<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/product.app.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="content">
	<div class="product">
		<!-- Photo -->
		<div class="product-photos">
			<div class="cover-input">
				<div class="icon"><i class="fa fa-camera"></i> เลือกภาพ</div>
			</div>
		</div>

		<!-- Detail -->
		<div class="product-details">
			<div class="product-title">
				<input type="text" class="input-name" placeholder="Product name...">
			</div>
			<p class="code">
				<?php echo number_format($product->read);?> คนดูสินค้านี้ <span class="price"><?php echo number_format($product->price,2);?> ฿</span>
			</p>
			<div class="description">
				<textarea class="input-textarea" placeholder="Product description..."></textarea>
			</div>

			<div class="action">
				<p class="topic">สั่งซื้อสินค้า <?php echo 'InOrder: '.$product->in_order;?></p>
				<?php
				if($product->type == "normal"){
					if(empty($product->in_order)){
						$button_msg = 'Buy';
						$button_price = number_format($product->price,2).' ฿';
					}
					else{
						$button_msg = '<i class="fa fa-check"></i>';
						$button_price = 'Checkout';
					}
				?>
				<div class="action-items">
					<div class="detail">
						<div class="caption">รหัสสินค้า #<?php echo $product->id;?></div>
						<div class="desc">หยิบสินค้าใส่ตระกร้า</div>
					</div>
					<div class="buy-button" onclick="javascript:AddItemToOrder(<?php echo $product->id;?>)">
						<p id="buy-button-msg-<?php echo $product->id;?>" class="animated"><?php echo $button_msg;?></p>
						<p id="buy-button-price-<?php echo $product->id;?>" class="msg"><?php echo $button_price;?></p>
					</div>
				</div>
				<?php }else{
					$product->ListSubProduct(array(
						'product_id' => $product->id,
						'order_id' => $user->current_order_id,
					));
				}?>
			</div>
		</div>

		<!-- Product ID -->
		<input type="hidden" id="product_id" value="<?php echo $product->id;?>">
	</div>
</div>
<?php
include'footer.php';
?>

</body>
</html>