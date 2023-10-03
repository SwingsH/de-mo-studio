<?php
/***************************************************************************
*	ID			: dm_photo_rule.php
*	Licence		: Swings (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.08.18
*	Author		: Swings Huang	2007.10.22
*	Specification	: 
*		This code parse Input variables which about photos in special rules
***************************************************************************/


//Directory Information
if(!defined('DOMAIN')){
	define('DOMAIN','http://'. $_SERVER['HTTP_HOST'] .'/');
}
if(!defined('DM_PATH')){
	define('DM_PATH',''); //this
}
if(!defined('STYLE_PATH')){
	define('STYLE_PATH',''); //this
}
if(!defined('STYLE_PHOTO_PATH')){
	define('STYLE_PHOTO_PATH','photo/');
}
if(!defined('STYLE_PHOTO_FORMAT')){
	define('STYLE_PHOTO_FORMAT','.jpg');
}
if(!defined('STYLE_DATE_PREFIX')){
	define('STYLE_DATE_PREFIX','20');
}
if(!defined('STYLE_DETAIL_URL')){
	define('STYLE_DETAIL_URL' , 'detail.php');
}
if(!defined('STYLE_URL')){
	define('STYLE_URL' , 'style.php');
}

// The prefix path has slash , dir has no slash
// input date(6) ex: 070606
function rule_get_photocache( $did, $date , $style){
	$path_date = STYLE_DATE_PREFIX . substr($date,0,4) . SLASH   ;
	$path_pics = STYLE_PHOTO_PATH . $path_date ; //(STYLE_DATE_PREFIX . substr($date,0,4)) . SLASH ;
	
	$pic_name_prefix = $did .UNDERLINE. $date .UNDERLINE. $style .UNDERLINE ;
	$pic_prefix = $path_pics. $pic_name_prefix ;
	$pic_maxnum = 20 ;
	
	//declare result string 
	$current_pic = $pic_prefix .sprintf('%02d',1) . STYLE_PHOTO_FORMAT ; //first pic
	$current_cache = $pic_prefix.'00.che' ;
	$result = ''; 

	// Check if the dir or first pic exist 
	if(!is_dir($path_pics) || !file_exists($current_pic) ){
		// The page exist 1st depend on Photo File ! Check the Photo File !
		die('There has no Photo and Data in this page ! 請由正常管道進入');
	}

	// if the cache file not exist , create it !
	if(!file_exists($current_cache) ){
		for($i=0; $i <= $pic_maxnum ; $i++){
			$current_pic = $pic_prefix .sprintf('%02d',$i) . STYLE_PHOTO_FORMAT ;
			if(file_exists($current_pic) ){
				$result = $result . $pic_name_prefix . sprintf('%02d',$i) . STYLE_PHOTO_FORMAT. ','  ;
			}
		}
		$lc = new ListCache($current_cache,array('files'=>$result));
		$lc->cache();
	}
	//else {} already have cache file !!
	
	//return the cache file 
	return basename($current_cache) ;
}
// Return the Photo's path , input date(8) ex: 20070606
function rule_photo_path( $date , $absolute = false){
	$swfpath2root = '../' ; // the swfpath to root
	
	if($absolute == 'shortest')
		return substr($date,0,6) . '/'  ;
	if($absolute == 'root')
		return STYLE_PHOTO_PATH . substr($date,0,6) . '/'  ;
	if(!$absolute)
		return $swfpath2root .STYLE_PHOTO_PATH . substr($date,0,6) . '/'  ;
	//die(DOMAIN);
	return DOMAIN.DM_PATH.STYLE_PATH.STYLE_PHOTO_PATH .  substr($date,0,6) . '/'   ;
}
// Return the Photo's name , input id(?),date(8),style(1),no(1);
function rule_photo_name( $id, $date, $style , $picno = 1 , $postfix = null ){
	if( $postfix != null ){
		return sprintf('%06d', $id ).'_'. substr( $date ,2,6) .'_'.strtoupper($style).
		'_'. sprintf('%02d', $picno ). $postfix  .STYLE_PHOTO_FORMAT;	
	}
	return 
	sprintf('%06d', $id ).'_'. substr( $date ,2,6) .'_'.strtoupper($style).
	'_'. sprintf('%02d', $picno ).STYLE_PHOTO_FORMAT;
}

// Return the Detail URL , input id(?),date(8),style(1);
function rule_detail_url( $id, $date, $style , $absolute = false , $item = 0 ){
	if($item ==0 ){
		$GETURL = array( 'did'=>sprintf('%06d',$id ) , 'date'=>substr($date,2,6) , 'style'=>$style );
	}
	else{
		$GETURL = array( 'did'=>sprintf('%06d',$id ) , 'date'=>substr($date,2,6) , 'style'=>$style ,'i'=>$item );
	}
	
	if(!$absolute)
		return STYLE_DETAIL_URL .'?'. http_build_query($GETURL);
	else
		return DOMAIN . STYLE_DETAIL_URL .'?'. http_build_query($GETURL);
}

function rule_style_url( $style , $absolute = false){
	if(!$absolute)
		return STYLE_URL .'?'. http_build_query( array('tid'=>strtoupper($style)) );
	else
		return DOMAIN . STYLE_URL .'?'. http_build_query( array('tid'=>strtoupper($style)) );
}

function rule_photo_abpath(){
	return DOMAIN.STYLE_PHOTO_PATH ;
}
function rule_abpath(){
	return DOMAIN ;
}
?>