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
<meta property="og:description" content="<?php echo strip_tags($page_description);?>"/>
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
	<div class="container-pages">
		<!-- Detail -->
		<div class="panel-fix">
			<div class="page-link">
				<a href="store.php" class="back-link"><i class="fa fa-arrow-left"></i>ดูสินค้าอื่น</a>
				<?php if(!empty($product->category_id)){?>
				<a href="store.php?filter=<?php echo $product->category_id;?>" class="category-link"><?php echo $product->category_title;?></a>
				<?php }?>
			</div>

			<h1><?php echo $product->title;?></h1>
			<div class="price">
				<span class="price-val"><?php echo number_format($product->price,2);?> ฿.</span>
				<span class="sharing">
					<span class="sharing-items" id="pinterest-sharing-btn"><i class="fa fa-pinterest-p"></i></span>
					<span class="sharing-items" id="twitter-sharing-btn"><i class="fa fa-twitter"></i></span>
					<span class="sharing-items" id="facebook-sharing-btn"><i class="fa fa-facebook"></i></span>
				</span>
			</div>
			<div class="description"><?php echo nl2br($product->description);?>
				<?php if($user->type == "administrator"){?>
				 – <a href="store/product_editor.php?id=<?php echo $product->id;?>" class="edit-btn">แก้ไข<i class="fa fa-angle-right"></i></a>
				 <?php }?>				
			</div>
			<?php if($product->category_title == 'T-SHIRT'){?>
			<div class="sizeinfo">
				<h4>มาตรฐานไซส์เสื้อที่ทางร้านใช้</h4>
				<div class="row row-topic">
					<div class="col">Size</div>
					<div class="col">SS</div>
					<div class="col">S</div>
					<div class="col">M</div>
					<div class="col">L</div>
					<div class="col">XL</div>
				</div>
				<div class="row">
					<div class="col">ยาว</div>
					<div class="col">24</div>
					<div class="col">25</div>
					<div class="col">26</div>
					<div class="col">27</div>
					<div class="col">28</div>
				</div>
				<div class="row">
					<div class="col">รอบอก</div>
					<div class="col">32</div>
					<div class="col">34</div>
					<div class="col">36</div>
					<div class="col">38</div>
					<div class="col">40</div>
				</div>
				<div class="row">
					<div class="col">แขน</div>
					<div class="col">-</div>
					<div class="col">22</div>
					<div class="col">23</div>
					<div class="col">24</div>
					<div class="col">25</div>
				</div>
			</div>
			<?php }?>
			
			<div class="action">
				<?php
				if($product->type == "normal"){
					if(MEMBER_ONLINE){
						if(empty($product->in_order))
							$button_msg = 'ใส่ตะกร้า<i class="fa fa-cart-plus"></i>';
						else
							$button_msg = 'ชำระเงินตอนนี้<i class="fa fa-arrow-right"></i>';

						if($product->quantity > 0){?>
							<div class="buy-btn animated <?php echo (!empty($product->in_order)?'buy-btn-active':'');?>" id="buy-button" onclick="javascript:AddCart()"><?php echo $button_msg;?></div>
						<?php }else{?>
						<div class="buy-btn buy-btn-disable">สินค้าหมด!</div>
						<?php }?>
					<?php }else{?>
						<a href="register.php?product=<?php echo $product->id;?>" class="buy-btn">สั่งซื้อสินค้า<i class="fa fa-shopping-cart"></i></a>
					<?php }?>
					<div class="more">อีก <?php echo $product->read;?> คน กำลังสนใจสินค้าชิ้นนี้...</div>
				<?php
				// END Product type "normal"
				}else{?>
					<div class="mini-caption">เลือกสินค้า <i class="fa fa-caret-down"></i></div>
					<div class="subproduct-list">
						<select id="subproduct_id" class="input-select">
							<?php $product->ListSubProduct(array('product_id' => $product->id,'order_id' => $user->current_order_id));?>
						</select>
					</div>
					<?php if(MEMBER_ONLINE){?>
						<div class="buy-btn animated <?php echo (!empty($product->in_order)?'buy-btn-active':'');?>" id="buy-button" onclick="javascript:AddCart()">ใส่ตะกร้า<i class="fa fa-cart-plus"></i></div>
					<?php }else{?>
						<a href="login.php?product=<?php echo $product->id;?>" class="buy-btn">สั่งซื้อสินค้า<i class="fa fa-shopping-cart"></i></a>
					<?php }?>
				<?php }?>
			</div>

			<?php if($user->type == "administrator"){?>
			<div class="control">
				<a href="store/product_detail.php?id=<?php echo $product->id;?>">คลังสินค้า<i class="fa fa-angle-right"></i></a>
			</div>
			<?php }?>
		</div>

		<!-- Photo -->
		<div class="panel">
			<?php if(empty($product->image_filename)){?>
			<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/image/no-image.jpg" alt="image not avalable">
			<?php }else{?>
			<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/image/upload/square/<?php echo $product->image_filename;?>" alt="<?php echo $page_title;?>">
			<?php }?>
			<?php $product->ListSubPhoto(array('product_id' => $product->id,'page_title' => $page_title));?>
		</div>

		<!-- Product ID -->
		<input type="hidden" id="product_id" value="<?php echo $product->id;?>">
		<input type="hidden" id="product_type" value="<?php echo $product->type;?>">

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
<script type="text/javascript" src="js/min/init.min.js"></script>

</body>
</html>