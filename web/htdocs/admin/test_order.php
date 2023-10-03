<?php
require_once('../includes/dm_db.php');

$test = new QuickView();
class QuickView
{
    function QuickView()
    {
        print_r( $this->by_style('ALL') );
    }
 
    function by_style($style_id){ 
		switch( trim($style_id) ){
		case 'ALL':
			return $this-> fetch_all();
			break ;
		case 'A': case 'B': case 'C': case 'D': 
		case 'E': case 'F': case 'G': case 'H': 
			return $this-> fetch_all();
			break ;
		}
    }
	function fetch_all(){
		define('STYLE_DETAIL_LINK' , 'http://192.83.193.117/demo/style/detail.php');
		define('STYLE_PATH','../style/');
		define('STYLE_PHOTO_PATH','photo/');
		define('STYLE_PHOTO_FORMAT','01_m.jpg');
		
		$profiles = array();
		$db = db_connect();
		$query = "SELECT profile_id, profile_style, profile_date FROM dm_street_profile".
		" ORDER BY rand() LIMIT 20" ;
		
		if(!($result = $db->sql_query($query)) ){
			return 'Profile information Not Exist ! ERROR';
		}
		
		// only has one result
		//if(!($profile_row = $db->sql_fetchrow($result)) ){
			//return 'Profile data in Database is empty ! ERROR';
		//}		
		
		// $profiles store and renew all data 
		while(1){
			$profiles = $this->excute_query($profiles , $db , $result );
			print_r($profiles);
			if( $this->all_exists($profiles) ){
				break ;
			}
			$result = $db->sql_query($query);
		}
		
		return $profiles ;
		//$dir = STYLE_PATH . STYLE_PHOTO_PATH .  substr($profile_row['profile_date'],0,6) . '/' ;
		//return 'You said: ' . $pic_path;
		//$pic_path;
		//../../../style/photo/200707/000002_070705_B_m.jpg	
	
	}
	function excute_query($profiles , $db ,  $result ){
		while($profile_row = $db->sql_fetchrow($result)){
			// Get table style contain
			$my_style = trim($profile_row['profile_style']) ;
			if( isset($profiles[ $my_style ]) )continue ;
			// path set , needtomodify later
			//$DIR = STYLE_PATH . STYLE_PHOTO_PATH .  substr($profile_row['profile_date'],0,6) . '/' ;
			$DIR =  substr($profile_row['profile_date'],0,6) . '/' ;
			$PATH = $DIR. sprintf('%06d',$profile_row['profile_id']).'_'. substr($profile_row['profile_date'],2,6).'_'. $profile_row['profile_style'] .'_'.STYLE_PHOTO_FORMAT ;
			$LINK = STYLE_DETAIL_LINK . '?did=' . $profile_row['profile_id'] . '&date='.substr($profile_row['profile_date'],2,6) .'&style=' . $profile_row['profile_style'] ;
			$one_profile = array( 'path'=> $PATH , 'link'=> $LINK );
			$profiles[ $my_style ] = $one_profile ;
		}
		//ksort($profiles);
		return $profiles;
	}
	// check if the rand() SQL need to repeat again
	function all_exists($profiles){
		$arr_all_styles = array('A','B','C','E','F','G','H');
		for( $i=0 ; $arr_all_styles[$i] ; $i++){
			//echo $profiles[ $arr_all_styles[$i] ] ."<P>";
			if( !isset( $profiles[ $arr_all_styles[$i] ]) ){
				//echo $profiles[ $arr_all_styles[$i] ] . "不存在 <P>" ;
				return false ;
			}
		}
		//echo "都存在" ;
		return true ;
	}
}
?>