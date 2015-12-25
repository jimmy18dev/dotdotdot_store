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

// PHPMailer include
require_once'plugin/mailer/PHPMailerAutoload.php';

// Database (PDO class) ///////////////
include_once'model/database.class.php';

// Mobile Detect is a lightweight PHP
include_once'plugin/mobile-detect/mobile_detect.php';
include_once'plugin/mobile-detect/desktop_detect.php';

// Site Setting include /////////////
// Model ////////////////////////////
include_once'model/config.model.php';
include_once'model/product.model.php';
include_once'model/image.model.php';
include_once'model/user.model.php';
include_once'model/order.model.php';
include_once'model/bank.model.php';
	
// Controller ///////////////////////
include_once'controller/config.controller.php';
include_once'controller/product.controller.php';
include_once'controller/image.controller.php';
include_once'controller/user.controller.php';
include_once'controller/api.controller.php';
include_once'controller/order.controller.php';
include_once'controller/bank.controller.php';

// Object of Controller
$config 		= new ConfigController;
$detect 		= new Mobile_Detect;
$product 		= new ProductController;
$image 			= new ImageController;
$user 			= new UserController;
$api 			= new APIController;
$order 			= new OrderController;
$bank 			= new BankController;

// Set Config data
$config->GetConfig();

// Metatag setup
$metadata = array(
	'title' 		=> $config->meta_title,
	'description' 	=> $config->meta_description,
	'image' 		=> '/image/logo.png',
	'type' 			=> 'website',
	'site_name' 	=> $config->meta_sitename,
	'fb_app_id' 	=> '218590748331719',
	'fb_admins' 	=> '1818320188',
	'author' 		=> $config->meta_author,
	'generator' 	=> 'iGenGoods 1.0',
	'keywords' 		=> $config->meta_keyword,
	'domain' 		=> 'http://'.$_SERVER['SERVER_NAME'],
);

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
$size = array(
	'thumbnail' => 150,
	'mini' 		=> 400,
	'square' 	=> 800,
	'normal' 	=> 700,
	'large' 	=> 1600,
);

// Photo Quality
$quality = array(
	'thumbnail' => 100,
	'mini' 		=> 90,
	'square' 	=> 80,
	'normal' 	=> 70,
	'large' 	=> 65,
);

// Facebook App Setting
define("APP_ID" 		,$config->facebook_app_id);
define("APP_SECRET" 	,$config->facebook_app_secret);

// Device access detact process
include'device.access.php';

// Device define data
define('DEVICE_TYPE',		$deviceType);
define('DEVICE_MODEL',		$deviceModel);
define('DEVICE_OS', 		$deviceOS);
define('DEVICE_BROWSER',	$deviceBrowser);

// Email Config (Mailer)
$mail 			= new PHPMailer;
$mail->isSMTP();
$mail->Host 	= $config->email_host;
$mail->SMTPAuth = true;
$mail->Username = $config->email_username;
$mail->Password = $config->email_password;
$mail->Port 	= $config->email_port;
$mail->setFrom($config->email_address,$config->email_name);
$mail->isHTML(true);
$mail->CharSet 	= 'UTF-8';

// Cookie Checking
if($user->CookieChecking()){
	$_SESSION['member_id'] = $_COOKIE['member_id'];
}	

// Member online checking
define('PRIVETE_KEY','dinsorsee');
define('MEMBER_ONLINE',$user->SessionMemberOnline());

// Get member info
if(MEMBER_ONLINE){
	$user->GetUser(array('member_id' => $_SESSION['member_id']));

	if(!empty($user->current_order_id)){
		$order->GetOrder(array('order_id' => $user->current_order_id));
	}
}

// Define member data
define('MEMBER_ID',			$user->id);
define('MEMBER_TOKEN',		$user->token);
define('MEMBER_TYPE',		$user->type);

// Order Expire Checking
$order->CheckingOrder();
?>