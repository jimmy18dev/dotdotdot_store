<?php
	define("DB_HOST", "localhost");
	// IGENSITE Hosing
	define("DB_USER", "igensit2_demo");
	define("DB_PASS", "dinsorsee");
	define("DB_NAME", "igensit2_demo");

	//Localhost
	// define("DB_USER", "admin");
	// define("DB_PASS", "1234");
	// define("DB_NAME", "dotdotdot_store");

	// dotdotdot Hosing
	// define("DB_USER", "dotdotdo_store");
	// define("DB_PASS", "ntq78TZf83B9");
	// define("DB_NAME", "dotdotdo_store");

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
		'thumbnail' => 200,
		'mini' 		=> 500,
		'square' 	=> 900,
		'normal' 	=> 900,
		'large' 	=> 1200,
	);

	// Photo Quality
	$quality = array(
		'thumbnail' => 70,
		'mini' 		=> 80,
		'square' 	=> 90,
		'normal' 	=> 100,
		'large' 	=> 80,
	);

	// Facebook App Setting
	// define("APP_ID", 		"218590748331719");
	// define("APP_SECRET",	"d422f1972741a31b74691304889079ff");

	// Cookie Time (1 year)
	define('COOKIE_TIME', time() + 3600 * 24 * 12);

?>