<?php
// Autoload include
require_once'config/autoload.php';

unset($_COOKIE['member_id']);
setcookie('member_id','');
unset($_SESSION['member_id']);
session_destroy();

header("Location: index.php");
die();
?>