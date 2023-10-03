<?php
$id = (isset($_POST['id'])) ? intval($_POST['id']) : "";
if ($id == "") {
	if (isset($_GET['id'])) {
		$id = intval($_GET['id']);
	}
}

$template_set = (isset($_POST['template_set'])) ? trim($_POST['template_set']) : "";
if ($template_set == "") {
	if (isset($_GET['template_set'])) {
		$template_set = trim($_GET['template_set']);
	}
}

$action = (isset($_POST['action'])) ? trim($_POST['action']) : "";
if ($action == "") {
	if (isset($_GET['action'])) {
		$action = trim($_GET['action']);
	}
}

$include_path = dirname(__FILE__);

require_once $include_path."/include/config.inc.php";
require_once $include_path."/include/$POLLDB[class]";
require_once $include_path."/include/class_poll.php";
require_once $include_path."/include/class_pollcomment.php";
require_once $include_path."/include/class_captchatest.php";

$CLASS = array();
$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();

$my_comment = new pollcomment();

if (!empty($template_set)) {
    $my_comment->set_template_set("$template_set");
}
if (empty($id)) {
    echo $my_comment->print_message("Poll ID <b>".intval($id)."</b> does not exist or is disabled!");
} elseif ($my_comment->is_comment_allowed($id)) {
    if ($action == "add") {
        $poll_input = array("message","name","email");
        $validCaptcha = true;
        if ($my_comment->pollvars['captcha'] == "on") {
        	$captcha = new CaptchaTest;
			$captcha->secretCode .= $POLLDB['pass'];
			if (!isset($_POST['time']) || !isset($_POST['captcha'])) {
				$validCaptcha = false;
			} elseif (!$captcha->isValid($_POST['captcha'], $_POST['time'])) {
				$validCaptcha = false;
			}
    	}

        for($i=0;$i<sizeof($poll_input);$i++) {
            if (isset($_POST[$poll_input[$i]])) {
                $_POST[$poll_input[$i]] = trim($_POST[$poll_input[$i]]);
            } else {
                $_POST[$poll_input[$i]] = '';
            }
        }
        if (empty($_POST['name'])) {
            echo $my_comment->print_message("Please enter your name.<br><a href=\"javascript:history.back()\">Go back</a>");
        }
        elseif (empty($_POST['message'])) {
            echo $my_comment->print_message("You forgot to fill in the message field!<br><a href=\"javascript:history.back()\">Go back</a>");
        }
    /*
        elseif (empty($_POST['email'])) {
            echo $my_comment->print_message("You must specify your e-mail address.!<br><a href=\"javascript:history.back()\">Go back</a>");
        }
    */

        elseif ($validCaptcha == false) {
            echo $my_comment->print_message("You must specify the correct key!<br><a href=\"javascript:history.back()\">Go back</a>");
        }

        else {
            $my_comment->add_comment($id);
            echo $my_comment->print_message("Your message has been sent!",1);
        }
    } else {
        echo $my_comment->poll_form($id);
    }
}

?>