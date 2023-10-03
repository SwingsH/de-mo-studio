<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

if (!isset($PHP_SELF)) {
    if (isset($_GET)) {
        while (list($name, $value)=each($_GET)) {
            $$name=$value;
        }
    }
    if (isset($_POST)) {
        while (list($name, $value)=each($_POST)) {
            $$name=$value;
        }
    }
}
$PHP_SELF = $_SERVER["PHP_SELF"];

$CLASS = array();

require_once "../include/config.inc.php";
require_once "../include/$POLLDB[class]";
require_once "../include/class_session.php";
require_once "../include/class_template.php";

function no_cache_header() {
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
}

$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();
$pollvars = $CLASS["db"]->fetch_array($CLASS["db"]->query("SELECT * FROM $POLLTBL[poll_config]"));
$CLASS["db"]->free_result($CLASS["db"]->result);
$pollvars['SELF'] = basename($_SERVER["PHP_SELF"]);
$lang = array();
if (is_file("../lang/$pollvars[lang]")) {
    include ("../lang/$pollvars[lang]");
} else {
    include ("../lang/english.php");
}
$CLASS["template"] = new poll_template();
$CLASS["template"]->set_rootdir("./templates");
$CLASS["session"] = new poll_session();
$CLASS["session"]->db = &$CLASS["db"];

$auth = $CLASS["session"]->check_session_id();

if (!$auth) {
    $message = (isset($_POST['username']) || isset($_POST['password'])) ? $lang['FormWrong'] : $lang['FormEnter'];
    $CLASS["template"]->set_templatefiles(array(
        "login" => "admin_login.html"
    ));
    $poll_login = $CLASS["template"]->pre_parse("login");
    no_cache_header();
    eval("echo \"$poll_login\";");
    exit();
}

?>