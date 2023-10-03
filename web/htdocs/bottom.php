<!--
/***************************************************************************
 *   Licence               : Swings (C) DE-MO Studio in Taiwan 
 ***************************************************************************/
-->

<?php
$root_path = "./";
require_once($root_path . 'includes/dm_template.php');
require_once($root_path . 'includes/dm_classes.php');
require_once($root_path . 'includes/dm_db.php');

// Depend on diff argument b to get diff TPL
$arr_tpl = array("newhand"=>"bottom_newhand.tpl" , "statement"=>"bottom_statement.tpl","private"=>"bottom_private.tpl","ad"=>"bottom_ad.tpl");
$tpl_name = $arr_tpl[$_GET['b']];

$tpl_kind = &new Template('template/' . $tpl_name);
$tpl_kind->set('a', "no" );


// Page TPL


$tpl_page = &new Template('template/index_skin.tpl');
$tpl_page->set('page_title', 'DEMO流行情報站：風格總覽' );
$tpl_page->set('page_contain',$tpl_kind );

echo $tpl_page->fetch();



?>