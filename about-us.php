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
	<div class="about" id="about">
		<div class="about-image">
			<img src="image/about.jpg" alt="">
		</div>
		<div class="about-content">
			<h2>about us</h2>
			<p>dotdotdot company limited, founded in 2004, by m.l. apichit vudhijaya [art], is a 'creative marketingcentre' that founded a niche agency, offering brand and product enhancement. the venture</p><br>
			<p>was established to harness the skills art learnt in a variety of management roles that spanned the hotel, television, advertising, telecommunications,film, retail, creative and design management industries.</p><br>
			<p>"i set up the company, admittedly with a bit of an attitude" says art. "i believe that small local companies can be just as good as multi-national agencies, if not better, if they really put their mind to it."</p><br>
			<p>"apart from that, i just hold three mantras close to my heart: one, 'be the change you wish to see in the world' [mahatma ghandi]; two, 'whatever you are, be a good one' [abraham lincoln]; and three, 'keep things simple... the simpler the better' [the laws of simplicity]."</p>
		</div>
	</div>
</div>
<?php include'footer.php';?>

<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
</body>
</html>