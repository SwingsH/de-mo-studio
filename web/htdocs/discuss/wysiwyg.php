<?php
require_once('global.php');

header("Content-Type: text/html; charset=$db_charset");
if($type=='color'){
	include PrintEot('color');exit;
}elseif($type=='table'){
	include PrintEot('table');exit;
}elseif($type=='image'){
	include PrintEot('image');exit;
}elseif($type=='sale'){
	include PrintEot('sale');exit;
}
?>