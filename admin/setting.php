<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "setting";
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

</head>

<body>
<?php include'header.php';?>
<div class="list-container">
		<div class="form-container">
			<h3>Metadata</h3>
			<?php $config->ListConfig('meta');?>
			<button class="save-btn" onclick="javascript:MetaConfigSave();">บันทึก</button>
			<div class="save-state" id="meta-save-state"><i class="fa fa-check"></i>บันทึกแล้ว</div>
		</div>

		<div class="form-container">
			<h3>Facebook SDK</h3>
			<?php $config->ListConfig('facebook_sdk');?>
			<button class="save-btn" onclick="javascript:FacebookConfigSave();">บันทึก</button>
			<div class="save-state" id="facebook-sdk-save-state"><i class="fa fa-check"></i>บันทึกแล้ว</div>
		</div>

		<div class="form-container">
			<h3>ตั้งค่าอีเมล</h3>
			<?php $config->ListConfig('email');?>
			<button class="save-btn" onclick="javascript:EmailConfigSave();">บันทึก</button>
			<div class="save-state" id="email-save-state"><i class="fa fa-check"></i>บันทึกแล้ว</div>
		</div>
</div>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/config.service.js"></script>
</body>
</html>