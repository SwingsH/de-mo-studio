<?php
/***************************************************************************
*	ID			: style.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.09.08
*	Author2		: Swings Huang	2007.11.08
*	Author3		: -----------	----------
*
*	Information		: 
*		List all Snapped profiles by Style
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm_classes.php');
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template
require_once( INCLUDE_PATH . 'dm_photo_rule.php');
//require_once( INCLUDE_PATH . 'dm_template.php');

// require_once($root_path . 'includes/dm_template.php');

define('SLASH','/');
define('UNDERLINE','_');

// Table information
define('PROFILE_TABLE','dm_street_profile');
define('PROFILE_ID','profile_id');
define('PROFILE_BRAND_PREFIX','profile_brand');
define('PROFILE_BRAND_MAX', 10 );

//Row Information
define('STYLE_ROW_NUM', 5 );
define('STYLE_PAGE_NUM', 20 );

// Convert page info
$Page = $_GET['page'] ? (integer) $_GET['page'] : 1 ;

//
$TPLgenerator = &new FunctionBlock();

// Fetch TPL by row
$arr_stylehtmls = fetch_style_data($_GET['tid'],$Page);

// Template : PageNum Section
$tpl_pagenum = $TPLgenerator->create_template( 'block_pagenum.html' );
$tpl_pagenum->assign('page_links' , handle_stlpage_counts( $Page , STYLE_PAGE_NUM) );
$tpl_pagenum->assign('current_page',$Page);

// Template : Main content Section
$tpl_main = $TPLgenerator->create_template( 'page_content_stylelist.html' );
$tpl_main->assign( 'block_pagenum' , $tpl_pagenum->fetch() );
$tpl_main->assign( 'block_rows' , $arr_stylehtmls );
$tpl_main->assign( 'style_txt' , parse_style( $_GET['tid'] ) );

//======== DEMO default Skin =========
// Template : Rapid Load DEMO-Template !!
$tpl = $TPLgenerator->skin( 'home' );
$tpl->assign( 'page_main_content' , $tpl_main->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站： 風格穿搭總覽 ');
$tpl->display();

/*
$tpl_style = &new Template( $root_path.'template/style_profile.tpl');
$tpl_style->set('profile_rows', $arr_tpls );
// handle_stlpage_counts
$tpl_style->set( 'urls',handle_stlpage_counts( $Page , STYLE_PAGE_NUM) );
$tpl_style->set( 'curren_page', $Page );

// Page Scroll TPL
$tpl_page_scroll = &new Template( $root_path.'template/index_page_scroll.tpl');
$tpl_page_scroll->set('page_contain',$tpl_style );

// Page TPL
$tpl_page = &new Template( $root_path .'template/index_skin.tpl');
$tpl_page->set('page_title', 'DEMO流行情報站：風格總覽' );
$tpl_page->set('page_contain',$tpl_page_scroll );

echo $tpl_page->fetch();
*/

function fetch_style_data($tid , $page){
	if(empty($tid)){
		die("No Data in this Page ! 請由正常管道進入");
	}
	// parse string to int
	settype($page, "integer"); 
	$page = $page-1; // For limit 
	
	$query = "SELECT profile_id , profile_style , profile_date , profile_name , profile_age , profile_tall , profile_location "
		." FROM ".PROFILE_TABLE . " WHERE profile_style = '" . trim($tid) . "' " . " ORDER BY profile_date DESC LIMIT " .
		 ($page*STYLE_PAGE_NUM ) .",".STYLE_PAGE_NUM  ;
		 // Limited by page
		 
	$db = db_connect();
	if( ! ($result = $db->sql_query($query)) ){
		die('Style information Not Exist ! ERROR');
	}
	$row_id = 1 ;
	$arr_row_htmls = array() ;
	
	// Fetchrow
	$count = 0 ;
	$row_id = 1 ;
	$onerow_profiles = array();
	$row_links = "";
	$row_paths = "";
	while( $row = $db->sql_fetchrow($result) ){
		$profile = renew_profile( $row );	// Renew+refresh profile data
		array_push($onerow_profiles , $profile );	// All data of one row
		$row_links = $row_links . get_pic_link( $profile['id'] , $profile['date'] , $profile['style'] ) ."," ;
		$row_paths = $row_paths . get_pic_path( $profile['id'] , $profile['date'] , $profile['style'] ) ."," ;
		$count++ ;
		
		// one row ,Overflow
		if( ($count%STYLE_ROW_NUM) == 0 ){
			// Get one row's HTML , and push in
			array_push( $arr_row_htmls , get_onerow_html( $row_id , $onerow_profiles , $row_links , $row_paths ) );
			$row_links ="";
			$row_paths = "";
			$onerow_profiles = array();
			$row_id++ ;
		}
	}
	
	//如果是在資料$row null 時,也就是一列數目未滿時就跳出,需再做一次html處理
	if( ( $row_id <= 4 ) && (( ($count-1)%STYLE_ROW_NUM) != 0 )  ){
		// Get one row's HTML
		array_push( $arr_row_htmls , get_onerow_html( $row_id , $onerow_profiles , $row_links , $row_paths ) );
	}
	
	//while( $tpl = handle_one_row( &$db , &$result , &$row_id  ) ){
		//array_push($arr_row_htmls ,$tpl );
	//}
	
	return $arr_row_htmls ;
}
// parse brand using xml ,soon
function parse_style( $style = null){
	$arr_stylelist = array('A'=>'日系美眉','B'=>'美式休閒','C'=>'時尚名媛','D'=>'優雅淑女',
					'E'=>'裏原宿風','F'=>'流行嘻哈','G'=>'休閒型男','H'=>'都會雅痞');
	if(!style) return "其它風格";
	return $arr_stylelist[strtoupper($style)];
}
function get_onerow_html(  $row_id , $profiles , $row_links , $row_paths ){
	$tpl = $GLOBALS['TPLgenerator']->create_template('style_profile_row.html');
	$tpl->assign('style_rownum', STYLE_ROW_NUM);
	$tpl->assign('style_rowid', $row_id);
	$tpl->assign('style_datas', $profiles);
	$tpl->assign('style_path', $row_paths);
	$tpl->assign('style_link', $row_links);
	return $tpl->fetch();
}

// Renew one profile and Returns
function renew_profile( $row ){
	$one_pro = array();
	$one_pro['id'] = $row['profile_id'] ;
	$one_pro['style'] = $row['profile_style'] ;
	$one_pro['date'] = $row['profile_date'] ;
	$one_pro['name'] = $row['profile_name'] ;
	$one_pro['age'] = $row['profile_age'] ;
	$one_pro['tall'] = $row['profile_tall'] ;
	$one_pro['location'] = $row['profile_location'] ;
	return $one_pro ;
}

// 處理下方的頁面跳轉連結區
function handle_stlpage_counts( $current_page ,$num_per_page ){
	$total = db_table_count( PROFILE_TABLE , 'profile_id' , " profile_style = '" . strtoupper( $_GET['tid'] )."'" );
	$pc = new PageCalculator( $total , $num_per_page);
	
	// Duplicate the get vars
	$keys = $_GET;
	$arr_url = array();
	for( $i=1 ; $i <= $pc->get_last_page() ; $i++ ){
		// Change the page GET value
		$keys['page']= $i ;
		// Build URLs
		$url = $_SERVER['SCRIPT_NAME'] . '?' . http_build_query( $keys );
		array_push( $arr_url , $url );
	}
	//print_r($arr_url);
	return $arr_url ;
}

//deleted
function handle_one_row( &$db, &$result , &$rowid  ){

	$link = "" ; $path = "" ;
	$arr_profile_datas = array();
	for( $i=0 ; ; ){
		// No data check 
		if( !($row = $db->sql_fetchrow($result)) ){
			// If No data , and Null in this row's First fetch  , Means it's really empty and finished , 
			// We don't need to do anything , return false 
			if($i==0){ 
				return false ; 
			}
			// If No data , and It isn't this row's First fetch , just break and Set TPL  
			break ;
		}
		// Handle Profile Data
		$profile_data = array('id'=> sprintf('%06d', $row['profile_id']),'name'=>$row['profile_name'] ,
							'age'=>$row['profile_age'] ,'tall'=>$row['profile_tall'] );
		array_push($arr_profile_datas ,$profile_data );
		
		$link = $link . get_pic_link( $row['profile_id'] , $row['profile_date'] , $row['profile_style'] ) ."," ;
		$path = $path . get_pic_path( $row['profile_id'] , $row['profile_date'] , $row['profile_style'] ).",";
		
		// One Row only have 5 Profiles , If Overflow , stop it !
		if( ++$i >= STYLE_ROW_NUM ) break ;
	}
	//echo "Path:".$path ."  row ID:".$rowid."<p> " ;
	
	// Start Setup Template
	$tpl_style_row = &new Template( $root_path .'template/style_profile_row.tpl');
	$tpl_style_row->set('style_link',$link);
	$tpl_style_row->set('style_path',$path);
	
	// set profile data
	$tpl_style_row->set('style_datas',$arr_profile_datas);
	$tpl_style_row->set('style_rownum',STYLE_ROW_NUM );
	$tpl_style_row->set('style_rowid',$rowid++); // Increase The Row ID
	//echo $tpl_style_row->fetch();
	return $tpl_style_row;
}

//deleted
function fetch_row2template( $db , $result){
	if(! ($row = $db->sql_fetchrow($result)) ){
		return false ;
		die('Style data in Database is empty ! ERROR');
	}
	// Get Profile mini pic
	$pic = get_pic_path($row['profile_id'] , $row['profile_date'] , $row['profile_style'] );
	$row['pic'] = $pic ; 
	
	/* set template
	$tpl_style = &new Template('template/style_profile.tpl');
	$tpl_style->set('pro_image',$row['pic']);
	$tpl_style->set('pro_name' ,$row['profile_name']);
	$tpl_style->set('pro_location' ,$row['profile_location']);
	$tpl_style->set('pro_date' ,$row['profile_date']);
	*/
	return $tpl_style ; 
}
// Call dm_photo_rule.php
function get_pic_path($id, $date, $style){
	
	// Using dm_photo_rule.php get The photo Path
	$result = rule_photo_path($date) . 'n/' ;
	
	// Using dm_photo_rule.php get The photo Name
	$result = $result . rule_photo_name($id, $date, $style );
	
	return $result ; 
}
function get_pic_link($id, $date, $style){
	// We use '@' Because the JavaScript will error in '&'
	return "did=".sprintf('%06d', $id ) . "@date=" .substr( $date ,2,6)."@style=" .$style ;
}


?>