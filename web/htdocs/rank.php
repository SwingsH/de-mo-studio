<?php
/***************************************************************************
*	ID			: rank.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.09.08
*	Author2		: Swings Huang	2007.11.13
*	Author3		: -----------	----------
*	Information		: 
*		List the Model profile by his/her vote number
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

// Table information
if(!defined('PROFILE_TABLE'))
	define('PROFILE_TABLE','dm_street_profile');

//Row Information
define('RANK_ROW_NUM', 5 ); // 5 Profiles per low
define('RANK_PAGE_NUM', 15 );

// Convert page info
$page = $_GET['page'] ? (integer) $_GET['page'] : 1 ;
$sex = $_GET['s'] ? $_GET['s'] : 'f' ;

$profiles = fetch_rank_data( $sex , $page);
//print_r( $profiles );
#======== Template =========
$TPL_generator = &new FunctionBlock();

// Template : Set Main Content
$tpl_content = $TPL_generator->create_template( 'page_content_ranklist.html' );
$tpl_content->assign('profiles' , $profiles );

// Template : Rapid Load DEMO-Template !!
$tpl = $TPL_generator->skin( 'home' );
$tpl->assign( 'page_main_content' , $tpl_content->fetch() );
$tpl->assign( 'page_title' , 'DE-MO街拍流行情報站：人氣排行 ');

$tpl->display();

function fetch_rank_data($sex , $page){
	if(empty($sex)){
		die("No Data in this Page ! 請由正常管道進入");
	}
	
	$profiles = array();
	$sex_query = $sex == 'f' ? " profile_style <= 'D' " : " profile_style >='E'";
	
	// parse string to int , for limit 
	$page = $page ? $page-1 : 0 ;
	
	// Declare Query , limit value depend on page
	$query = "SELECT profile_evaluation , profile_id , profile_style , profile_date , profile_name , profile_age , profile_tall ,profile_location , profile_vote"
		." FROM ".PROFILE_TABLE . " WHERE " . $sex_query . " ORDER BY profile_vote DESC , profile_date DESC LIMIT " .
		" 0 , ".RANK_PAGE_NUM  ;
	 
	//Start Database connect
	$db = db_connect();
	
	// Excute Query
	if( ! ($result = $db->sql_query($query)) ){
		die('Rank information Not Exist ! ERROR');
	}

	while( $row = $db->sql_fetchrow( $result ) ){
		$profile = array('id'=> sprintf('%06d', $row['profile_id']),
					'name'=>$row['profile_name'] ,
					'age'=>$row['profile_age'] ,
					'tall'=>$row['profile_tall'] ,
					'vote'=>$row['profile_vote'] ,
					'eva'=>$row['profile_evaluation'],
					'imgsrc'=> rule_photo_path( $row['profile_date'] , 'root') .'n/'.
						rule_photo_name( $row['profile_id'],$row['profile_date'],$row['profile_style']) ,
					'url'=>rule_detail_url( $row['profile_id'],$row['profile_date'],$row['profile_style'])
					);
		array_push( $profiles , $profile );
	}
	return $profiles ;
}


function handle_one_row( &$db, &$result , &$rowid  ){
	$link = "" ; $path = "" ;
	$arr_profile_datas = array();

	for( $i=0 ; ; ){
		// No data check 
		if( !($row = $db->sql_fetchrow($result))){
			// If No data , and Null in this row's First fetch  , Means it's really empty and finished , 
			// We don't need to do anything , return false 
			if($i==0 ){
				return false ;
			} 
			// If No data , and It isn't this row's First fetch , just break and Set TPL  
			break ;
		}
		// Handle Profile Data
		
		array_push($arr_profile_datas ,$profile_data );
		
		$link = $link . get_pic_link( $row['profile_id'] , $row['profile_date'] , $row['profile_style'] ) ."," ;
		$path = $path . get_pic_path( $row['profile_id'] , $row['profile_date'] , $row['profile_style'] ). ",";
		
		// One Row only have 5 Profiles , If Overflow , stop it !
		if( ++$i >= RANK_ROW_NUM ) break ;
	}
	
	
	// Start Setup Template
	$tpl_rank_row = &new Template( $root_path .'template/rank_profile_row.tpl');
	$tpl_rank_row->set('rank_link',$link);
	$tpl_rank_row->set('rank_path',$path);
	// set profile data
	$tpl_rank_row->set('rank_datas',$arr_profile_datas);
	$tpl_rank_row->set('rank_rownum',RANK_ROW_NUM );
	$tpl_rank_row->set('rank_rowid',$rowid++); // Increase The Row ID
	//echo $tpl_style_row->fetch();
	return $tpl_rank_row;
}

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
	$result = rule_photo_path($date);
	
	// Using dm_photo_rule.php get The photo Name
	$result = $result . rule_photo_name($id, $date, $style);
	return $result ; 
}
function get_pic_link($id, $date, $style){
	// We use '@' Because the JavaScript will error in '&'
	return "did=".sprintf('%06d', $id ) . "@date=" .substr( $date ,2,6)."@style=" .$style ;
}



?>