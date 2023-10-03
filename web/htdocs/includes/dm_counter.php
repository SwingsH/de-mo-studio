<?php
/***************************************************************************
*	ID			: dm_counter.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.14
*	Author2		: -----------	----------
*
*	Information		: 
*		Online counter and visited counter
***************************************************************************/

require_once('dm_config.php');
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm_classes.php');
require_once( INCLUDE_PATH . 'dm.function.default.php');

define('REALTIME_TABLE','dm_online_counter');

define('ITVL_SECOND', 1200 );

function counter(){
	session_start();
	$db = db_connect();
	if(!isset($client_ip))
		$client_ip = get_client_ip();
	$query = "SELECT * FROM dm_admin_counter WHERE counter_sid='".session_id().
			"' AND counter_time >= ". ( time() - ITVL_SECOND ) .
			" AND counter_ip = '".$client_ip ."' " ;
	$result = $db->sql_query( $query );
	$row = mysql_num_rows( $result );
	if($row >=1){
		return count_realtime_online();	
	}
	
	if(isset($_SESSION['visited'])){
		counter_save( true );
		return count_realtime_online();
	}
	else{
		counter_save();
		return count_realtime_online();
	}
}

function counter_save( $is_update = false ){
	$client_sid = counter_session();
	$db = db_connect();
	
	$client_ltime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
	$client_mtime = date('Y/m/d-H:i:s');
	//$client_ip =( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
	$client_ip = get_client_ip();
	
	if( $is_update ){
		$query = " UPDATE dm_admin_counter SET counter_time = ".$client_ltime .
			" , counter_time_m = '".$client_mtime ."' WHERE counter_sid = '". $client_sid ."' ";
		$db->sql_query($client_query);
		//die( $query  );
		return ;
	}
	$client_query = "INSERT INTO dm_admin_counter VALUES('".
		$client_sid."','".
		$client_ip."','".
		$client_ltime."','".
		$client_mtime."') ";
	
	$db->sql_query($client_query);
}

function counter_session(){
	$_SESSION['visited'] = 1 ;
	return session_id();
}
function count_realtime_online(){
	$db = db_connect();
	$time = time();
	$count_time = $time - ITVL_SECOND ;
	$query = " SELECT count( counter_ip ) AS total FROM dm_admin_counter ".
		" WHERE counter_time >= '". $count_time ."' " ;
	
	$result = $db->sql_query( $query );
	$row = $db->sql_fetchrow( $result );
	//die( $row['total']  );
	return update_online( $row['total'] );
}
function update_online( $number ){
	$db = db_connect();
	$query = "UPDATE ".REALTIME_TABLE ." SET online_total = ".$number ;
	
	$result = $db->sql_query( $query );
	$row = $db->sql_fetchrow( $result );
	
	// Get
	$query = "SELECT online_total AS total FROM ".REALTIME_TABLE. " LIMIT 1 ";
	$result = $db->sql_query( $query );
	$row = $db->sql_fetchrow( $result );
	
	return $row['total'] == 0 ? 1:$row['total'] ;
}
/*
echo $_SERVER['REMOTE_ADDR'];

  echo ">>> 第 一 頁 <<< <br />";
  if ( !empty($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
    echo "有經過期他代理主機：".$_SERVER["HTTP_X_FORWARDED_FOR"];
    $temp_ip = split(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
    $user_ip = $temp_ip[0];
  } else {
    $user_ip = $_SERVER["REMOTE_ADDR"];
  }
 */
?>