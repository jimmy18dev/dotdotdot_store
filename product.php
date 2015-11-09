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
// include'favicon.php';
$page_title = $product->title.' - '.$metadata['title'];
$page_description = $product->description;
$page_url = $metadata['domain'].'/product-'.$product->id.'.html';
$page_image = $metadata['domain'].'/image/upload/square/'.$product->image_filename;;
?>

<title><?php echo $page_title;?></title>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $page_description;?>"/>
<meta property="og:title" content="<?php echo $page_title;?>"/>
<meta property="og:description" content="<?php echo $page_description;?>"/>
<meta property="og:url" content="<?php echo $page_url;?>"/>
<meta property="og:image" content="<?php echo $page_image;?>"/>
<meta property="og:type" content="website"/>

<meta property="og:site_name" content="<?php echo $metadata['site_name'];?>"/>
<meta property="fb:app_id" content="<?php echo $metadata['fb_app_id'];?>"/>
<meta property="fb:admins" content="<?php echo $metadata['fb_admins'];?>"/>

<meta name="author" content="<?php echo $metadata['author'];?>">
<meta name="generator" content="<?php echo $metadata['generator'];?>"/>

<meta itemprop="name" content="<?php echo $page_title;?>">
<meta itemprop="description" content="<?php echo $page_description;?>">
<meta itemprop="image" content="<?php echo $page_image;?>">

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
<script type="text/javascript" src="js/sharing.app.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="container">
	<div class="container-page">
		<!-- Detail -->
		<div class="product-details">
			<h1><?php echo $product->title;?></h1>
			<p class="info">
				<?php if($product->quantity > 5){?>
				<span class="view"><?php echo number_format($product->read);?> Views</span>
				<?php }else{?>
				<span class="view"> มีเพียง <?php echo $product->quantity;?> ชิ้นเท่านั้น</span>
				<?php }?>

				<span class="sharing" id="pinterest-sharing-btn"><i class="fa fa-pinterest-p"></i></span>
				<span class="sharing" id="twitter-sharing-btn"><i class="fa fa-twitter"></i></span>
				<span class="sharing" id="facebook-sharing-btn"><i class="fa fa-facebook"></i></span>
			</p>

			<div class="description"><?php echo $product->description;?></div>

			<div class="action">
				<p class="topic">สั่งซื้อสินค้า</p>
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
						<div class="caption">รหัสสินค้า: <?php echo $product->id;?></div>
						<div class="desc">หยิบสินค้าใส่ตระกร้า</div>
					</div>
					<div class="detail-buy-btn" onclick="javascript:AddItemToOrder(<?php echo $product->id;?>)">
						<p id="buy-button-msg-<?php echo $product->id;?>" class="animated"><?php echo $button_msg;?></p>
						<p id="buy-button-price-<?php echo $product->id;?>" class="msg"><?php echo $button_price;?></p>
					</div>
				</div>
				<?php }else{
					$product->ListSubProduct(array(
						'product_id' 	=> $product->id,
						'order_id' 		=> $user->current_order_id,
					));
				}?>
			</div>
		</div>

		<!-- Photo -->
		<div class="product-photos">
			<img src="image/upload/square/<?php echo $product->image_filename;?>" alt="">
			<?php $product->ListSubPhoto(array('product_id' => $product->id));?>
		</div>

		<!-- Product ID -->
		<input type="hidden" id="product_id" value="<?php echo $product->id;?>">

		<!-- Microdata -->
		<input type="hidden" id="microdata-link" value="<?php echo $page_url;?>">
		<input type="hidden" id="microdata-title" value="<?php echo $page_title;?>">
		<input type="hidden" id="microdata-image" value="<?php echo $page_image;?>">
	</div>
</div>
<?php
include'footer.php';
?>

</body>
</html>