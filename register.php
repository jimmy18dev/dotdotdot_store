<?php
require_once'config/autoload.php';
include'sdk/facebook-sdk/autoload.php';
include'facebook.php';
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

<title>สมัครสมาชิก</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/min/user.service.min.js"></script>

</head>

<body>
<div class="login-dialog">
	<div class="login-container">
		<div class="logo"><i class="fa fa-user-plus"></i>Register</div>
		<div class="form">

			<div class="caption">Email</div>
			<input type="text" class="input-text" id="email" placeholder="Enter your email">

			<!-- <div class="caption">Phone Number</div>
			<input type="text" class="input-text" id="phone" placeholder="Phone number"> -->

			<div class="caption">Name</div>
			<input type="text" class="input-text" id="name" placeholder="Enter your name">

			<!-- <p>Facebook Name</p> -->
			<input type="hidden" class="input-text" id="fb_name" placeholder="Facebook name">

			<div class="caption">Password</div>
			<input type="password" class="input-text" id="password" placeholder="Minimum 6 characters">

			<div class="status" id="status-message"></div>

			<button class="button-submit" onclick="javascript:RegisterUser();"><span id="login-status">Sign Up</span></button>
			<div class="mini-caption">or</div>
			<a href="<?php echo $fbLogin;?>"><div class="facebook-button"><i class="fa fa-facebook"></i> Sign Up with Facebook</div></a>

			<p class="signup">I have account? <a href="login.php">Sign In</a></p>
		</div>
	</div>
</div>

<div class="dialog-box" id="dialog-box">
	<div class="icon" id="dialog-box-icon"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>
</body>
</html>