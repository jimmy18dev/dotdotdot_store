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

<title>New Password</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/user.service.js"></script>

</head>

<body>
<div class="login-dialog">
	<div class="login-container">
		<div class="logo">Change Password</div>
		<div class="form">
			<div class="caption">กำหนดรหัสผ่านใหม่</div>
			<input type="hidden" id="email" value="<?php echo $_GET['email'];?>">
			<input type="hidden" id="forget_code" value="<?php echo $_GET['code'];?>">
			<input type="text" class="input-text" id="password" placeholder="Password...">

			<button class="button-submit" onclick="javascript:NewPassword();"><span id="login-status">ตั้งรหัสผ่านใหม่</span></button>

			<div class="option">
				<a href="login.php">เข้าระบบ</a>
				 · <a href="register.php">สมัครสมาชิก</a>
				 · <a href="index.php">หน้าหลัก</a>
			</div>
		</div>
	</div>
</div>

<div class="dialog-box" id="dialog-box">
	<div class="icon" id="dialog-box-icon"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>
</body>
</html>