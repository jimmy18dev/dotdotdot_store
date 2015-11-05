<?php
require_once'config/autoload.php';
include'sdk/facebook-sdk/autoload.php';
include'facebook.php';

$verified = $user->Verified(array('email' => $_GET['email'],'verify_code' => $_GET['code']));
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

<title>Email Verify!</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<div class="login-dialog">
	<div class="login-container">
		<div class="logo">dotdotdot limited.</div>
		
		<div class="message-box">
			<div class="icon"><i class="fa fa-check"></i></div>
			<p><?php echo $_GET['email'];?></p>

			<?php if($verified){?>
			<p class="success">ยืนยันอีเมลเรียบร้อยแล้ว</p>
			<?php }else{?>
			<p class="fail">ยืนยันอีเมลไม่สำเร็จ กรุณาเลือกอีกครั้งค่ะ</p>
			<?php }?>
			<p class="waiting">กรุณารอสักครู่...</p>
		</div>
	</div>
</div>

<script type="text/javascript">
setTimeout(function(){window.location = 'login.php';},3000);
</script>

</body>
</html>