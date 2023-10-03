<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

$version = "2.08";

if (!is_file("../install/cross.gif")) {
	$img_loc= "http://www.proxy2.de/poll/install";
} else {
	$img_loc= "../install";
}

$POLLTBL = array();
$POLLDB = array();

if (is_file("../include/config.inc.php")) {
	require_once "../include/config.inc.php";
} else {
	print_header();
	message_box("Configuration file config.inc.php does not exist.");
	exit;
}

if (!isset($POLLTBL["poll_tpl"])) {
	print_header();
	message_box("Template table is not defined.");
	exit;
} else {
	$templateTable = $POLLTBL["poll_tpl"];
}

if (is_file("../include/$POLLDB[class]")) {
	require_once "../include/$POLLDB[class]";
} else {
	print_header();
	message_box("MySQL class class_mysql.php is not available.");
	exit;
}


function print_header() {
global $version;
?>
<html>
<head>
<title>Advanced Poll <?php echo $version; ?> Template Patch</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.td1 {  font-family: "MS Sans Serif"; font-size: 9pt}
-->
</style>
<script language="Javascript">
<!--
function abort() {
 if (window.confirm("Are you sure you want to cancel the Patch?")) {
    window.location.href = "http://"+window.location.host+window.location.pathname+"?action=cancel"
 }
}
// -->
</script>
</head>
<?php
}

function db_config() {
global $_SERVER, $version, $img_loc;
?>
<body bgcolor="#3A6EA5">
<br>
<br>
<table border="1" cellspacing="0" cellpadding="0" align="center" width="500">
  <tr bgcolor="#C6C3C6">
    <td>
      <table width="500" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr bgcolor="#400080">
          <td height="20" class="td1" bgcolor="#000084"><b><font color="#FFFFFF">
            &nbsp;Advanced Poll <?php echo $version; ?> Patch</font></b></td>
          <td height="20" class="td1" align="right" bgcolor="#000084"><img src="<?php echo $img_loc; ?>/cross.gif" width="16" height="14" border="0" usemap="#close"><map name="close"><area shape="rect" coords="1,1,14,12" href="javascript:abort()"></map>
          </td>
        </tr>
        <tr align="center">
          <td colspan="2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr bgcolor="#FFFFFF" valign="bottom">
                  <td class="td1" height="30"><b>&nbsp;&nbsp;&nbsp;&nbsp;Welcome to the Advanced Poll patch script.</b></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td class="td1" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr bgcolor="#C6C3C6">
                  <td class="td1" align="center">
                    <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td class="td1" height="75">Please enter your database settings...</td>
                      </tr>
                      <tr>
                        <td height="140" class="td1">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td width="18%" class="td1">Hostname:</td>
                              <td width="82%">
                                <input type="text" name="mysql_host" size="25" value="localhost">
                              </td>
                            </tr>
                            <tr>
                              <td width="18%" class="td1">Database:</td>
                              <td width="82%">
                                <input type="text" name="db_name" size="25">
                              </td>
                            </tr>
                            <tr>
                              <td width="18%" class="td1">Username:</td>
                              <td width="82%">
                                <input type="text" name="mysql_user" size="25">
                              </td>
                            </tr>
                            <tr>
                              <td width="18%" class="td1">Password:</td>
                              <td width="82%">
                                <input type="password" name="mysql_pass" size="25">
                                <input type="hidden" name="action" value="connect">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr bgcolor="#C6C3C6">
                  <td align="center" height="20">
                    <img src="<?php echo $img_loc; ?>/h_line.gif" height="18" width="490">
                  </td>
                </tr>
                <tr bgcolor="#C6C3C6">
                  <td align="right"><img src="<?php echo $img_loc; ?>/disabled.gif" width="75" height="22" border="0" alt="Back"><input type="image" src="<?php echo $img_loc; ?>/next.gif" width="75" height="22" border="0" alt="Next">
                    &nbsp;&nbsp;<img src="<?php echo $img_loc; ?>/cancel.gif" width="75" height="22" usemap="#Cancel" border="0" alt="Cancel"><map name="Cancel"><area shape="rect" coords="1,1,73,20" href="javascript:abort()"></map>
                    &nbsp;&nbsp; </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<br>
<br>
</body>
</html>
<?php
}

function message_box($msg) {
global $version, $img_loc;
?>
<body bgcolor="#3A6EA5">
<br><br><br><br><br><br>
<table border="1" cellspacing="0" cellpadding="0" align="center" width="300">
  <tr bgcolor="#C6C3C6">
    <td>
      <table width="300" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr bgcolor="#400080">
          <td height="20" class="td1" bgcolor="#000084"><b><font color="#FFFFFF">
            &nbsp;Advanced Poll <?php echo $version; ?> Patch</font></b></td>
          <td height="20" class="td1" align="right" bgcolor="#000084"><img src="<?php echo $img_loc; ?>/cross.gif" width="16" height="14" border="0">
          </td>
        </tr>
        <tr align="center">
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr bgcolor="#C6C3C6">
                <td align="center" height="75" width="20%"><img src="<?php echo $img_loc; ?>/info.gif" width="35" height="35"></td>
                <td align="left" height="75" width="80%" class="td1"><?php echo $msg; ?></td>
              </tr>
              <tr bgcolor="#C6C3C6" align="center">
                <td colspan="2" height="40"><img src="<?php echo $img_loc; ?>/disabled.gif" width="75" height="22" border="0" alt="Back">&nbsp;&nbsp;<img src="<?php echo $img_loc; ?>/ok.gif" width="75" height="22" border="0" alt="Ok"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<br>
<br>
</body>
</html>
<?php
}

$action = (isset($_POST['action'])) ? trim($_POST['action']) : "";
if ($action == "") {
	$action = (isset($_GET['action'])) ? trim($_GET['action']) : "";
}

switch ($action) {

	case "cancel":
		print_header();
		message_box("The operation has been cancelled!");
		break;

	case "connect":
		print_header();
		$POLLDB = array();

		if (!isset($_POST['db_name']) || !isset($_POST['mysql_host']) || !isset($_POST['mysql_user']) || !isset($_POST['mysql_pass'])) {
			message_box("Connection failed.");
			break;
		}

		$POLLDB["dbName"] = $_POST['db_name'];
		$POLLDB["host"]   = $_POST['mysql_host'];
		$POLLDB["user"]   = $_POST['mysql_user'];
		$POLLDB["pass"]   = $_POST['mysql_pass'];

		if (get_magic_quotes_gpc()) {
			$POLLDB["dbName"] = stripslashes($POLLDB["dbName"]);
			$POLLDB["host"]   = stripslashes($POLLDB["host"]);
			$POLLDB["user"]   = stripslashes($POLLDB["user"]);
			$POLLDB["pass"]   = stripslashes($POLLDB["pass"]);
		}

		$poll_db = new polldb_sql();
		$poll_db->connect();

		$queryID = $poll_db->query("SELECT poll_version FROM $POLLTBL[poll_config] WHERE config_id=1");
		$record = $poll_db->fetch_array($queryID);

		$commentTpl = array();
		$captchaTpl = "<div style=\"margin-top:3px;display:block;\">\r\n	<img src=\"\$pollvars[base_url]/captcha.php?time=\$poll_time\" border=\"0\" style=\"float:left;margin-right:6px\"><input type=\"text\" name=\"captcha\" maxlength=\"20\" style=\"width:100px;margin-top:4px\">\r\n</div>\r\n";
		$captchaForm = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr> \r\n    <td> \r\n      <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .poll_textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 300px}\r\n       .poll_input {  width: 300px}\r\n      -->\r\n    </style>\r\n      <form method=\"post\" action=\"\$this->form_forward\">\r\n        <table border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n          <tr>\r\n            <td class=\"td1\"><font color=\"#CC0000\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\"><b>\$msg</b></font></td>\r\n          </tr>\r\n          <tr> \r\n            <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n              <input type=\"text\" name=\"name\" value=\"\$comment[name]\" maxlength=\"30\" class=\"poll_input\" size=\"25\">\r\n            </td>\r\n          </tr>\r\n          <tr> \r\n            <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">E-mail:</font><br>\r\n              <input type=\"text\" name=\"email\" value=\"\$comment[email]\" size=\"25\" maxlength=\"50\" class=\"poll_input\">\r\n            </td>\r\n          </tr>\r\n          <tr> \r\n            <td class=\"td1\"> <font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment:</font><br>\r\n              <font face=\"MS Sans Serif\" size=\"1\"> \r\n              <textarea name=\"message\" cols=\"25\" wrap=\"VIRTUAL\" rows=\"8\" class=\"poll_textarea\">\$comment[message]</textarea>\r\n              </font>\r\n              \$POLL_CAPTCHA\r\n              </td>\r\n          </tr>\r\n          <tr valign=\"top\"> \r\n            <td>              \r\n              <input type=\"submit\" value=\"Submit\" class=\"button\" name=\"submit\">\r\n              <input type=\"reset\" value=\"Reset\" class=\"button\" name=\"reset\">\r\n              <input type=\"hidden\" name=\"action\" value=\"add\">\r\n              <input type=\"hidden\" name=\"pcomment\" value=\"\$poll_id\">\r\n              <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n            </td>\r\n          </tr>\r\n        </table>\r\n      </form>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";

		if (isset($record['poll_version'])) {
			$captcha = (function_exists("imagecolorallocate")) ? "on" : "off";
			if ($record['poll_version'] == "2.06") {
				$poll_db->query("UPDATE $POLLTBL[poll_config] SET captcha='$captcha', poll_version='$version' WHERE config_id=1");
			} else {
				$oldVersion = floatval($record['poll_version']);
				if ($oldVersion < floatval($version)) {
					$poll_db->query("ALTER TABLE $POLLTBL[poll_config] ADD `captcha` VARCHAR(5) NOT NULL");
					$poll_db->query("UPDATE $POLLTBL[poll_config] SET captcha='$captcha', poll_version='$version' WHERE config_id=1");
					$poll_db->query("INSERT INTO $templateTable SET template='$captchaTpl', title='poll_captcha', tplset_id='0'");
					$poll_db->query("UPDATE $templateTable SET template='$captchaForm' WHERE title='poll_form' AND tplset_id='0'");

					$commentTpl[1] = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" bgcolor=\"#666699\">\r\n  <tr align=\"center\">\r\n    <td>\r\n     <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 195px}\r\n       .input {  width: 195px}\r\n      -->\r\n    </style><font color=\"#FFFFFF\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>Send Your Comment</b></font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" bgcolor=\"#FFFFFF\" width=\"200\">\r\n        <tr>\r\n          <td width=\"149\">\r\n            <form method=\"post\" action=\"\$this->form_forward\">\r\n              <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" bgcolor=\"\" align=\"center\">\r\n                <tr>\r\n                  <td class=\"td1\" height=\"40\"><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">\$question</font></b></td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n                    <input type=\"text\" name=\"name\" maxlength=\"25\" class=\"input\" size=\"23\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">e-mail:</font><br>\r\n                    <input type=\"text\" name=\"email\" size=\"23\" maxlength=\"50\" class=\"input\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment(*):</font><br>\r\n                    <font face=\"MS Sans Serif\" size=\"1\">\r\n                    <textarea name=\"message\" cols=\"19\" wrap=\"VIRTUAL\" rows=\"3\" class=\"textarea\"></textarea>\r\n                    </font>\r\n                    \$POLL_CAPTCHA\r\n                  </td>\r\n                </tr>\r\n                <tr valign=\"top\">\r\n                  <td>\r\n                    <input type=\"submit\" value=\"Submit\" class=\"button\">\r\n                    <input type=\"reset\" value=\"Reset\" class=\"button\">\r\n                    <input type=\"hidden\" name=\"action\" value=\"add\">\r\n                    <input type=\"hidden\" name=\"id\" value=\"\$poll_id\">\r\n		    <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n            </form>\r\n          </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";
					$commentTpl[2] = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" bgcolor=\"#666699\">\r\n  <tr align=\"center\">\r\n    <td>\r\n     <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 195px}\r\n       .input {  width: 195px}\r\n      -->\r\n    </style><font color=\"#FFFFFF\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>Send Your Comment</b></font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" bgcolor=\"#F3F3F3\" width=\"200\">\r\n        <tr>\r\n          <td width=\"149\">\r\n            <form method=\"post\" action=\"\$this->form_forward\">\r\n              <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" bgcolor=\"\" align=\"center\">\r\n                <tr>\r\n                  <td class=\"td1\" height=\"40\"><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">\$question</font></b></td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n                    <input type=\"text\" name=\"name\" maxlength=\"25\" class=\"input\" size=\"23\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">e-mail:</font><br>\r\n                    <input type=\"text\" name=\"email\" size=\"23\" maxlength=\"50\" class=\"input\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment(*):</font><br>\r\n                    <font face=\"MS Sans Serif\" size=\"1\">\r\n                    <textarea name=\"message\" cols=\"19\" wrap=\"VIRTUAL\" rows=\"3\" class=\"textarea\"></textarea>\r\n                    </font>\r\n                    \$POLL_CAPTCHA\r\n                  </td>\r\n                </tr>\r\n                <tr valign=\"top\">\r\n                  <td>\r\n                    <input type=\"submit\" value=\"Submit\" class=\"button\">\r\n                    <input type=\"reset\" value=\"Reset\" class=\"button\">\r\n                    <input type=\"hidden\" name=\"action\" value=\"add\">\r\n                    <input type=\"hidden\" name=\"id\" value=\"\$poll_id\">\r\n                    <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n            </form>\r\n          </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";
					$commentTpl[3] = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" bgcolor=\"#666699\">\r\n  <tr align=\"center\">\r\n    <td>\r\n     <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 195px}\r\n       .input {  width: 195px}\r\n      -->\r\n    </style><font color=\"#FFFFFF\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>Submit Your Comment</b></font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" bgcolor=\"#FFFFFF\" width=\"200\">\r\n        <tr>\r\n          <td width=\"149\">\r\n            <form method=\"post\" action=\"\$this->form_forward\">\r\n              <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" bgcolor=\"\" align=\"center\">\r\n                <tr>\r\n                  <td class=\"td1\" height=\"40\"><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">\$question</font></b></td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n                    <input type=\"text\" name=\"name\" maxlength=\"25\" class=\"input\" size=\"23\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">e-mail:</font><br>\r\n                    <input type=\"text\" name=\"email\" size=\"23\" maxlength=\"50\" class=\"input\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment(*):</font><br>\r\n                    <font face=\"MS Sans Serif\" size=\"1\">\r\n                    <textarea name=\"message\" cols=\"19\" wrap=\"VIRTUAL\" rows=\"3\" class=\"textarea\"></textarea>\r\n                    </font>\r\n                    \$POLL_CAPTCHA\r\n                  </td>\r\n                </tr>\r\n                <tr valign=\"top\">\r\n                  <td>\r\n                    <input type=\"submit\" value=\"Submit\" class=\"button\">\r\n                    <input type=\"reset\" value=\"Reset\" class=\"button\">\r\n                    <input type=\"hidden\" name=\"action\" value=\"add\">\r\n                    <input type=\"hidden\" name=\"id\" value=\"\$poll_id\">\r\n                    <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n            </form>\r\n          </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";
					$commentTpl[4] = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" bgcolor=\"#666699\">\r\n  <tr align=\"center\">\r\n    <td>\r\n     <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 195px}\r\n       .input {  width: 195px}\r\n      -->\r\n    </style><font color=\"#FFFFFF\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>Submit Your Comment</b></font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" bgcolor=\"#FFFFFF\" width=\"200\">\r\n        <tr>\r\n          <td width=\"149\">\r\n            <form method=\"post\" action=\"\$this->form_forward\">\r\n              <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" bgcolor=\"\" align=\"center\">\r\n                <tr>\r\n                  <td class=\"td1\" height=\"40\"><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">\$question</font></b></td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n                    <input type=\"text\" name=\"name\" maxlength=\"25\" class=\"input\" size=\"23\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">e-mail:</font><br>\r\n                    <input type=\"text\" name=\"email\" size=\"23\" maxlength=\"50\" class=\"input\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment(*):</font><br>\r\n                    <font face=\"MS Sans Serif\" size=\"1\">\r\n                    <textarea name=\"message\" cols=\"19\" wrap=\"VIRTUAL\" rows=\"3\" class=\"textarea\"></textarea>\r\n                    </font>\r\n                    \$POLL_CAPTCHA\r\n                  </td>\r\n                </tr>\r\n                <tr valign=\"top\">\r\n                  <td>\r\n                    <input type=\"submit\" value=\"Submit\" class=\"button\">\r\n                    <input type=\"reset\" value=\"Reset\" class=\"button\">\r\n                    <input type=\"hidden\" name=\"action\" value=\"add\">\r\n                    <input type=\"hidden\" name=\"id\" value=\"\$poll_id\">\r\n                    <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n            </form>\r\n          </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";
					$commentTpl[5] = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" bgcolor=\"#666699\">\r\n  <tr align=\"center\">\r\n    <td>\r\n     <style type=\"text/css\">\r\n      <!--\r\n       .button {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}\r\n       .textarea {  font-family: \"MS Sans Serif\"; font-size: 9pt; width: 195px}\r\n       .input {  width: 195px}\r\n      -->\r\n    </style><font color=\"#FFFFFF\" face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>Send Your Comment</b></font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" bgcolor=\"#F3F3F3\" width=\"200\">\r\n        <tr>\r\n          <td width=\"149\">\r\n            <form method=\"post\" action=\"\$this->form_forward\">\r\n              <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" bgcolor=\"\" align=\"center\">\r\n                <tr>\r\n                  <td class=\"td1\" height=\"40\"><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">\$question</font></b></td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Name:</font><br>\r\n                    <input type=\"text\" name=\"name\" maxlength=\"25\" class=\"input\" size=\"23\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">e-mail:</font><br>\r\n                    <input type=\"text\" name=\"email\" size=\"23\" maxlength=\"50\" class=\"input\">\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td class=\"td1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">Comment(*):</font><br>\r\n                    <font face=\"MS Sans Serif\" size=\"1\">\r\n                    <textarea name=\"message\" cols=\"19\" wrap=\"VIRTUAL\" rows=\"3\" class=\"textarea\"></textarea>\r\n                    </font>\r\n                    \$POLL_CAPTCHA\r\n                  </td>\r\n                </tr>\r\n                <tr valign=\"top\">\r\n                  <td>\r\n                    <input type=\"submit\" value=\"Submit\" class=\"button\">\r\n                    <input type=\"reset\" value=\"Reset\" class=\"button\">\r\n                    <input type=\"hidden\" name=\"action\" value=\"add\">\r\n                    <input type=\"hidden\" name=\"id\" value=\"\$poll_id\">\r\n                    <input type=\"hidden\" name=\"time\" value=\"\$poll_time\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n            </form>\r\n          </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n";

					for ($i=1; $i<=5; $i++) {
					    $poll_db->query("UPDATE $templateTable SET template='$commentTpl[$i]' WHERE title='comment' AND tplset_id='$i'");
					}
				}
			}
		}

		message_box("DB upgrade completed! Don't forget to update all PHP files too.");
		break;

	default:
		print_header();
		db_config();
		break;
}

?>