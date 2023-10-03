<?php
/***************************************************************************
*	ID			: style.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.10.22
*	Author2		: Swings Huang	2007.11.10
*	Author3		: -----------	----------
*
*	Information		: 
*		List specifical items
***************************************************************************/

// Import config
require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm_classes.php');
require_once( INCLUDE_PATH . 'dm.function.default.php');	// Items function
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template
require_once( INCLUDE_PATH . 'dm_photo_rule.php');

define('SLASH','/');
define('UNDERLINE','_');

//Error detect
if( !isset($_GET['i']) ) die("No Data in this Page ! 請由正常管道進入");

// Table information
if(!defined('PROFILE_TABLE'))
	define('PROFILE_TABLE','dm_street_profile');

//Row Information
define('ITEM_ROW_NUM', 4 ); // 4 per low
define('ITEM_PAGE_NUM', 16 );

// Convert page info
$page = $_GET['page'] ? (integer) $_GET['page'] : 1 ;
$item = $_GET['i'] ;
$sex = $_GET['s'] ?  $_GET['s'] : 'all' ;	// all, male & female is default
$sex = strtolower($sex);

$brands = fetch_item_data( $item , $page , $sex) ;
$ad_brands = fetch_random_brands( '12' );

// Calculate page urls
$total_row;	// Total db result in this page
$page_links = list_page_urls( $page,ITEM_PAGE_NUM , $total_row );

#======== Template =========
$TPL_generator = new FunctionBlock();

// Template : PageNum Section
$tpl_pagenum = $TPL_generator->create_template( 'block_pagenum.html' );
$tpl_pagenum->assign('page_links' , $page_links);
$tpl_pagenum->assign('current_page',$page);

// Template : Set Main Content
$TPL_generator = new FunctionBlock ;
$tpl_content = $TPL_generator->create_template( 'page_content_itemsearch_list.html' );
$tpl_content->assign('brands' , $brands );
$tpl_content->assign('gender',$sex);
$tpl_content->assign('item_rownum' , ITEM_ROW_NUM );
$tpl_content->assign('item_pagenum' , ITEM_PAGE_NUM );
$tpl_content->assign('slide_imgsrc' , $ad_brands['img_src']);
$tpl_content->assign('slide_imgurl' , $ad_brands['img_url']);
$tpl_content->assign('slide_kindtxt' , $ad_brands['kind_txt']);
$tpl_content->assign('slide_kindurl' , $ad_brands['kind_url']);
$tpl_content->assign('block_pagenum',$tpl_pagenum->fetch());

// Template : Rapid Load DEMO-Template !!
$tpl = $TPL_generator->skin( 'home' );
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：單品檢索 ');

$tpl->display();

//回傳所有資料另,並含圖片路徑
function fetch_item_data( $no_prefix , $page , $sex){
	// parse string to int
	settype($page, "integer"); 
	$page = $page-1; // For limit 
	
	$sep = '\_' ; 	// sep & esc
	
	//Convert Sex query
	if( $sex == 'm' ){
		$sex = " AND profile_style >= 'E' " ;
	}
	else if(  $sex == 'f' ){
		$sex = " AND profile_style <= 'D' " ;
	}
	else if( $sex == 'all' || $sex == null){
		$sex = "" ;
	}
	
	# 應另開表格!!後續修改! Swings Huang
	$where_query =
	"  WHERE ".
	" ((profile_brand1 LIKE '$no_prefix$sep%' AND profile_brand1 IS NOT NULL ) OR" .
	" (profile_brand2 LIKE '$no_prefix$sep%' AND profile_brand2 IS NOT NULL ) OR" .
	" (profile_brand3 LIKE '$no_prefix$sep%' AND profile_brand3 IS NOT NULL ) OR" .
	" (profile_brand4 LIKE '$no_prefix$sep%' AND profile_brand4 IS NOT NULL ) OR" .
	" (profile_brand5 LIKE '$no_prefix$sep%' AND profile_brand5 IS NOT NULL ) OR" .
	" (profile_brand6 LIKE '$no_prefix$sep%' AND profile_brand6 IS NOT NULL ) OR" .
	" (profile_brand7 LIKE '$no_prefix$sep%' AND profile_brand7 IS NOT NULL ) OR" .
	" (profile_brand8 LIKE '$no_prefix$sep%' AND profile_brand8 IS NOT NULL ) OR" .
	" (profile_brand9 LIKE '$no_prefix$sep%' AND profile_brand9 IS NOT NULL ) )" . $sex ;
	
	$query = 
	" SELECT profile_id, profile_date, profile_style, profile_brand1 , ".
	" profile_brand2 , profile_brand3 , profile_brand4, profile_brand5, profile_brand6, profile_brand7,".
	" profile_brand8 , profile_brand9 , profile_brand10 ".
	" FROM dm_street_profile ".$where_query . 
	" LIMIT " . ($page*ITEM_PAGE_NUM ) .",".ITEM_PAGE_NUM  ;
		
	//die($query);
	$db = db_connect();
	
	// Excute Query
	if( ! ($result = $db->sql_query($query)) ){
		die('Item information Not Exist ! ERROR');
		echo $db->sql_error();
	}
	
	// Start Fetch 
	$arr_all_brands = array();
	while( $row = $db->sql_fetchrow($result) ){
		array_push( $arr_all_brands , discard_item( &$row , $no_prefix ) ) ;
		$count++;
		//print_r($row);
	}
	
	// count for page block
	$GLOBALS['total_row'] = db_table_countv2("SELECT count(*) AS c FROM dm_street_profile ". $where_query ) ;
	
	return $arr_all_brands ;
}

// Descard useless items , 剔除沒用的資料欄位,只留下指定單品
function discard_item( $row , $search_key ){
	$NULL_NAME = '不明' ;
	$NULL_PRICE = '不詳' ;
	$NULL_PLACE = '未知' ;

	// $arr_data , one profile's columns, 一個街拍的完整個人資料
	foreach( $row as $str_item ){
		$arr_t = explode( '_' , $str_item );

		// First value is item no
		if( $arr_t[0]==$search_key){
			// Find !!
			$item = array();
			// Push result data 
			$item['name'] = ($temp = $arr_t[1] ) ? $temp : $NULL_NAME ;
			$item['price'] = ($temp = $arr_t[2] ) ? $temp : $NULL_PRICE ;
			$item['place'] = ($temp = $arr_t[3] ) ? $temp : $NULL_PLACE ;
			
			// Get photo Name ~
			$item['image'] = rule_photo_path($row['profile_date'] , 'root').
						rule_photo_name( $row['profile_id'],
								$row['profile_date'] ,
								$row['profile_style'], get_brand_photo_infix( $search_key ) );
								 //取得與brand編號相呼應的照片號碼
			$item['url'] = rule_detail_url($row['profile_id'],
								$row['profile_date'] ,
								$row['profile_style'] , false , $search_key);
								// 該圖片點擊後所連結之 URL
					
			//temp null handle
			if( !file_exists($item['image']) )
				$item['image'] = 'images/photo_search_fail.jpg';
				
			return $item ;
		}
	}
	return null ;
}


// 隨機取出數個單品給AD跑馬燈用
function fetch_random_brands( $number ){
	$brands = array();
	$no_list = get_brand_no() ; // no 2 name
	
	// Connect to db
	$db = db_connect();
	
	$query = "SELECT * FROM dm_street_profile  ORDER BY rand() LIMIT ".$number ;
	
	if( !( $result = $db->sql_query($query) ) ){
		die("DB Error");	
	}
	
	//under is temp
		$img_src = array();
		$img_url = array();
		$kind_txt = array();
		$kind_url = array();
	while( $row = $db->sql_fetchrow($result) ){

		
		// 8~17 , GET not null data
		while( 1 ){
			$fix = rand(8,17) ;
			if( strlen($row[ $fix ]) >= 4 ){
				$str_brand = $row[ $fix ];
				break;
			}	
		}
		$arr_brand = explode( '_' , $str_brand );
		
		// Start handle
		// Get photo Name ~
		$src = rule_photo_path($row['profile_date'] , 'root').
					rule_photo_name( $row['profile_id'],
							$row['profile_date'] ,
							$row['profile_style'], get_brand_photo_infix( $arr_brand[0] ) );
		if( !file_exists( $src ) )
			$src = 'images/photo_search_fail.jpg' ;
		array_push( $img_src , $src  );
							 //取得與brand編號相呼應的照片號碼
		$t_url = rule_detail_url($row['profile_id'],$row['profile_date'] ,$row['profile_style']) . '&i='. $arr_brand[0] ;
							// 該圖片點擊後所連結之 URL		 
		array_push( $img_url ,  str_replace( '&' , '@' , $t_url ) );
		array_push( $kind_txt ,  $no_list[$arr_brand[0]] ) ; //種類文字
		
		array_push( $kind_url ,  substr( $_SERVER['PHP_SELF'] , 1) .'?i='.$arr_brand[0] ); // discard /

	}
	$brands['img_src'] = implode( ',' , $img_src);		
	$brands['img_url'] = implode( ',' , $img_url);		
	$brands['kind_txt'] = implode( ',' , $kind_txt);
	$brands['kind_url'] = implode( ',' , $kind_url);	
	
	//print_r($brands);
	return $brands ;
}

?>