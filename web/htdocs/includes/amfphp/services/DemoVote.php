<?php
/***********************************
*		2007.08.06
*		2007.11.13 - Bad code , must refractory soon.
*		DemoVote.php  
* 		(C) Swings @ DE-MO.com.tw
************************************/

require_once('../../dm_db.php');
require_once('../../dm_classes.php');
require_once('../../dm.function.default.php');

class DemoVote
{
	function DemoVote()
	{
		$this->methodTable = array
		(
			"vote_model" => array
			(
				"access" => "remote",
				"description" => "Pings back a message"
			)
		);
 	}
	function vote_model($model_id ){ 
		if(!$model_id) return "no id" ;
		return insert_vote($model_id);
	}
}

function insert_vote( $did ){
	$arr_ans = array();
	$db = db_connect();
	
	@session_start();
	$_SESSION['voted_did_'.$did] = date('Y/m/d-H:i:s');

	$log = &new ErrorLog('../../log/');
	$log->save("DemoVote.php Vote NO: " .$did ." " .session_id()." FROM ".$_SERVER['HTTP_HOST']. " IP:".get_client_ip());

	// Upadte Log db
	$is_voted = update_votelog( $did , session_id() , get_client_ip() );
	
	//$lc = new ListCache("test.txt",array('did'=>$_SESSION[$did]));
	//$lc->cache();
	
	$query = "UPDATE dm_street_profile SET profile_vote = profile_vote+1 WHERE profile_id = ".$did ;
	if($result = $db->sql_query($query) ){
		$arr_ans['finish'] = "yes";
	}
	else{
		$arr_ans['finish'] = "no";
	}
	
	$query = "SELECT profile_vote FROM dm_street_profile WHERE profile_id = ".$did;
	//$log->save("Query : " . $query );
	$result = $db->sql_query($query) ;
	$row = $db->sql_fetchrow($result) ;
	$arr_ans['number'] = $row['profile_vote'];
	$log->save("Number : " . $arr_ans['number'] );
	
	return $arr_ans;
	
}

function update_votelog( $did , $sid , $ip){
	$db = db_connect();
	$log = &new ErrorLog('../../log/');
	$is_voted = false ;
	
	// Check Log
	$query = " SELECT * FROM dm_street_votelog WHERE vote_ip = '".$ip."' ".
	" AND vote_time >= " . ( time() - 72000 ) ." AND vote_pid = ".$did ;
	
	$result = $db->sql_query($query);
	
	$rownum = mysql_num_rows( $result );
	if( $rownum >= 1 ){
		//$log->save( 'PID:'.$did .' IP:'.$ip. ' , 24小時內已投過票');
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