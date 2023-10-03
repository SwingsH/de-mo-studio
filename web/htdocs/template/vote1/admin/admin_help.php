<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
 
require_once "./common.inc.php";

$path = dirname(__FILE__);
$path = dirname($path);
if (eregi("WIN",PHP_OS)) {
    $path = str_replace("\\","/",$path);
}
$include_statement = "require_once";

$CLASS["template"]->set_templatefiles(array(
    "admin_help" => "admin_help.html"
));
$admin_help = $CLASS["template"]->pre_parse("admin_help");
no_cache_header();
eval("echo \"$admin_help\";");

?>