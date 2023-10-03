<?php
/***************************************************************************
*	ID		: dm_classes.php
*	Licence	: Swings (C) DE-MO Studio in Taiwan 
*	Author	: Swings	2007.08.13
*	Information	: 
*		DEMO default class
***************************************************************************/

class ListCache{
	var $file_cache ;
	var $is_using_xml ;
	var $arr_vars = array();

	function __construct( $file ,$vars ,$by_xml = false){
		$this->file_cache = $file ;
		$this->arr_vars = $vars ;
		$this->is_using_xml = $by_xml ;
	}
	
	function cache(){
		if(!$this->by_xml){
			//echo "$this->by_xml";
			$this->cache_by_param();
		}
		else{
			$this->cache_by_xml();
		}
	}
	
	function cache_by_param(){
		if(file_exists($this->file_cache)){
			return false;
		}
		$fp = fopen( $this->file_cache , 'a+');
		//echo current($this->arr_vars) ;
		for( ; $value = current($this->arr_vars); next($this->arr_vars) ){
			fwrite($fp, key($this->arr_vars).'='.$value.'&');
		}
	}
	function cache_by_xml(){
	}
}

class PhotoListCache extends ListCache{
	function __construct( ){

	}
}

class ErrorLog{
	var $file_path ;
	var $file_name ;
	var $time_enable ;
	var $time_label ;
	var $arr_vars = array();

	function __construct( $path ,  $file = null , $time_enable = true ){
		$this->file_path = $path ;
		$this->file_name = $file ;
		$this->time_enable = $time_enable ;
		$this->time_label = "" ;
	}
	
	function save( $error ){
		$this->file_name = $this->file_path . date("Y_m") . ".dmlog";
		
		$fp = fopen( $this->file_name ,'a+');
		$content = $error . $this->get_time() ;
		fwrite($fp, $content . "\n");
	}
	
	function open_file(){
	
	}
	
	function get_time(){
		$date = getdate();
		$this->time_label = " ".$date["year"]."/".$date["mon"]."/".$date["mday"]."  ".$date["hours"].":".$date["minutes"].":".$date["seconds"]." - ".$date["weekday"];
		return $this->time_label ;
	}
	
	function cache_by_param(){
		if(file_exists($this->file_cache)){
			return false;
		}
		$fp = fopen( $this->file_cache , 'a+');
		//echo current($this->arr_vars) ;
		for( ; $value = current($this->arr_vars); next($this->arr_vars) ){
			fwrite($fp, key($this->arr_vars).'='.$value.'&');
		}
	}
}

class PageCalculator{
	var $total_datas ;
	var $per_page_datas ;
	var $last_page = false ;
	function __construct( $num_datas = 0 , $num_per_page = 0 ){
		$this->total_datas = $num_datas ;
		$this->per_page_datas = $num_per_page ;
	}
	
	//Ser data numbers per page
	function set_perpage( $num ){
		$this->per_page_data = $num ;
	}
	
	// Set the total data all one page
	function set_total ( $num ){
		$this->total_datas = $num ;
	}
	
	// Get last page
	function get_last_page(){
		if(!$this->last_page)
			$this->last_page = ceil( $this->total_datas / $this->per_page_datas );
		return $this->last_page ;
	}
	
	// Get first page
	function get_first_page(){
		return 	1;
	}
}

?>