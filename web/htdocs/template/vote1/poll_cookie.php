<?php
/**
 * ----------------------------------------------
 * this code is optional
 * Important! You have to include it 
 * before your html code
 * ----------------------------------------------
 */
if (!headers_sent()) {
	$cookie_expire = 12; // hours
	
	$action = (isset($_GET['action'])) ? $_GET['action'] : '';
	$action = (isset($_POST['action'])) ? $_POST['action'] : $action;
	$poll_ident = (isset($_GET['poll_ident'])) ? $_GET['poll_ident'] : '';
	$poll_ident = (isset($_POST['poll_ident'])) ? $_POST['poll_ident'] : $poll_ident;
	
	if ($action=="vote" && (isset($_POST['option_id']) || isset($_GET['option_id']))) {
	    $cookie_index = intval($poll_ident);
	    if (!isset($_COOKIE['AdvancedPoll'][$cookie_index])) {
	        $endtime = time()+3600*$cookie_expire;
	        setcookie("AdvancedPoll[$cookie_index]", "1", $endtime);
	    }
	}
}
?>