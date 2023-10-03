<?php
$include_path = dirname(__FILE__);
require_once $include_path."/include/config.inc.php";
require_once $include_path."/include/class_captchatest.php";
require_once $include_path."/include/class_captcha.php";

if (isset($_GET['time'])) {
	$timestamp = intval($_GET['time']);
	$captcha = new CaptchaTest;
	$captcha->secretCode .= $POLLDB['pass'];
	if ($captcha->isValidTime($timestamp)) {
		$img = new SimpleCaptcha();
		reset($img->supportedImagesTypes);
		$imageType = key($img->supportedImagesTypes);	
		$img->setText($captcha->getKey($timestamp));			
		$img->setBackgroundColors(array("EEEEEE", "F2F3D3", "F5EAEA", "E4F3EE", "EEE4F3", "FFE6E6"));
		$img->setTextColors(array("000000", "FD130A", "0A1BFD", "149703", "486C66", "870DC3", "D78406", "105243"));
		$img->getImage($imageType);
		exit();
	}			
}

SimpleCaptcha::createPixel();

?>