<h1><a href="index.php">dotdotdot store</a></h1>
<hr>

<?php if(MEMBER_ONLINE){?>
<p><a href="me.php"><?php echo $user->name;?></a> <a href="logout.php">[Logout]</a></p>
<p>สินค้า <span id="amount">0</span> ชิ้น รวมราคา <span id="payments">0.00</span> บาท</p>
<?php }else{?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<?php }?>
<hr>
<a href="/store" target="_blank">[store]</a>
<hr>