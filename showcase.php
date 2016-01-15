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
	<div class="head-bar">
		<h1>dotdotdot showcase</h1>
		<p>NATION is your blood. don't forget,don't blame,don't sale. be grateful to your land.</p>
	</div>

	<div class="showcase">
		<div class="showcase-items">
			<div class="showcase-items-image">
				<img src="http://dotdotdot.local/image/upload/square/73ffd29685ff1e83eaa988c3072619c5.jpg" alt="">
			</div>
			<div class="showcase-items-content"><i class="fa fa-caret-left"></i>Notebook Stamp Foiled ขนาด A5 ปกแข็งไม่มีเส้น เราออกแบบด้วยความรักและความคิดสร้างสรรค์ เราหวังว่าทุกท่านจะเข้าใจในสิ่งที่เราอยากจะสื่อออกไป</div>
		</div>
		<div class="showcase-items">
			<div class="showcase-items-image">
				<img src="http://dotdotdot.local/image/upload/square/1e56c72d7fe38225aad3c17eae2a5667.png" alt="">
			</div>
			<div class="showcase-items-content"><i class="fa fa-caret-left"></i>Notebook Stamp Foiled ขนาด A5</div>
		</div>
		<div class="showcase-items">
			<div class="showcase-items-image">
				<img src="http://dotdotdot.local/image/upload/square/e6f5b37d95e5642f52266a211c6fd270.png" alt="">
			</div>
			<div class="showcase-items-content"><i class="fa fa-caret-left"></i>ทุกวันนี้เราเครียดกันเกินไปรึเปล่า เคยย้อนถามตัวเองหรือไม่ เรามีสินค้าที่จะช่วยคุณเตือนความจำไว้เสมอว่า "ไม่เครียด"</div>
		</div>
	</div>
</div>
<?php include'footer.php';?>

<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
</body>
</html>