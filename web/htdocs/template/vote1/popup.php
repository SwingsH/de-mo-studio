<?php
require_once "./poll_cookie.php";
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "./booth.php";
?>
<html>
<head>
<title><?php echo $php_poll->pollvars["title"]; ?></title>
</head>
<body bgcolor="#FFFFFF">
<br>
<center>
<?php
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$poll_ident = (isset($_GET['poll_ident'])) ? $_GET['poll_ident'] : '';
$poll_ident = (isset($_POST['poll_ident'])) ? $_POST['poll_ident'] : $poll_ident;

$php_poll->set_template_set("popup");
if (!empty($poll_ident) && !empty($action)) {
    $php_poll->set_max_bar_length(110);
    echo $php_poll->poll_process(intval($poll_ident));
}
?>
</center>
</body>
</html>
