<?php
/***************************************************************************
 *   Licence               : Swings (C) DE-MO Studio in Taiwan 
 ***************************************************************************/
// Delete DDNS IPs

require_once('../includes/dm_db.php');
 start();
 
function start(){
	$column = 'counter_ip' ;
	$table = 'dm_admin_counter';
	$arr_ips = array('202.108.11.106');
	$where_query ='';
	
	for($i=0 ; $arr_ips[$i] ; $i++ ){

		$where_query = $where_query . $column . " = '".$arr_ips[$i] ."'" . ($arr_ips[$i+1] ? ' OR ' : '');
	}
	
	$query = 'DELETE FROM ' .$table. ' WHERE ' . $where_query ;
	die($query);
	
	$db = db_connect();
	$db->sql_query($query);
}


?>