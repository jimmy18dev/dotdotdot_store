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

<?php
//include'favicon.php';
?>

<title>Homepage</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/user.service.js"></script>

</head>

<body>
<div class="content">
	<div class="login-dialog">
		<div class="logo">dotdotdot limited</div>

		<div class="form">
			<div class="caption">Email or Phone Number</div>
			<input type="text" id="username" placeholder="Email of Phone number">
			<div class="caption">Password</div>
			<input type="text" id="password" placeholder="Password">

			<button onclick="javascript:LoginUser();">Login</button>
			<div class="status" id="login-status">logining...</div>
			<div class="facebook-button"></div>
		</div>

		<div class="option">
			<div class="option-items">สมัครสมาชิก</div>
			<div class="option-items">ลืมรหัสผ่าน</div>
		</div>
	</div>
</div>
</body>
</html>