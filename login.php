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

<title>ลงชื่อเข้าใช้</title>

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
		<div class="logo"><i class="fa fa-sign-in"></i>User Login</div>
		<div class="form">
			<div class="caption">Email or Phone Number</div>
			<input type="email" class="input-text" id="username" placeholder="Email address">
			<div class="caption">Password</div>
			<input type="password" class="input-text" id="password" placeholder="">

			<p class="forget"><a href="forget.php">Forget Password!</a></p>

			<div class="status" id="status-message"></div>

			<button class="button-submit" onclick="javascript:LoginUser();"><span id="login-status">Sign In</span></button>
			<div class="mini-caption">or</div>
			<a href="<?php echo $fbLogin;?>"><div class="facebook-button"><i class="fa fa-facebook"></i> Sign In with Facebook</div></a>

			<p class="signup">Need an account? <a href="register.php">Sign Up</a></p>
		</div>
	</div>
</div>


<div class="dialog-box" id="dialog-box">
	<div class="icon" id="dialog-box-icon"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>

</body>
</html>