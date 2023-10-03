<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>無標題文件</title>
<style type="text/css">
<!--
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 13px; }
-->
</style>
</head>

<body >
<table width="808" border="0" align="left">
  <tr align="center">
    <td height="32" colspan="3" valign="top"></a><img src="template/images/contact.gif" width="730" height="40"></td>
  </tr>
  <tr>
    <td width="17" height="726">&nbsp;</td>
    <td width="753" align="left" valign="top"><p><?
//----------------------------------------
// 程式名稱：童言無忌郵件快遞 V1.0 繁體版
// 繁體製作：童言無忌資訊網
// 下載網址：http://cheng-hui.dslcity.net
// 最後修改：2004/05/20
//----------------------------------------

require_once('admin_smtp.php');

$board_config['smtp_host'] = "webmail.usc.edu.tw" ;
$board_config['smtp_username'] = "a9228126" ;
$board_config['smtp_password'] = "9669";

	//include('admin_mail/header.php');



	if ($_REQUEST['name']) {

	$adminemail[1] = "demo.tw@gmail.com" ;             //更改您要填寫的地址
	$adminemail[2] = "demo.tw@gmail.com ";      //更改您要填寫的地址
	$adminemail[3] = "demo.tw@gmail.com ";        //更改您要填寫的地址
	$adminemail[4] = "demo.tw@gmail.com" ; 

	$msg2 = "
		姓名： ".$_REQUEST['name'].
		"Email： ".$_REQUEST['email'].
		//"公司： ".$_REQUEST['company'].
		"電話： ".$_REQUEST['phone'].
		//"網站： ".$_REQUEST['website'].
		"內容： ".$_REQUEST['msg'];

	//@smtpmail("a9228126@webmail.usc.edu.tw", $_REQUEST['subject'], $msg2);
	@smtpmail($adminemail[ $_REQUEST['who'] ], $_REQUEST['subject'], $msg2);
	//smtpmail("", $subject, $message, $headers = '') ;
	//mail("$adminemail[$who]", "[郵件快遞]： $subject", "$msg2", "From: $email \nReply-To: $email");
	echo " 非常感謝您，我們會儘快回覆您的！";

	} else {


	include('admin_mail/express.php');


	}


	//include('admin_mail/footer.php');

?>
</p>
    </td>
    <td width="29">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
