<?php
/***************************************************************************
*	ID			: info.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.07
*	Author2		: -----------	----------
*	Information		: 
*		Offer Information about Our Site , DEMO Studio
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template

// Depend on diff argument b to get diff TPL
$arr_tpl = array(
	"about"=>"content_top_about.html",
	"newhand"=>"content_top_newhand.html" ,
	"street" => "content_top_street.html",
	"contact"=>"content_top_contact.html",
	"qa" => "content_top_qa.html", 
	"statement"=>"content_top_statement.html",
	"private"=>"content_top_private.html",
	"ad"=>"content_top_ad.html");
	
// Decide Template Name
if( !empty($arr_tpl[$_GET['b']]) )
	$tpl_name = $arr_tpl[$_GET['b']];
else
	$tpl_name = $arr_tpl["about"];

$block = new FunctionBlock();

$tpl = $block->skin( 'home' );
$tpl_content = $block->create_template( $tpl_name );

// Combine 2 HTML
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：網站說明 ');
$tpl->display();


?>