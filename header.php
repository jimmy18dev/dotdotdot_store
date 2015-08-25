<h1><a href="index.php">dotdotdot store</a></h1>
<hr>

<?php if(MEMBER_ONLINE){?>
<p><a href="me.php"><?php echo $user->name;?></a> <a href="logout.php">[Logout]</a></p>
<?php }else{?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<?php }?>
<hr>