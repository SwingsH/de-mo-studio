<?php
/***************************************************************************
*	ID		: news.php
*	Licence	: Swings (C) DE-MO Studio in Taiwan 
*	Author	: Swings	2007.11.13
*	Information	: 
*		DEMO list news
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm.function.default.php');	// Items function
require_once( INCLUDE_PATH . 'dm_classes.php');		// p');
require_once( INCLUDE_PATH . 'dm_template.php');
require_once( INCLUDE_PATH . 'dm.function.big5.php');	// handle big5

//Table InformationNormal class
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template
require_once( INCLUDE_PATH . 'dm_photo_rule.php');	
define('BULLETIN_TABLE' , 'dm_bulletin_post' );
define('TYPE_TABLE' , 'dm_bulletin_type' );
define('IGNORE_TYPE' , 4 );	//4=資訊
//Row Information
define('BULLETIN_PAGE_NUM', 10 );	// 10 row per page

// Convert page info
$page = $_GET['page'] ? (integer) $_GET['page'] : 1 ;	// page
$article_id = $_GET['id']  ? (integer) $_GET['id'] : 0 ;	//bulletin id
$article_type = $_GET['type']  ? (integer) $_GET['type'] : 0 ;

// Update
update_page_count($article_id);

// Database
$total_row ;
$cur_article = array();
$articles = fetch_bulletin_articles( $page , $article_id , $article_type);
//print_r($articles);

// Calculate page urls
$page_links = list_page_urls( $page,BULLETIN_PAGE_NUM , $total_row );

// This page should be work as function 
if( !isset( $_GET['nodisplay'] ) ){
#======== Template =========
$TPL_generator = &new FunctionBlock();

// Template : PageNum Section

$tpl_pagenum = $TPL_generator->create_template( 'block_pagenum.html' );
$tpl_pagenum->assign('page_links' , $page_links);
$tpl_pagenum->assign('current_page',$page);

// Template : Page Content
if( $article_type != IGNORE_TYPE ){
	$tpl_content = $TPL_generator->create_template( 'page_content_news.html' );
}else{
	$tpl_content = $TPL_generator->create_template( 'page_content_streetnews.html' );
}
$tpl_content->assign('articles' , $articles );
$tpl_content->assign('current_article' , $cur_article );
$tpl_content->assign('selfurl' , substr( $_SERVER['PHP_SELF'] , 1 ) );
$tpl_content->assign('block_pagenum' , $tpl_pagenum->fetch() ) ;

// Template : Rapid Skin
$tpl = $TPL_generator->skin( 'home' );
$tpl->assign('page_main_content' , $tpl_content->fetch() ) ;
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：最新消息 ');

$tpl->display();
}
#======== Template End=========

//============ Functions =================
function fetch_bulletin_articles( $page , $article_id , $article_type ){
	$db = db_connect();
	$type_list = fetch_bulletin_type();	// Get all post type !! from db
	$arr_articles = array();
	
	//DISCARD 4
	$type_query = ( $article_type==0  ) ?  'AND post_type BETWEEN 1 AND 3':" AND post_type = " . $article_type ;
	
	// count total rows
	$GLOBALS['total_row']= db_table_count( BULLETIN_TABLE , "post_id" , " post_valid>=1 ".$type_query);
	
	$query = "SELECT * FROM ". BULLETIN_TABLE . " WHERE post_valid = 1 ".
		$type_query." ORDER BY post_date DESC ".
		" LIMIT ". ( $page-1)*BULLETIN_PAGE_NUM . " , " .BULLETIN_PAGE_NUM ;

	//$log = &new ErrorLog(INCLUDE_PATH.'log/');
	//$log->save('$query:'.$query);

	if( !($result = $db->sql_query($query)) ){
		die('News information Not Exist ! ERROR' );
	}
	$count=0;
	while( $row = $db->sql_fetchrow($result) ){
		$article = array();
		$article['id'] = $row['post_id'];
		$article['type'] = $row['post_type'];
		$article['typename'] = $type_list[ $row['post_type'] ];
		$article['title'] = $row['post_title'];
		$article['subtitle'] = big5_substr( $row['post_title'] , 0 , 28 );
		$article['content'] = $row['post_contents'] ;
		$article['subcontent'] = big5_substr( $row['post_contents'] , 0 , 28 );
		$article['date'] = parse_date ( $row['post_date'] ) ;
		$article['count'] = $row['post_count'];
		// generate id url
		$article['url'] = parse_geturl( 'id' , $row['post_id'] ) ;
		// generate type url
		$article['typeurl'] = substr( $_SERVER['PHP_SELF'] , 1 ) .'?type='.$article['type'] ;
		
		array_push( $arr_articles , $article );
		
		
		// Assign latest article
		if( $count == 0 ){
			$GLOBALS['cur_article'] = $article ;
			//print_r($GLOBALS['cur_article']);
		}
		// Detect current article
		if( $article_id == $article['id'] ){
			$GLOBALS['cur_article'] = $article ;
			//print_r($GLOBALS['cur_article']);
		}
		$count++;
	}
	
	return $arr_articles ;
}
function parse_geturl( $var , $value ){
	$myGET = $_GET;
	$myGET[ $var ] = $value ;
	$url = substr( $_SERVER['PHP_SELF'] , 1 ) ;
	
	return $url .'?'. http_build_query( $myGET );
}
// Get all post types
function fetch_bulletin_type(){
	$db = db_connect();
	$arr_type = array();

	$query = "SELECT * FROM dm_bulletin_type WHERE type_valid = 1 ORDER BY type_id ASC" ;

	if( !($result = $db->sql_query($query)) ){
		die('Type information Not Exist ! ERROR' );
	}
	
	while( $row = $db->sql_fetchrow($result) ){
		$arr_type[ $row['type_id' ] ] =  $row['type_name' ] ;
		
	}
	//print_r ( $arr_type );
	return $arr_type ;
}
function update_page_count($article_id){
	if( $article_id == 0){
		$query = 'SELECT post_id FROM '.BULLETIN_TABLE.' ORDER BY post_date DESC, post_id DESC LIMIT 1';
		$row = db_fastquery( $query ) ;
		$article_id = $row['post_id'];
	}
	$query = " UPDATE ".BULLETIN_TABLE." SET post_count=post_count+1 ".
		 " WHERE post_id = ".$article_id ;
	
	$db = db_connect();
	$db->sql_query($query);
}

?>