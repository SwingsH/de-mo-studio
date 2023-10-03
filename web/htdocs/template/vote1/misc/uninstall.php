<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

$version = "2.07";

if (!is_file("../install/cross.gif")) {
	$img_loc= "http://www.proxy2.de/poll/install";
} else {
	$img_loc= "../install";
}

$POLLTBL = array();
$POLLDB = array();

$PHP_SELF = $_SERVER['PHP_SELF'];

function print_header() {
global $version;
?>
<html>
<head>
<title>Advanced Poll <?php echo $version; ?> Uninstall</title>
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
 if (window.confirm("Are you sure you want to cancel the uninstall?")) {
    window.location.href = "http://"+window.location.host+window.location.pathname+"?action=cancel"
 }
}
// -->
</script>
</head>
<?php
}

function db_config() {
global $PHP_SELF, $version, $img_loc;
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
            &nbsp;Advanced Poll <?php echo $version; ?> Uninstall</font></b></td>
          <td height="20" class="td1" align="right" bgcolor="#000084"><img src="<?php echo $img_loc; ?>/cross.gif" width="16" height="14" border="0" usemap="#close"><map name="close"><area shape="rect" coords="1,1,14,12" href="javascript:abort()"></map>
          </td>
        </tr>
        <tr align="center">
          <td colspan="2">
            <form method="post" action="<?php echo $PHP_SELF; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr bgcolor="#FFFFFF" valign="bottom">
                  <td class="td1" height="30"><b>&nbsp;&nbsp;&nbsp;&nbsp;Welcome to the Advanced Poll uninstall script.</b></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td class="td1" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    This script removes all the tables that Advanced Poll is using from your database.</td>
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

function confirm_uninstall() {
global $PHP_SELF, $version, $img_loc;
global $POLLTBL, $POLLDB;
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
            &nbsp;Advanced Poll <?php echo $version; ?> Uninstall</font></b></td>
          <td height="20" class="td1" align="right" bgcolor="#000084"><img src="<?php echo $img_loc; ?>/cross.gif" width="16" height="14" border="0" usemap="#close"><map name="close"><area shape="rect" coords="1,1,14,12" href="javascript:abort()"></map>
          </td>
        </tr>
        <tr align="center">
          <td colspan="2">
            <form method="post" action="<?php echo $PHP_SELF; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr bgcolor="#FFFFFF" valign="bottom">
                  <td class="td1" height="30"><b>&nbsp;&nbsp;&nbsp;&nbsp;Connection
                    established</b></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td class="td1" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $POLLDB["user"]."@".$POLLDB["host"]; ?></td>
                </tr>
                <tr bgcolor="#C6C3C6">
                  <td class="td1" align="center">
                    <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td class="td1" height="75">Are you sure you want to remove
                          the following tables from your database?</td>
                      </tr>
                      <tr>
                        <td height="140" class="td1" valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_index"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_data"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_config"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_ip"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_log"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_comment"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_tpl"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_tplset"]; ?></td>
                            </tr>
                            <tr>
                              <td class="td1">- <?php echo $POLLTBL["poll_user"]; ?></td>
                                <input type="hidden" name="db_name" value="<?php echo htmlspecialchars($POLLDB["dbName"]); ?>">
                                <input type="hidden" name="mysql_host" value="<?php echo htmlspecialchars($POLLDB["host"]); ?>">
                                <input type="hidden" name="mysql_user" value="<?php echo htmlspecialchars($POLLDB["user"]); ?>">
                                <input type="hidden" name="mysql_pass" value="<?php echo htmlspecialchars($POLLDB["pass"]); ?>">
                                <input type="hidden" name="action" value="delete">
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
            &nbsp;Advanced Poll <?php echo $version; ?> Uninstall</font></b></td>
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
exit();
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
		if (is_file("../include/config.inc.php")) {
			require_once "../include/config.inc.php";
			if (is_file("../include/$POLLDB[class]")) {
				require_once "../include/$POLLDB[class]";
			} else {
				message_box("Cannot find $POLLDB[class].");
			}
		} elseif (is_file("./include/config.inc.php")) {
			require_once "./include/config.inc.php";
			if (is_file("./include/$POLLDB[class]")) {
				require_once "./include/$POLLDB[class]";
			} else {
				message_box("Cannot find $POLLDB[class].");
			}
		} else {
			message_box("Cannot find the configuration file <u>config.inc.php</u>.");
		}
		if (empty($POLLTBL["poll_index"]) || empty($POLLTBL["poll_data"]) || empty($POLLTBL["poll_config"]) || empty($POLLTBL["poll_ip"]) || empty($POLLTBL["poll_log"]) || empty($POLLTBL["poll_user"]) || empty($POLLTBL["poll_comment"])) {
			message_box("Some tables are not defined. Please check the configuration file.");
		}

		if (!isset($_POST['db_name']) || !isset($_POST['mysql_host']) || !isset($_POST['mysql_user']) || !isset($_POST['mysql_pass'])) {
			message_box("Connection failed.");
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
		confirm_uninstall();
		break;

	case "delete":
		print_header();
		if (is_file("../include/config.inc.php")) {
			require_once "../include/config.inc.php";
			if (is_file("../include/$POLLDB[class]")) {
				require_once "../include/$POLLDB[class]";
			} else {
				message_box("Cannot find the $POLLDB[class].");
			}
		} elseif (is_file("./include/config.inc.php")) {
			require_once "./include/config.inc.php";
			if (is_file("./include/$POLLDB[class]")) {
				require_once "./include/$POLLDB[class]";
			} else {
				message_box("Cannot find the $POLLDB[class].");
			}
		} else {
			message_box("Cannot find the configuration file <u>config.inc.php</u>.");
		}

		if (!isset($_POST['db_name']) || !isset($_POST['mysql_host']) || !isset($_POST['mysql_user']) || !isset($_POST['mysql_pass'])) {
			message_box("Connection failed.");
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

		for (reset($POLLTBL); $key=key($POLLTBL); next($POLLTBL)) {
			$poll_db->query("DROP TABLE $POLLTBL[$key]");
		}

		if (ereg("class_pgsql", $POLLDB["class"])) {
			$poll_db->query("DROP SEQUENCE poll_comment_seq");
			$poll_db->query("DROP SEQUENCE poll_index_seq");
			$poll_db->query("DROP SEQUENCE poll_templateset_seq");
			$poll_db->query("DROP SEQUENCE poll_data_seq");
			$poll_db->query("DROP SEQUENCE poll_templates_seq");
		}

		message_box("The tables have been removed from your database!");
		break;

	default:
		print_header();
		db_config();
		break;

}

?>