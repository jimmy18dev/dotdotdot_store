<h1><a href="index.php">dotdotdot store</a></h1>
<hr>

<?php if(MEMBER_ONLINE){?>
<p><?php echo $user->name;?></p>
<a href="logout.php">[Logout]</a>
<?php }else{?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<?php }?>
<hr>