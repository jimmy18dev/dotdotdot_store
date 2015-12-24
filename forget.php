<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "forget";
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

<title>กู้คืนรหัสผ่าน</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="login-dialog">
	<div class="login-container">
		<div class="form">
			<div class="caption">อีเมล:</div>
			<input type="text" class="input-text" id="email" placeholder="กรอกอีเมลของคุณ" autofocus>

			<div class="status" id="status-message"></div>

			<button class="button-submit" onclick="javascript:ForgetPassword();"><span id="login-status"><i class="fa fa-arrow-right"></i>ตกลง</span></button>

			<p class="signup">ฉันเคยสมัครสมาชิกแล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
		</div>
	</div>
</div>

<?php include'template/loading.dialog.box.php';?>

<script type="text/javascript" src="js/service/min/user.service.min.js"></script>
</body>
</html>