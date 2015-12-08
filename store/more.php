<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "more";
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

<title>Setting</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="container">
	<div class="content">
		<a href="customer.php">
		<div class="setting-btn">
			<div class="setting-btn-icon"><i class="fa fa-users"></i></div>
			<div class="setting-btn-caption">ลูกค้า</div>
		</div>
		</a>

		<a href="bank.php">
		<div class="setting-btn">
			<div class="setting-btn-icon"><i class="fa fa-university"></i></div>
			<div class="setting-btn-caption">บัญชีธนาคาร</div>
		</div>
		</a>

		<div class="setting-btn">
			<div class="setting-btn-icon"><i class="fa fa-cog"></i></div>
			<div class="setting-btn-caption">ตั้งค่า</div>
		</div>

		<a href="version-log.php">
		<div class="setting-btn">
			<div class="setting-btn-icon"><i class="fa fa-flag"></i></div>
			<div class="setting-btn-caption">อัพเดท</div>
		</div>
		</a>
	</div>
</div>
</body>
</html>