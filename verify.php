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

</head>

<body>
<div class="dialog-box dialog-box-show">
	<div class="icon" id="dialog-box-icon">
		<?php if($verified){?>
		<i class="fa fa-check-circle-o"></i>
		<p>ยืนยันอีเมล <?php echo $_GET['email'];?> เรียบร้อยแล้ว</p>
		<?php }else{?>
		<i class="fa fa-exclamation-circle"></i>
		<p>ยืนยันอีเมลไม่สำเร็จ กรุณาเลือกอีกครั้งค่ะ</p>
		<?php }?>
	</div>
</div>

<script type="text/javascript">
setTimeout(function(){window.location = 'login.php';},3000);
</script>

</body>
</html>