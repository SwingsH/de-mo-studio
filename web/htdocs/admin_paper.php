<?
require_once('admin_smtp.php');

$board_config['smtp_host'] = "webmail.usc.edu.tw" ;
$board_config['smtp_username'] = "a9228126" ;
$board_config['smtp_password'] = "9669";

	if ($_REQUEST['email']) {
	$adminemail[1] = "demo.tw@gmail.com" ;  
	$msg2 = "Email： ".$_REQUEST['email'];
	@smtpmail("demopaper.tw@gmail.com", $_REQUEST['email'], $msg2);
	echo "  謝謝您訂閱DEMO電子報！";
	} else {
	include('admin_mail/express1.php');
	}
	echo ' <SCRIPT language="javascript"> window.location = "index.php" </script>' ;
?>