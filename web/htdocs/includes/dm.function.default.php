<?php
/***************************************************************************
*	ID			: dm.function.default.php
*	Licence		: Swings (C) DE-MO Studio in Taiwan 
*	Date			: 2007.10.22
*	Specification	: 
*
***************************************************************************/

function get_brand_no(){
	$no_list = array(1=> "帽子",2=> "項鍊",3=> "外套",4=> "上衣",5=> "背包",
			6=> "手鍊",7=> "手錶",8=> "褲子",9=> "裙子",10=> "鞋子",11=>'腰帶', 12=>'戒指' ,
			16=> "眼鏡",17=> "耳環",18=> "髮型",19=> "刺青",20=> "指甲彩繪",21=> "其他");	
	return $no_list ;
}

// Input brand no and Return the corresponded "Photo prefix" !! , Ex: in 4 out 01 , xxx_xxxx_01_xxxxx
// 代入物品參數號碼, 回傳
function get_brand_photo_infix( $brand_no = 0 ){
	$prefix = 'xx';
	$comment = '照片說明';
	
	switch($brand_no){
		
	case 4 : 
		$prefix = '15' ;
		$comment = '';
	break;
	case 8 : case 9 :
		$prefix = '16' ;
		$comment = '';
	break ;
	
	case 3 : 
		$prefix = '02' ;
		$comment = '全身照(後)';
	break ;
	
	case 5 :
		$prefix = '03' ;
		$comment = '包包';
	break ;
	
	case 10 :
		$prefix = '04' ;
		$comment = '鞋子';
	break ;
	
	case 2 :
		$prefix = '05' ;
		$comment = '項鍊';
	break ;
	
	case 7 : 
		$prefix = '06' ;
		$comment = '手錶';
	break ;
	
	case 6 : case 19 :
		$prefix = '07' ;
		$comment = '手飾';
	break ;
	
	case 1 :
		$prefix = '08' ;
		$comment = '頭飾';
	break ;

	case 17 :
		$prefix = '09' ;
		$comment = '耳環';
	break ;
	
	case 11 :
		$prefix = '10' ;
		$comment = '腰帶';
	break ;
	
	case 16 :
		$prefix = '11' ;
		$comment = '眼鏡';
	break ;
	
	case 20 :
		$prefix = '12' ;
		$comment = '指甲彩繪';
	break ;
	
	case 12 :
		$prefix = '13' ;
		$comment = '戒指';
	break ;

	default:
		$prefix = '00' ;
	}
	
	return $prefix ;
}
function parse_date( $date ){
	return substr( $date , 0 , 4 ) .'/'. substr( $date , 4 , 2 ) .'/'. substr( $date , 6 , 2 ) ;
}

// 計算並傳回所有頁面之網址列
function handle_page_counts( $current_page ,$num_per_page  ){
	$total = db_table_count( PROFILE_TABLE , 'profile_id' , " profile_style <= 'D' ");
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
	return $arr_url ;
}

// 計算並傳回所有頁面之網址列
function list_page_urls( $current_page ,$num_per_page , $total){

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
	return $arr_url ;
}

// Get Client IP
function  get_client_ip(){  

	if  (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$realip  =  $_SERVER["HTTP_X_FORWARDED_FOR"];  
      }  
	elseif  (isset($_SERVER["HTTP_CLIENT_IP"])){  
		$realip  =  $_SERVER["HTTP_CLIENT_IP"];  
	}  
	else    
	{  
		$realip  =  $_SERVER["REMOTE_ADDR"];  
	}  
	return  $realip;              
} 
?>