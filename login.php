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

<?php include'favicon.php';?>

<title>ลงชื่อเข้าใช้</title>

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
		<a href="<?php echo $fbLogin;?>"><div class="facebook-button"><i class="fa fa-facebook"></i> เข้าสู่ระบบด้วย Facebook</div></a>
		<div class="mini-caption">หรือ</div>
		<form action="javascript:LoginUser();">
			<div class="caption">อีเมล:</div>
			<input type="email" class="input-text" id="username" placeholder="">
			<div class="caption">รหัสผ่าน:</div>
			<input type="password" class="input-text" id="password" placeholder="">
			<div class="status" id="status-message"></div>
			<button type="submit" class="button-submit"><span id="login-status"><i class="fa fa-arrow-right"></i>เข้าสู่ระบบ</span></button>
		</form>
		<p class="signup">สมัครสมาชิกด้วยอีเมล? <a href="register.php">สมัครสมาชิก</a></p>
		<p class="forget"><a href="forget.php">ฉันลืมรหัสผ่าน!</a></p>
	</div>
</div>

<?php include'template/loading.dialog.box.php';?>

<script type="text/javascript" src="js/service/min/user.service.min.js"></script>
</body>
</html>