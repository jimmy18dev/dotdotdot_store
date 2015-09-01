<?php

	define("DB_HOST", "localhost");
	define("DB_USER", "admin");
	define("DB_PASS", "1234");
	define("DB_NAME", "dotdotdot_store");

	// Photo Upload config ///////////////////////
	// Photo desctination folder /////////////////
	$destination_folder = array(
		'thumbnail' => 'image/upload/thumbnail/',
		'mini' 		=> 'image/upload/mini/',
		'square' 	=> 'image/upload/square/',
		'normal' 	=> 'image/upload/normal/',
		'large' 	=> 'image/upload/large/',
	);

	// Photo upload resize ///////////////////////
	$photo_size = array(
		'thumbnail' => 400,
		'mini' 		=> 400,
		'square' 	=> 800,
		'normal' 	=> 800,
		'large' 	=> 1600,
	);

	// Photo Quality
	$photo_quality = array(
		'thumbnail' => 65,
		'mini' 		=> 65,
		'square' 	=> 65,
		'normal' 	=> 65,
		'large' 	=> 65,
	);

	// Photo Quality /////////////////////////////
	$jpeg_quality = 65;
	// *******************************************************

	// Facebook App Setting
	// define("APP_ID", 		"218590748331719");
	// define("APP_SECRET",	"d422f1972741a31b74691304889079ff");

	// Cookie Time (1 year)
	define('COOKIE_TIME', time() + 3600 * 24 * 12);

?>