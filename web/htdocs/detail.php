<?php
/***************************************************************************
*	ID			: detail.php
*	Licence		: Swings (C) DE-MO Studio in Taiwan 
*	Date		: 2007.08.17
*	Date		: 2007.10.22
*	Specification	: 
*		DEMO main function . Show the Street Snap profile data
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm.function.default.php');	// Items function
require_once( INCLUDE_PATH . 'dm_classes.php');		// Normal class
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template
require_once( INCLUDE_PATH . 'dm_photo_rule.php');
require_once( INCLUDE_PATH . 'dm_template.php');

if(!defined('SLASH')){
	define('SLASH','/');
}
if(!defined('UNDERLINE')){
	define('UNDERLINE','_');
}

// Table information
if(!defined('PROFILE_TABLE')){
	define('PROFILE_TABLE','dm_street_profile');
}
if(!defined('PROFILE_ID')){
	define('PROFILE_ID','profile_id');
}
if(!defined('PROFILE_BRAND_PREFIX')){
	define('PROFILE_BRAND_PREFIX','profile_brand');
}
if(!defined('PROFILE_BRAND_MAX')){
	define('PROFILE_BRAND_MAX', 10 );
}

$voted = check_voted( $_GET['did'] );

// Using dm_photo_rule.php get The photo Rule
$imgcache= rule_get_photocache($_GET['did'],$_GET['date'],$_GET['style']);
// Using dm_photo_rule.php get The photo Path
$imgpath = rule_photo_path('20'.$_GET['date']);
$imgfirst = get_firstload_photo();
//die($imgfirst);

// Using dm_photo_rule.php get The photo Path
$embed_imgpath = rule_photo_path('20'.$_GET['date'] , 'ab');
// Using dm_photo_rule.php get The photo Rule
$embed_imgcache= rule_get_photocache($_GET['did'],$_GET['date'],$_GET['style']);
//die($embed_imgpath);

// Database
$profile_row = fetch_profile($_GET['did']); //db fetch

// Fetch row by row
$brands = fetch_brand($profile_row); //fetch_brand will return an array

// Make Up Date Information
list($year,$month,$day) = parse_ddate( $_GET['date'] );

function fetch_profile($did){
	$db = db_connect();
	$query = "SELECT * FROM " .PROFILE_TABLE. " WHERE " .PROFILE_ID. " = " .$did ;
	// The page exist 2nd depend on DB data ! Check the DB data !
	if(!($result = $db->sql_query($query)) ){
		die('Profile information Not Exist ! ERROR');
	}
	// only has one result
	if(! ($profile_row = $db->sql_fetchrow($result)) ){
		die('Profile data in Database is empty ! ERROR');
	}
	// temp
	//$db->sql_query("UPDATE ".PROFILE_TABLE." SET profile_type = '" .$_GET['style']. "' WHERE ".PROFILE_ID. " = " .$did );
	return $profile_row;
}

function fetch_brand($row){
	$arr_brands = array();
	//parse_brand();
	//echo mysql_field_name($row);
	for($i=1; $i <= PROFILE_BRAND_MAX ; $i++){
		$str_brand = $row[PROFILE_BRAND_PREFIX . $i] ;
		if(!$str_brand) continue;
		$brand = parse_brand($str_brand);
		array_push($arr_brands, $brand );
	}
	return $arr_brands ;
}
function get_firstload_photo(){
	// have set
	if( !empty( $_GET['i'] )){
		// Get photo Name ~
		return rule_photo_name( $_GET['did'],
						'20'.$_GET['date'] ,
						$_GET['style'], get_brand_photo_infix( $_GET['i'] ) );
						 //取得與brand編號相呼應的照片號碼	
	}
	return false ;
}
// Parse brand using xml
function parse_brand($str_brand){
	//ini format and list
	$arr_typelist = get_brand_no(); 
	
	$arr_format = array('type','name','price','place','image','link'); // type_name_price_place
	$NULL_TYPE = '其他' ;
	$NULL_NAME = '不明' ;
	$NULL_PRICE = '不詳' ;
	$NULL_PLACE = '未知' ;
	
	//split column data
	$arr_mix = explode('_',$str_brand); // separator in the column is _
	
	// set type
	$brand[$arr_format[0]] = ( $temp = $arr_typelist[$arr_mix[0]] )? $temp : $NULL_TYPE ;
	//set name
	$brand[$arr_format[1]] = ($temp = $arr_mix[1]) ? $temp : $NULL_NAME;
	//set price
	$brand[$arr_format[2]] = ($temp = $arr_mix[2]) ? $temp : $NULL_PRICE;
	//set place
	$brand[$arr_format[3]] = ($temp = $arr_mix[3]) ? $temp : $NULL_PLACE;
	// set image
	$brand[$arr_format[4]] = 'photo/icon/' . sprintf('%02d',$arr_mix[0]) . '.jpg' ;
    	// set link
	//$brand[$arr_format[5]] = 'photo/icon/' . sprintf('%02d',strtoupper($style)) . '.png' ;
	
	//print_r($brand);
	return $brand ;
}

// parse brand using xml ,soon
function parse_style( $style = null){
	$arr_stylelist = array('A'=>'日系美眉','B'=>'美式休閒','C'=>'時尚名媛','D'=>'粉領OL',
					'E'=>'裏原宿','F'=>'Hip-Hop','G'=>'休閒型男','H'=>'都會雅痞');
	if(!style) return "其它風格";
	return $arr_stylelist[strtoupper($style)];
}

function parse_ddate($str_date){
	return array( STYLE_DATE_PREFIX . substr($str_date,0,2) ,
				substr($str_date,2,2), substr($str_date,4,2) ) ;
}

//=============Voted Function==============
function check_voted($did){
	@session_start();
	if(isset($_SESSION['voted_did_'.$did])){
		return "yes";
	}
	else{
		return "no";
	}
}
// Template start !! (Swings Huang)
// Actually , Template functions works as MovieClip and Liberary in ActionScript 
// Loading, initial, and display . One page could contains duplicated implements (from Liberary)

$TPL_generator = &new FunctionBlock();

$tpl_content = $TPL_generator->create_template( 'page_content_styledetail.html' );
// Brand Datas
$tpl_content->assign('brands',$brands);
$tpl_content->assign('voted' ,$voted);
$tpl_content->assign('vote_did' ,$_GET['did']);
$tpl_content->assign('vote_count' ,$profile_row['profile_vote']);
// Profile Data
$tpl_content->assign('imgcache', $imgcache);
$tpl_content->assign('imgpath', $imgpath);
$tpl_content->assign('imgfirst', $imgfirst);
$tpl_content->assign('embed_imgcache', $embed_imgcache);
$tpl_content->assign('embed_imgpath', $embed_imgpath);
$tpl_content->assign('embed_url', substr(DOMAIN,0,-1) . $_SERVER['PHP_SELF'].'?'.http_build_query($_GET) );
$tpl_content->assign('profile_style' , parse_style( $profile_row['profile_style']) );
$tpl_content->assign('profile_number' , sprintf('%06d',$profile_row['profile_id']));
$tpl_content->assign('profile_name' ,$profile_row['profile_name']);
$tpl_content->assign('profile_age' ,$profile_row['profile_age']);
$tpl_content->assign('profile_tall' ,$profile_row['profile_tall']);
$tpl_content->assign('profile_location' ,$profile_row['profile_location']);
$tpl_content->assign('profile_say' ,$profile_row['profile_say']);
$tpl_content->assign('profile_album' ,$profile_row['profile_album']);
$tpl_content->assign('profile_evaluation' ,$profile_row['profile_evaluation']);
$tpl_content->assign('profile_color' ,$profile_row['profile_color']);
$tpl_content->assign('profile_vote' ,$profile_row['profile_vote']);
$tpl_content->assign('year',$year);
$tpl_content->assign('month',$month);
$tpl_content->assign('day',$day);
$tpl_content->assign('domain','http://'.$_SERVER['HTTP_HOST'] .'/');
$tpl_content->assign('ipdomain', IPDOMAIN );

//======== DEMO default Skin =========
// Template : Rapid Load DEMO-Template !!
$tpl = $TPL_generator->skin( 'home' );
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站： Street Snap  ');

$tpl->display();

/*
$tpl_detail_brand = &new Template( ROOT_PATH.'template/detail_profile_brand.tpl');
$tpl_detail_brand->set('brands',$brands);
$tpl_detail_brand->set('voted' ,$voted);
$tpl_detail_brand->set('vote_did' ,$_GET['did']);
$tpl_detail_brand->set('profile_vote' ,$profile_row['profile_vote']);

$tpl_detail = & new Template( ROOT_PATH.'template/detail_profile.tpl');
$tpl_detail->set('title','My DE-MO : 街拍資訊');
$tpl_detail->set('detail_content', $tpl_detail_brand);
$tpl_detail->set('imgcache', $imgcache);
$tpl_detail->set('imgpath', $imgpath);
$tpl_detail->set('profile_link', ROOT_PATH.'/photo/icon/'.strtoupper($_GET['style']) . '.gif' );
$tpl_detail->set('profile_style' , parse_style( $profile_row['profile_style']) );
$tpl_detail->set('profile_number' , sprintf('%06d',$profile_row['profile_id']) );
$tpl_detail->set('profile_name' ,$profile_row['profile_name']);
$tpl_detail->set('profile_age' ,$profile_row['profile_age']);
$tpl_detail->set('profile_tall' ,$profile_row['profile_tall']);
$tpl_detail->set('profile_location' ,$profile_row['profile_location']);
$tpl_detail->set('profile_say' ,$profile_row['profile_say']);
$tpl_detail->set('profile_evaluation' ,$profile_row['profile_evaluation']);
$tpl_detail->set('profile_color' ,$profile_row['profile_color']);
$tpl_detail->set('profile_vote' ,$profile_row['profile_vote']);
$tpl_detail->set('profile_love' , parse_love( $profile_row['profile_love']) );
$tpl_detail->set('year',$year);
$tpl_detail->set('month',$month);
$tpl_detail->set('day',$day);
// echo $tpl_detail->fetch();

// Page TPL
$tpl_page = &new Template( ROOT_PATH.'template/index_skin.tpl');
$tpl_page->set('page_title','DE-MO街拍流行情報站： Street Snap ' );
$tpl_page->set('page_contain',$tpl_detail );
echo $tpl_page->fetch();
*/
?>