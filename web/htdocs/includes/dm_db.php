<?php
//  DE-MO DB Class

require_once('dm_config.php');
require_once('dm_sql_db.php');
require_once('dm.function.default.php');

function db_connect(){
	$db = new sql_db( DB_HOST , DB_USER , DB_PASSWORD , DB_NAME , false );
	$db->sql_query("SET NAMES 'UTF8'");
	return $db ;
}

function db_table_count( $tb_name , $column_name = null ,$query_where = null){
	$db = db_connect();
	
	// SQL count funciton
	$query_count = $column_name ? 'count('.$column_name.') ' : 'count(*) ' ;
	
	// Build Where query 
	$query_where = $query_where ? " WHERE ".$query_where  : "";
	
	$result = $db->sql_query('SELECT ' .$query_count. " AS c FROM ".$tb_name .$query_where );
	$row = $db->sql_fetchrow($result);
	
	return $row['c'] ;
}
// Get all post types
function db_bulletin_type(){
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

// 隨機取出數個單品
function db_random_brands( $number ){
	$brands = array();
	$no_list = get_brand_no() ; // no 2 name

	$NULL_NAME = '不明' ;
	$NULL_PRICE = '不詳' ;
	$NULL_PLACE = '未知' ;
	
	// Connect to db
	$db = db_connect();
	
	$query = "SELECT * FROM dm_street_profile  ORDER BY rand() LIMIT ".$number ;
	


	if( !( $result = $db->sql_query($query) ) ){
		die("Error");	
	}
	
	while( $row = $db->sql_fetchrow($result) ){
		$brand = array();
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
		$url = rule_detail_url($row['profile_id'],
							$row['profile_date'] ,
							$row['profile_style'] , false , $arr_brand[0] );
							// 該圖片點擊後所連結之 URL
		if( !file_exists( $src ) )
			$src = 'images/photo_search_fail.jpg' ;
				
		// push array
		$brand['type'] = $no_list[ $arr_brand[0]] ; 	
		$brand['name'] =($temp =  $arr_brand[1] ) ? $temp : $NULL_NAME ;
		$brand['price'] = ($temp =  $arr_brand[2] ) ? $temp : $NULL_PRICE ;
		$brand['place'] = ($temp =  $arr_brand[3] ) ? $temp : $NULL_PLACE ;	
		$brand['src'] = $src ;
		$brand['url'] = $url ;
		
		array_push( $brands , $brand );	
	}
	//print_r($brands);
	return $brands ;
}

function db_table_countv2( $query ){
	$db = db_connect();
	
	$result = $db->sql_query( $query );
	$row = $db->sql_fetchrow($result);
	
	return $row['c'] ;
}
function db_table_max( $tb_name , $column_name ){
	$db = db_connect();
	
	// SQL count funciton
	$query_max = 'max('.$column_name.')' ;
	
	// Build Where query 
	//$query_where = $query_where ? " WHERE ".$query_where  : "";
	
	$result = $db->sql_query('SELECT ' .$query_max. " AS m FROM ".$tb_name );
	$row = $db->sql_fetchrow($result);
	
	return $row['m'] ;
}
function db_fastquery( $sql ){
	$db = db_connect();
	
	$result = $db->sql_query( $sql );
	$row = $db->sql_fetchrow($result);
	
	return $row ;
}

?>
