<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
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

<title>New Password</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>

<?php include'header.php';?>
<div class="login-container">
	<div class="form">
		<div class="caption">กำหนดรหัสผ่านใหม่</div>
		<input type="email" class="input-text" id="password" placeholder="Password..." autofocus>
		<input type="hidden" id="email" value="<?php echo $_GET['email'];?>">
		<input type="hidden" id="forget_code" value="<?php echo $_GET['code'];?>">

		<div class="status" id="status-message"></div>
		<button onclick="javascript:NewPassword();" class="button-submit"><span id="login-status">ตั้งรหัสผ่านใหม่</span></button>
	</div>
</div>

<?php include'template/loading.dialog.box.php';?>

<script type="text/javascript" src="js/service/min/user.service.min.js"></script>
</body>
</html>