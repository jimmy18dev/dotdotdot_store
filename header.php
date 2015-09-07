<h1><a href="index.php">dotdotdot store</a></h1>
<hr>

<?php if(MEMBER_ONLINE){?>
<p><a href="me.php"><?php echo $user->name;?></a> <a href="logout.php">[Logout]</a></p>

<?php if(empty($order->id)){?>
<p>เลือกสินค้าที่คุณต้องการ</p>
<?php }else{?>
<p><a href="order_detail.php?id=<?php echo $order->id;?>">สินค้า <span id="amount"><?php echo $order->amount;?></span> ชิ้น รวมราคา <span id="payments"><?php echo $order->payments;?></span> บาท</a></p>
<?php }?>

<?php }else{?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<?php }?>
<hr>
<a href="/store" target="_blank">[store]</a>
<hr>