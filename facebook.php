<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\GraphObject;
use Facebook\GraphUser;

// use Facebook\FacebookSDKException;
// use Facebook\FacebookAuthorizationException;

// Facebook Login Process API (ver 2.1)
if(!MEMBER_ONLINE){
	// Initialize application by Application ID and Secret
	FacebookSession::setDefaultApplication(APP_ID,APP_SECRET);
	// Login Healper with reditect URI
	$helper = new FacebookRedirectLoginHelper('http://'.$_SERVER['SERVER_NAME'].'/dotdotdot/index.php');

	try{
		$session = $helper->getSessionFromRedirect();
	}
	catch(FacebookRequestException $ex ) {
		// Exception
	}
	catch( Exception $ex ) {
		// When validation fails or other local issues
	}

	// Checking Session
	if(isset($session)){
  		$user_profile 		= (new FacebookRequest($session,'GET','/me'))->execute()->getGraphObject(GraphUser::className());

  		// Create New or Update Member info
		// $me->Register(array(
		// 	'facebook_id' 	=> $user_profile->getProperty('id'),
		// 	'email' 		=> $user_profile->getProperty('email'),
		// 	'birthday' 		=> $user_profile->getProperty('birthday'),
		// 	'about' 		=> $user_profile->getProperty('bio'),
		// 	'name' 			=> $user_profile->getProperty('name'),
		// 	'fname' 		=> $user_profile->getProperty('first_name'),
		// 	'lname' 		=> $user_profile->getProperty('last_name'),
		// 	'link' 			=> $user_profile->getProperty('link'),
		// 	'verified' 		=> $user_profile->getProperty('verified'),
		// 	'gender' 		=> $user_profile->getProperty('gender'),
		// ));

		$member_id = $user->RegisterUser(array(
			'email' 	=> $user_profile->getProperty('email'),
			'phone' 	=> '',
			'name' 		=> '',
			'fb_id' 	=> $user_profile->getProperty('id'),
			'fb_name' 	=> $user_profile->getProperty('name'),
			'password' 	=> '',
			'type' 		=> 'member',
			'status' 	=> 'active',
		));

		// Set session
		$_SESSION['member_id'] = $member_id;
		// Set Cookie (1 year)
		setcookie('member_id',$member_id, COOKIE_TIME);

		// Redirect page after Login.
		header('Location: index.php');
	}
	else{
		// Login URL if session not found
		$fbLogin = str_replace('&','&amp;',$helper->getLoginUrl(array('email')));
	}
}
?>