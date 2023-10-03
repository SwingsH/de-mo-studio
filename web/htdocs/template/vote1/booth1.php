<?php

global $CLASS, $POLLTBL, $POLLDB;
$include_path = dirname(__FILE__);

require_once $include_path."/include/config.inc.php";
require_once $include_path."/include/$POLLDB[class]";
require_once $include_path."/include/class_poll.php";
require_once $include_path."/include/class_pollcomment.php";
require_once $include_path."/include/class_plist.php";
$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect(); 

$php_poll = new plist();
?>