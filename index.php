<?php
require_once'config/autoload.php';
$current_page = "index";
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

<title><?php echo $metadata['title'];?></title>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $metadata['description'];?>"/>
<meta property="og:title" content="<?php echo $metadata['title'];?>"/>
<meta property="og:description" content="<?php echo $metadata['description'];?>"/>
<meta property="og:url" content="<?php echo $metadata['domain'];?>"/>
<meta property="og:image" content="<?php echo $metadata['domain'].$metadata['image'];?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo $metadata['site_name'];?>"/>
<meta property="fb:app_id" content="<?php echo $metadata['fb_app_id'];?>"/>
<meta property="fb:admins" content="<?php echo $metadata['fb_admins'];?>"/>

<meta name="author" content="<?php echo $metadata['author'];?>">
<meta name="generator" content="<?php echo $metadata['generator'];?>"/>

<meta itemprop="name" content="<?php echo $metadata['title'];?>">
<meta itemprop="description" content="<?php echo $metadata['description'];?>">
<meta itemprop="image" content="<?php echo $metadata['domain'].$metadata['image'];?>">

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
	<?php if($user->status == "pending"){?>
	<!-- Email Verify Alert -->
	<div class="email-alert"><i class="fa fa-exclamation-circle"></i> กรุณายืนยันอีเมลของคุณด้วยค่ะ</div>
	<?php }?>

	<?php if($order->OrderProgressCounting(array('member_id' => $user->id)) > 0 && MEMBER_ONLINE){?>
	<div class="order-in-progress">
		<div class="mini-caption">ใบสั่งซื้อของคุณ</div>
		<?php $order->OrderProgress(array('member_id' => $user->id));?>
	</div>
	<?php }?>

	<div class="banner-cover">
		<a href="store.php">
			<img src="image/banner.png" alt="">
		</a>

		<p><a href="store.php" class="shop-btn">SHOP NOW<i class="fa fa-shopping-cart"></i></a></p>
	</div>

	<div class="quote">
		<h1>Good morning , have a good day.</h1>
		<p>dotdotdot company limited, founded in 2004, by m.l. apichit vudhijaya [art],<br>
		is a 'creative marketingcentre' that founded a niche agency, offering brand and product enhancement. the venture</p>
		<p class="link">
			<a href="about-us.php">about us</a> 
			<a href="store.php?filter=5">showcase</a> 
			<a href="contact-us.php">contact us</a> 
			<a href="https://www.facebook.com/messages/dotdotdotlimited">live chat <i class="fa fa-comment-o"></i></a>
		</p>
	</div>

	<div class="category" id="category">
		<h2 class="topic">SHOP BY CATEGORY</h2>
		<div>
			<?php $category->ListCategory(array('mode' => 'index'));?>
		</div>
	</div>

	<div class="container-page bestseller" id="bestseller">
		<h2 class="topic">BEST SELLER</h2>
		<div>
			<?php $product->ListProductBestSeller(array('order_id' => $user->current_order_id));?>
		</div>
	</div>
</div>
<?php include'footer.php';?>

<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
</body>
</html>