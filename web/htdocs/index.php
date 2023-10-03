<?php
/***************************************************************************
 *   Licence               : Swings (C) DE-MO Studio in Taiwan 
 ***************************************************************************/
 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );
require_once( INCLUDE_PATH . 'dm_db.php' );
require_once( INCLUDE_PATH . 'dm_savant2.php' );

$TPL_generator = new FunctionBlock();
$TG = new TemplateGenerator();

// Quick view
$tpl_quickitem = $TPL_generator->create_template('block_quick_itemsearch.html');
$tpl_quickitem->assign('randitem',get_blk_quickitem());

$tpl_mid = $TPL_generator->create_template('page_content_home.html');
$tpl_mid->assign('domain',IPDOMAIN);
$tpl_mid->assign('block_quickitem', $tpl_quickitem->fetch() );

$html_right = $TPL_generator->block_rightbar( 'home' ) ;

$tpl_content = $TPL_generator->create_template('index_homepage_frame.html');
$tpl_content->assign('page_main_content', $tpl_mid->fetch() );
$tpl_content->assign('page_rightbar', $html_right );

$tpl = $TPL_generator->skin( 'homepage' );
$tpl->assign('page_main_content',$tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：首頁');
$tpl->display();

function get_blk_quickitem(){
	$brand = db_random_brands(1);
	
	//print_r( $brand[0] );
	return $brand[0] ;	
}

?>