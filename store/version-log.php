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

<?php
//include'favicon.php';
?>

<title>Version Change Log</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="container versionlog">
	<h1>Version Change Log</h1>
	<h2>Your Current version 2.3</h2>
	<p>[ ! ] IMPORTANT: As of v3.3.0, You must visit /admin after upgrading, front end will be temporarily closed now after updates/installs until update/install is completed</p>

	<section>
		<h3>Version 3.3.7 <span class="date">(2015-08-23)</span></h3>
		<p><span class="new">NEW</span> #1077 upload protection breaks on apache 1.3</p>
		<p><span class="fix">FIX</span> #1074 Stored XSS in the USER profile SECURITY</p>
		<p><span class="fix">FIX</span> #1071 disabled select text color</p>
		<p><span class="fix">FIX</span> #1067 Persistant/Stored XSS while creating page and also in backups SECURITY</p>
		<p><span class="fix">FIX</span> #1065 uploadifybutton not themed</p>
	</section>

	<section>
		<h3>Version 3.3.7 <span class="date">(2015-08-23)</span></h3>
		<p class="warning">WARNING DO NOT INSTALL IF ON APACHE 1.3, fixed in 3.3.7</p>
		<p><span class="fix">FIX</span> #1077 upload protection breaks on apache 1.3</p>
		<p><span class="new">NEW</span> #1074 Stored XSS in the USER profile SECURITY</p>
		<p><span class="new">NEW</span> #1071 disabled select text color</p>
		<p><span class="fix">FIX</span> #1067 Persistant/Stored XSS while creating page and also in backups SECURITY</p>
		<p><span class="fix">FIX</span> #1065 uploadifybutton not themed</p>
	</section>

	<section>
		<h3>Version 3.3.7 <span class="date">(2015-08-23)</span></h3>
		<p><span class="fix">FIX</span> #1077 upload protection breaks on apache 1.3</p>
		<p><span class="fix">FIX</span> #1074 Stored XSS in the USER profile SECURITY</p>
		<p><span class="fix">FIX</span> #1071 disabled select text color</p>
		<p><span class="fix">FIX</span> #1067 Persistant/Stored XSS while creating page and also in backups SECURITY</p>
		<p><span class="fix">FIX</span> #1065 uploadifybutton not themed</p>
	</section>
</div>
</body>
</html>