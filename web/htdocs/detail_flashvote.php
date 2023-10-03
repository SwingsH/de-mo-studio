<?php
/***************************************************************************
*	ID			: detail_flashvote.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.07
*	Author2		: -----------	----------
*	Information		: 
*		Print vote html iframe , this phph use to resolve domain error in amfphp
***************************************************************************/

require_once( 'includes/dm_config.php');
require_once( INCLUDE_PATH . 'dm.function.default.php' );
require_once( INCLUDE_PATH . 'dm.class.template_generator.php' );	//Fast Load template

$number = $_GET['number'];
$voted = $_GET['voted'];
$did = $_GET['did'];

$TPL_Generator = &new FunctionBlock();

$tpl_vote = $TPL_Generator->create_template( 'content_flash_vote.html' );
$tpl_vote->assign('number',$number);
$tpl_vote->assign('voted',check_voted( $_GET['did'] ));
$tpl_vote->assign('did',$did);
$tpl_vote->display();


//Notice : diff domain error of session
function check_voted($did){
	@session_start();
	//if(isset($_SESSION['voted_did_'.$did])){
	if( check_votelog( $did , session_id() , get_client_ip() ) ){
		return "yes";
	}
	else{
		return "no";
	}
}

function check_votelog( $did , $sid , $ip){
	$db = db_connect();
	$log = &new ErrorLog( INCLUDE_PATH . 'log/');
	$is_voted = false ;
	
	// Check Log
	$query = " SELECT * FROM dm_street_votelog WHERE vote_ip = '".$ip."' ".
	" AND vote_time >= " . ( time() - 72000 ) ." AND vote_pid = ".$did ;
	
	$result = $db->sql_query($query);
	
	$rownum = mysql_num_rows( $result );
	if( $rownum >= 1 ){
		$log->save( 'PID:'.$did .' IP:'.$ip. ' , 24小時內已投過票');
		$is_voted = true ;
		return true ;
	}
	else{
		$log->save(  'PID:'.$did .' IP:'.$ip. '24小時內還沒有投過票');
		$is_voted = false ;
	}
	
	// Save log 
	$query = " INSERT INTO dm_street_votelog(vote_pid,vote_count,vote_time,vote_sid,vote_ip) ".
	" VALUES(".$did ." , 0 , ".time().",'".$sid."' ,'".$ip."' ) ";
	
	$result = $db->sql_query($query);
	return false ;
}
?>