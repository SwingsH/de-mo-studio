<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

require_once "./common.inc.php";
require_once "../include/class_input2db.php";

function get_lang_list($dir) {
    $lang_list = '';
    chdir("$dir");
    $hnd = opendir(".");
    while ($file = readdir($hnd)) {
        if(is_file($file)) {
            $langlist[] = $file;
        }
    }
    closedir($hnd);
    if ($langlist) {
        asort($langlist);
        while (list ($key, $file) = each ($langlist)) {
            if (ereg(".php|.php3",$file,$regs)) {
                $lang_list .= "<option value=\"".$file."\">".str_replace("$regs[0]","","$file")."</option>\n";
            }
        }
    }
    return $lang_list;
}

function addspecialchars($input='') {
    if(is_array($input)) {
        reset($input);
        while (list($var,$value) = each($input)) {
            $input[$var] = htmlspecialchars($value);
        }
        return $input;
    } else {
        return false;
    }
}


$action = (!isset($_REQUEST['action'])) ? '' : trim($_REQUEST['action']);  


$message = $lang["SetText"];

if ($action == "update") {
    if (!eregi(".php|.php3", $_POST['cfg']['lang'])) {
        $_POST['cfg']['lang'] = "english.php";
    }
    
    if (!eregi("^[0-9]+$", $_POST['cfg']['entry_pp']) || $_POST['cfg']['entry_pp']==0) {
        $_POST['cfg']['entry_pp'] = 1;
    }
    $_POST['cfg']['captcha'] = (!isset($_POST['cfg']['captcha']) || ($_POST['cfg']['captcha'] != "on")) ? "off" : "on";
    $CLASS["db_input"] = new input2db();
    $result = $CLASS["db_input"]->update_db_row($POLLTBL["poll_config"],$_POST['cfg'],"config_id",1);
    if ($result) {
        $pollvars = $CLASS["db"]->fetch_array($CLASS["db"]->query("SELECT * FROM $POLLTBL[poll_config]"));
        $pollvars['SELF'] = basename($_SERVER['PHP_SELF']);
        $CLASS["db"]->free_result($CLASS["db"]->result);
        $lang = array();
        include (dirname(dirname(__FILE__))."/lang/$pollvars[lang]");
        $message = $lang["Updated"];
    } else {
        $message = $lang["NoUpdate"];
    }
}

$CLASS["template"]->set_templatefiles(array(
    "admin_settings" => "admin_settings.html"
));

$pollvars = addspecialchars($pollvars);
$langlist = get_lang_list("../lang");
$check_ip = ($pollvars["check_ip"] == 0) ? "selected" : "";
$no_ip_check = ($pollvars["check_ip"] == 2) ? "selected" : "";
$votes = ($pollvars["type"] == "votes") ? "checked" : "";
$percent = ($pollvars["type"] == "percent") ? "checked" : "";
$order_usort = ($pollvars["result_order"] == "usort") ? "selected" : "";
$order_asc = ($pollvars["result_order"] == "asc") ? "selected" : "";
$order_desc = ($pollvars["result_order"] == "desc") ? "selected" : "";
$capcha_check = ($pollvars["captcha"] == "on") ? "checked" : "";

$admin_settings = $CLASS["template"]->pre_parse("admin_settings");
no_cache_header();
eval("echo \"$admin_settings\";");

?>