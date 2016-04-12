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

<title>Order</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/';?>/admin/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/';?>/admin/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/';?>/admin/plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>

<div class="container">
	<div class="error-page">
		<p class="icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>
		<h1>ไม่สามารถเข้าลิ้งที่คุณต้องการได้!</h1>
		<p>คุณจำเป็นต้องเข้าระบบก่อน เพื่อนยืนยันตัวตนว่าคุณเป็น Administrator ของเว็บจริง</p>
		<br><br>
		<p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/';?>/login.php">เข้าระบบ<i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
	</div>
</div>
</body>
</html>