<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

$product->GetProduct(array(
	'product_id' => $_GET['id'],
	'order_id' => $user->current_order_id,
));

$product->UpdateView(array('product_id' => $product->id));
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

<?php include'favicon.php';?>

<?php
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
<script type="text/javascript" src="js/lib/numeral.min.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="container">
	<div class="container-page">
		<!-- Detail -->
		<div class="panel-fix">
			<h1><?php echo $product->title;?></h1>
			<div class="action">
				<?php
				if($product->type == "normal"){
					if(empty($product->in_order)){
						$button_msg = 'ซื้อสินค้า';
					}
					else{
						$button_msg = 'จ่ายเงิน<i class="fa fa-arrow-right"></i>';
					}
				?>
				<div class="action-items">
					<div class="detail">
						<h3><span class="price">฿<?php echo number_format($product->price,2);?></span></h3>
						<p>อีก <?php echo $product->read;?> คน กำลังสนใจสินค้าชิ้นนี้...</p>
					</div>
					<div class="buy">
						<?php if($product->quantity > 0){?>
						<div class="buy-btn animated <?php echo (!empty($product->in_order)?'buy-btn-active':'');?>" id="buy-button-<?php echo $product->id;?>" onclick="javascript:AddItemToOrder(<?php echo $product->id;?>)"><?php echo $button_msg;?></div>
						<?php }else{?>
						<div class="buy-btn buy-btn-disable">สินค้าหมด!</div>
						<?php }?>
					</div>
				</div>
				<?php }else{
					$product->ListSubProduct(array(
						'product_id' 	=> $product->id,
						'order_id' 		=> $user->current_order_id,
					));
				}?>
			</div>

			<div class="description"><?php echo $product->description;?></div>

			<p class="info">
				<?php if($product->type == "normal" && $product->quantity == 0){?>
				<span class="view alert">สินค้าหมดชั่วคราวค่ะ!</span>
				<?php }else if($product->quantity > 5 || $product->type == "root"){?>
				<span class="view">แสดงสินค้าแล้ว <?php echo number_format($product->read);?> ครั้ง</span>
				<?php }else{?>
				<span class="view">มีเพียง <?php echo $product->quantity;?> ชิ้นเท่านั้น</span>
				<?php }?>

				<span class="sharing" id="pinterest-sharing-btn"><i class="fa fa-pinterest-p"></i></span>
				<span class="sharing" id="twitter-sharing-btn"><i class="fa fa-twitter"></i></span>
				<span class="sharing" id="facebook-sharing-btn"><i class="fa fa-facebook"></i></span>
			</p>

			<?php if($user->type == "administrator"){?>
			<div class="control">
				<a href="store/product_detail.php?id=<?php echo $product->id;?>"><i class="fa fa-th"></i>ดูคลังสินค้า</a>
			</div>
			<?php }?>
		</div>

		<!-- Photo -->
		<div class="panel">
			<?php if(empty($product->image_filename)){?>
			<img src="image/no-image.jpg" alt="">
			<?php }else{?>
			<img src="image/upload/square/<?php echo $product->image_filename;?>" alt="">
			<?php }?>
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

<div id="loading-status"><i class="fa fa-circle"></i></div>

<script type="text/javascript" src="js/service/min/product.service.min.js"></script>
<script type="text/javascript" src="js/service/min/order.service.min.js"></script>
<script type="text/javascript" src="js/min/product.app.min.js"></script>
<script type="text/javascript" src="js/min/sharing.app.min.js"></script>

</body>
</html>