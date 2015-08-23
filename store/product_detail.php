<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

$product->GetProduct(array('product_id' => $_GET['id']));
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

<title>Product Detail</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/product.service.js"></script>

</head>

<body>

<?php include'header.php';?>

<img src="<?php echo $product->image_normal;?>" alt="">

<h1><?php echo $product->title;?></h1>

<p><?php echo $product->description;?></p>
<p>Size D : <?php echo $product->size_d;?></p>
<p>Size SS : <?php echo $product->size_ss;?></p>
<p>Size S : <?php echo $product->size_s;?></p>
<p>Size M : <?php echo $product->size_m;?></p>
<p>Size L : <?php echo $product->size_l;?></p>
<p>Size XL : <?php echo $product->size_lx;?></p>

<b>Price: <?php echo $product->price;?></b>

<hr>
<h3>สินค้า</h3>
<a href="product_add.php">เติม</a>
<a href="">โอนของ</a>
<a href="product_editor.php?id=<?php echo $product->id;?>">แก้ไข</a>
<a href="javascript:DeleteProduct(<?php echo $product->id;?>);">[ลบสินค้า]</a>

</body>
</html>