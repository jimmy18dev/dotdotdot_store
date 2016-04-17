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

<?php include'favicon.php';?>

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
<div class="list-container">
	<a href="customer.php" class="setting-items"><i class="fa fa-users"></i>สมาชิก/ลูกค้า<i class="fa fa-angle-right"></i></a>
	<a href="bank.php" class="setting-items"><i class="fa fa-university"></i>บัญชีธนาคาร<i class="fa fa-angle-right"></i></a>
	<a href="analytics.php" class="setting-items"><i class="fa fa-area-chart"></i>วิเคราะห์<i class="fa fa-angle-right"></i></a>
	<a href="version-log.php" class="setting-items"><i class="fa fa-flag"></i>อัพเดท<i class="fa fa-angle-right"></i></a>
</div>
</body>
</html>