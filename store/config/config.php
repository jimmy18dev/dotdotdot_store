<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "igensit2_demo");
	define("DB_PASS", "dinsorsee");
	define("DB_NAME", "igensit2_demo");

	// define("DB_USER", "admin");
	// define("DB_PASS", "1234");
	// define("DB_NAME", "dotdotdot_store");

	// Email Config
	$email_settig = array(
		'host' 			=> 'igensite.com',
		'username' 		=> 'igensit2',
		'password' 		=> 'Q09uuH1jp8',
		'port' 			=> 25,
		'email_address' => 'igensit2@igensite.com',
		'email_name' 	=> 'IGensite Email',
	);

	// Metatag setup
	$metadata = array(
		'title' 		=> 'dotdotdot limited',
		'description' 	=> 'จำหน่ายสินค้าจาก Designer ของ dotdotdot limited',
		'image' 		=> '/image/logo.png',
		'type' 			=> 'website',
		'site_name' 	=> 'dotdotdot limited',
		'fb_app_id' 	=> '218590748331719',
		'fb_admins' 	=> '1818320188',
		'author' 		=> 'DotDotDot่',
		'generator' 	=> 'IGengoods 1.0',
		'keywords' 		=> '่',
		'domain' 		=> 'http://'.$_SERVER['SERVER_NAME'],
	);

	// Photo Upload config ///////////////////////
	// Photo desctination folder /////////////////
	$destination_folder = array(
		'thumbnail' => '../image/upload/thumbnail/',
		'mini' 		=> '../image/upload/mini/',
		'square' 	=> '../image/upload/square/',
		'normal' 	=> '../image/upload/normal/',
		'large' 	=> '../image/upload/large/',
	);

	// Photo upload resize ///////////////////////
	$size = array(
		'thumbnail' => 150,
		'mini' 		=> 400,
		'square' 	=> 500,
		'normal' 	=> 700,
		'large' 	=> 1200,
	);

	// Photo Quality
	$quality = array(
		'thumbnail' => 65,
		'mini' 		=> 65,
		'square' 	=> 65,
		'normal' 	=> 65,
		'large' 	=> 65,
	);

	// Facebook App Setting
	// define("APP_ID", 		"218590748331719");
	// define("APP_SECRET",	"d422f1972741a31b74691304889079ff");

	// Cookie Time (1 year)
	define('COOKIE_TIME', time() + 3600 * 24 * 12);

?>