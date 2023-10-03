<?php
/***************************************************************************
*	ID			: week.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.07
*	Author2		: -----------	----------
*	Information		: 
*		Offer Information about Our Site , DEMO Studio
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template

// Depend on diff argument d to get diff TPL
$arr_tpl = array(
	"mon"=>"page_content_week1.html",
	"tue"=>"page_content_week2.html" ,
	"wed" => "page_content_week3.html",
	"thur"=>"page_content_week4.html",
	"fri" => "page_content_week5.html", 
	"sat"=>"page_content_week6.html",
	"sun"=>"page_content_week7.html");
	
	
// Decide Template Name
if( !empty($arr_tpl[$_GET['d']]) )
	$tpl_name = $arr_tpl[$_GET['d']];
else
	$tpl_name = $arr_tpl["mon"];

$block = &new FunctionBlock();

$tpl = $block->skin( 'home' );
$tpl_content = $block->create_template( $tpl_name );

// Combine 2 HTML
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：網站說明 ');
$tpl->display();


?>