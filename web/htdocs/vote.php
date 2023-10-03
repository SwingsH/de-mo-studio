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

$TPL_generator = &new FunctionBlock();

$tpl = $TPL_generator->skin( 'home' );
$tpl_content = $TPL_generator->create_template( 'page_content_vote.html' );


// Combine 2 HTML
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：DEMO投票箱 ');
$tpl->display();


?>