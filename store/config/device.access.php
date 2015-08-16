<?php
	// Mobile Detect
	$deviceType 	= 'n/a';
	$deviceModel 	= 'n/a';
	$deviceOS 		= 'n/a';
	$deviceBrowser 	= 'n/a';

	// Device Type
	if($detect->isTablet())
		$deviceType = 'Tablet';
	else if($detect->isMobile())
		$deviceType = 'Mobile';
	else
		$deviceType = 'Desktop';

	// Device OS
	if($detect->isiOS())
		$deviceOS = 'iOS';
	else if($detect->isAndroidOS())
		$deviceOS = 'Android';
	else if($detect->isWindowsPhoneOS())
		$deviceOS = 'WindowsPhone';
	else
		$deviceOS = $desktop->os;

	// Device Browser
	if($detect->isChrome())
		$deviceBrowser = 'Chrome';
	else if($detect->isDolfin())
		$deviceBrowser = 'Dolfin';
	else if($detect->isOpera())
		$deviceBrowser = 'Opera';
	else if($detect->isSkyfire())
		$deviceBrowser = 'Skyfire';
	else if($detect->isIE())
		$deviceBrowser = 'IE';
	else if($detect->isFirefox())
		$deviceBrowser = 'Firefox';
	else if($detect->isBolt())
		$deviceBrowser = 'Bolt';
	else if($detect->isTeaShark())
		$deviceBrowser = 'TeaShark';
	else if($detect->isBlazer())
		$deviceBrowser = 'Blazer';
	else if($detect->isSafari())
		$deviceBrowser = 'Safari';
	else if($detect->isTizen())
		$deviceBrowser = 'Tizen';
	else if($detect->isUCBrowser())
		$deviceBrowser = 'UCBrowser';
	else if($detect->isbaiduboxapp())
		$deviceBrowser = 'baiduboxapp';
	else if($detect->isbaidubrowser())
		$deviceBrowser = 'baidubrowser';
	else if($detect->isDiigoBrowser())
		$deviceBrowser = 'DiigoBrowser';
	else if($detect->isPuffin())
		$deviceBrowser = 'Puffin';
	else if($detect->isMercury())
		$deviceBrowser = 'Mercury';
	else if($detect->isObigoBrowser())
		$deviceBrowser = 'ObigoBrowser';
	else if($detect->isNetFront())
		$deviceBrowser = 'NetFront';
	else if($detect->isGenericBrowser())
		$deviceBrowser = 'GenericBrowser';
	else
		$deviceBrowser = $desktop->browser;


	// Device Model
	// Mobile type
	if($detect->isiPhone())
		$deviceModel = 'iPhone';
	else if($detect->isBlackBerry())
		$deviceModel = 'BlackBerry';
	else if($detect->isHTC())
		$deviceModel = 'HTC';
	else if($detect->isDell())
		$deviceModel = 'Dell';
	else if($detect->isMotorola())
		$deviceModel = 'Motorlora';
	else if($detect->isSamsung())
		$deviceModel = 'Samsung';
	else if($detect->isLG())
		$deviceModel = 'LG';
	else if($detect->isSony())
		$deviceModel = 'Sony';
	else if($detect->isAsus())
		$deviceModel = 'Asus';

	// Tablet type
	else if($detect->isiPad())
		$deviceModel = 'iPad';
	else if($detect->isNexusTablet())
		$deviceModel = 'NexusTablet';
	else if($detect->isSamsungTablet())
		$deviceModel = 'SamsungTablet';
	else if($detect->isKindle())
		$deviceModel = 'Kindle';
	else if($detect->isSurfaceTablet())
		$deviceModel = 'SurfaceTablet';
	else if($detect->isHPTablet())
		$deviceModel = 'HPTablet';
	else if($detect->isAsusTablet())
		$deviceModel = 'AsusTablet';
	else if($detect->isBlackBerryTablet())
		$deviceModel = 'BlackBerryTablet';
	else if($detect->isHTCtablet())
		$deviceModel = 'HTCtablet';
	else if($detect->isMotorolaTablet())
		$deviceModel = 'MotorolaTablet';
	else if($detect->isAcerTablet())
		$deviceModel = 'AcerTablet';
	else if($detect->isToshibaTablet())
		$deviceModel = 'ToshibaTablet';
	else if($detect->isLGTablet())
		$deviceModel = 'LGTablet';
	else if($detect->isFujitsuTablet())
		$deviceModel = 'FujitsuTablet';
	else if($detect->isLenovoTablet())
		$deviceModel = 'LenovoTablet';
	else if($detect->isDellTablet())
		$deviceModel = 'DellTablet';
	else if($detect->isSonyTablet())
		$deviceModel = 'SonyTablet';
	else if($detect->isPhilipsTablet())
		$deviceModel = 'PhilipsTablet';
	else if($detect->isHuaweiTablet())
		$deviceModel = 'HuaweiTablet';
	else if($detect->isiMobileTablet())
		$deviceModel = 'iMobileTablet';
	else if($detect->isGenericTablet())
		$deviceModel = 'GenericTablet';

	else{
		$deviceModel = 'n/a';
	}
?>