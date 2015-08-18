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

<title>Product Create</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>
<script type="text/javascript" src="js/product-form.js"></script>

</head>
<?php include'header.php';?>

<body>
	<h1>Create New Product</h1>
	<hr>
	<form id="ProductCreate" action="product.process.php" method="post" enctype="multipart/form-data">
		<input type="file" class="input-file" id="post_files" name="image_file" accept="image/*"><br>
		<input type="text" name="title" placeholder="title">
		<input type="text" name="description" placeholder="description">
		<input type="text" name="material" placeholder="material" value="normal">
		<input type="text" name="size_d" placeholder="size d" value="0">
		<input type="text" name="size_ss" placeholder="size ss" value="0">
		<input type="text" name="size_s" placeholder="size s" value="0">
		<input type="text" name="size_m" placeholder="size m" value="0">
		<input type="text" name="size_l" placeholder="size l" value="0">
		<input type="text" name="size_xl" placeholder="size xl" value="0">
		<input type="text" name="price" placeholder="price" value="0">
		<input type="text" name="group" placeholder="group" value="shrit"><br>
		<button type="submit">Create</button>
	</form>
</body>
</html>