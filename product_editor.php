<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(isset($_GET['id'])){
	$product->GetProduct(array('product_id' => $_GET['id']));
}
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

		<p>id</p>
		<input type="text" name="product_id" value="<?php echo $product->id;?>">

		<p>title</p>
		<input type="text" name="title" placeholder="title" value="<?php echo $product->title;?>">

		<p>description</p>
		<input type="text" name="description" placeholder="description" value="<?php echo $product->description;?>">
		<p>material</p>
		<input type="text" name="material" placeholder="material" value="normal" value="<?php echo $product->material;?>">

		<br><br><p>Size</p>
		<p>D</p>
		<input type="text" name="size_d" placeholder="size d" value="<?php echo (isset($product->size_d)?$product->size_d:0);?>">
		<p>SS</p>
		<input type="text" name="size_ss" placeholder="size ss" value="<?php echo (isset($product->size_ss)?$product->size_ss:0);?>">
		<p>S</p>
		<input type="text" name="size_s" placeholder="size s" value="<?php echo (isset($product->size_s)?$product->size_s:0);?>">
		<p>M</p>
		<input type="text" name="size_m" placeholder="size m" value="<?php echo (isset($product->size_m)?$product->size_m:0);?>">
		<p>L</p>
		<input type="text" name="size_l" placeholder="size l" value="<?php echo (isset($product->size_l)?$product->size_l:0);?>">
		<p>XL</p>
		<input type="text" name="size_xl" placeholder="size xl" value="<?php echo (isset($product->size_xl)?$product->size_xl:0);?>">

		<p>price</p>
		<input type="text" name="price" placeholder="price" value="0">
		<input type="text" name="group" placeholder="group" value="shrit"><br>
		<br><br>
		<button type="submit"><?php echo (isset($product->id)?'Save':'Create')?></button>
	</form>
</body>
</html>