<!--
/***************************************************************************
 *   Licence               : Swings (C) DE-MO Studio in Taiwan 
 ***************************************************************************/
-->

<?php

$root_path = "./";

require_once($root_path.'includes/dm_template.php');
require_once($root_path.'includes/dm_classes.php');

// Template start !!

$tpl_index_entrance = new Template('template/index_entrance.tpl');
$tpl_index_entrance->set('null',null);

$tpl_index_scroll = new Template('template/index_page_scroll.tpl');
$tpl_index_scroll->set('page_contain',$tpl_index_entrance);

// Page TPL
$tpl_page = new Template('template/index_skin.tpl');
$tpl_page->set('page_contain',$tpl_index_scroll);

echo $tpl_page->fetch();

?>