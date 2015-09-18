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
<script type="text/javascript" src="js/service/order.service.js"></script>

</head>

<body>

<?php include'header.php';?>

<div class="content">
	<div class="product-detail">
		<h1>เสื้อ Thailand Not For Sale.</h1>

		<div class="thumbnail">
			<img src="image/site/1.jpg" alt="">
		</div>

		<div class="description">
			การคัดเลือกบุคคลเข้าทำงานในบริษัท  องค์กร  หน่วยงาน  เป็นเรื่องสำคัญ  และจำเป็นที่จะต้องได้คนที่มีความรู้ความสามารถตรงกับงาน  ผู้ที่จะทำการคัดเลือกบุคคลเข้าทำงานจึงต้องมีความรู้ในเบื้องต้นก่อนว่า  บุคคลที่จะทำงานในตำแหน่งงานที่กำหนดนั้น  จะต้องมีคุณสมบัติเบื้องต้นอะไรบ้าง  และจะต้องมีคุณสมบัติอื่นอะไรอีก  นอกจากนี้จะต้องมีคุณลักษณะ  ความรู้  ความสามารถ  อะไรต่อมา

	โดยทั่วไป  การคัดเลือกบุคคลเข้าทำงานมักจะกำหนดคุณวุฒิทางการศึกษาก่อน  เช่น  สำเร็จการศึกษาระดับใด  หรือสำเร็จการศึกษาในด้านใด  หลังจากนั้นจึงจะกำหนดคุณสมบัติและคุณลักษณะเพิ่มเติม  แล้วจึงประกาศรับสมัครเพื่อทำการคัดเลือกต่อไป
		</div>

		<div class="action">
			<div class="action-items">
				<div class="caption">เบอร์ S (21x30)</div>
				<div class="buy">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
			<div class="action-items">
				<div class="caption">เบอร์ M (21x30)</div>
				<div class="buy">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
			<div class="action-items">
				<div class="caption">เบอร์ L (21x30)</div>
				<div class="buy">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
			<div class="action-items">
				<div class="caption">เบอร์ XL (21x30)</div>
				<div class="buy">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
		</div>

		<div class="picture">
			<div class="picture-items">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="picture-items">
				<img src="image/site/4.jpg" alt="">
			</div>
		</div>
	</div>
</div>

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
<hr>
<label for="">จำนวน <input type="number" id="amount" value="1"></label>
<button onclick="javascript:AddItemToOrder(<?php echo $product->id;?>);">ซื้อเลย <?php echo $product->price;?> บาท</button>

<?php
include'footer.php';
?>

</body>
</html>