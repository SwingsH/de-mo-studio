<?php
$include_path = dirname(__FILE__);

require_once $include_path."/include/config.inc.php";
require_once $include_path."/include/$POLLDB[class]";
require_once $include_path."/include/class_poll.php";
require_once $include_path."/include/class_pgfx.php";

$CLASS = array();
$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();
$php_poll = new pgfx();
if (isset($_GET['poll_id'])) {
    $php_poll->output_png(intval($_GET['poll_id']),100);
}
?>