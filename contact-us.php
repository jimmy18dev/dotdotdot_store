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
	<div class="contact-us" id="contact-us">
		<div class="contact-us-image">
			<img src="image/map.jpg" alt="">
		</div>
		<div class="contact-us-content">
			<h2>contact us</h2>
			<p>Office:</p>
			<p>Suite 139 Artitra 68 Sukhumvit 26 Klongton, Klongteoy, Bangkok 10110</p>
			<p>Phone: 02-2616588</p>
			<p>Fax: 02-2616589</p>
		</div>
	</div>

	<div class="google-map" id="map">
		<h2>dotdotdot company limited in google map <i class="fa fa-map-o"></i></h2>
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15503.639777259452!2d100.5692872!3d13.7239018!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b48444336b3a26c!2z4Lin4Li04Lih4Liy4Lil4LiyIOC4quC4p-C4teC4lw!5e0!3m2!1sth!2sth!4v1452759916290" allowfullscreen></iframe>
	</div>
</div>
<?php include'footer.php';?>

<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
</body>
</html>