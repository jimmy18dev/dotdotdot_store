<?php
	//Start Session and Cookie.
	session_start();
	ob_start();

	// Starttime /////////////////////
	define('StTime', microtime(true));

	// Time Zone ////////////////////////////
	date_default_timezone_set('Asia/Bangkok');

	error_reporting(E_ALL ^ E_NOTICE);

	include'config.php';

	// Database (PDO class) ///////////////
	include_once'model/database.class.php';

	// Mobile Detect is a lightweight PHP
	include_once'plugin/mobile-detect/mobile_detect.php';
	include_once'plugin/mobile-detect/desktop_detect.php';

	// Site Setting include /////////////
	// Model ////////////////////////////
	include_once'model/product.model.php';
	include_once'model/image.model.php';

	// Controller ///////////////////////
	include_once'controller/product.controller.php';
	include_once'controller/image.controller.php';
	include_once'controller/api.controller.php';

	// Object of Controller
	$product = new ProductController;
	$image = new ImageController;
	$api = new APIController;
?>