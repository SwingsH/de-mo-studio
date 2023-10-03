<?php
/***************************************************************************
*	ID			: info.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.07
*	Author2		: Swings Huang	2007.12.01
*	Information		: 
*		Offer Information about Our Site , DEMO Studio
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template

// Outcomming Variable
$book_id = $_GET['bid'] ;

$TPL_generator = new FunctionBlock();

$tpl = $TPL_generator->skin( 'home' );
$tpl_content = $TPL_generator->create_template( 'page_content_magazine.html' );

// Assign the XML data about "book pages" .
$tpl_content->assign( 'xml_src' , 'data/data_flashbook_' . $book_id . '.xml' );

// Combine 2 HTML
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：時尚雜誌 ');
$tpl->display();


?>