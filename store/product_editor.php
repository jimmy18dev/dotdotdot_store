<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(isset($_GET['id'])){
	$product->GetProduct(array('product_id' => $_GET['id']));
}
else if(isset($_GET['parent'])){
	$product->GetProduct(array('product_id' => $_GET['parent']));
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
		<input type="text" name="product_id" value="<?php echo (isset($_GET['parent'])?'':$product->id);?>">

		<p>Parent</p>
		<input type="text" name="parent" value="<?php echo (isset($_GET['parent'])?$product->id:'0');?>">

		<p>CODE</p>
		<input type="text" name="code" value="<?php echo $product->code;?>">

		<p>title</p>
		<input type="text" name="title" placeholder="title" value="<?php echo $product->title;?>">

		<p>description</p>
		<input type="text" name="description" placeholder="description" value="<?php echo $product->description;?>">
		<p>UNIT</p>
		<input type="text" name="unit" placeholder="unit" value="normal" value="<?php echo $product->unit;?>">

		<p>price</p>
		<input type="text" name="price" placeholder="price" value="<?php echo (isset($product->price)?$product->price:0);?>">
		<input type="text" name="group" placeholder="group" value="shrit"><br>
		<br><br>
		<button type="submit"><?php echo (isset($product->id)?'Save':'Create')?></button>
	</form>
</body>
</html>