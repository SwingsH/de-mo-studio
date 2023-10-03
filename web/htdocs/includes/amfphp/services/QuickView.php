<?php
/***************************************************************************
*	ID		: QuickView.php
*	Licence		: Swings (C) DE-MO Studio in Taiwan 
*	Date		: 2007.08.24
*	Specification	: 
*		amfPHP service .
*		Provide all Flash Quick View server side functions
***************************************************************************/

require_once('../../dm_db.php');
require_once('../../dm_photo_rule.php');

$qv = new QuickView();
print_r($qv->by_style('A'));

class QuickView
{
    function QuickView()
    {
        $this->methodTable = array
        (
            "by_style" => array
            (
                "access" => "remote",
                "description" => "Pings back a message"
            ),
            "by_date" => array
            (
                "access" => "remote",
                "description" => "Pings back a message"
            )
        );
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
			//print_r($profiles);
			if( $this->all_exists($profiles) ){
				break ;
			}
			$result = $db->sql_query($query);
		}
		// Added the Absolute Photo path to shorten the the Remote DATA transmission
		// arg1 Photo , arg2 Detail URL , arg3 Style URL 
		$profiles['prefix']=array( 'path'=>rule_photo_abpath() ,'link'=>rule_abpath() , 'url'=>rule_abpath() ); 
		return $profiles ;

	}
	function excute_query($profiles , $db ,  $result ){
		while($profile_row = $db->sql_fetchrow($result)){
			
			// Get table style contain
			$my_style = trim($profile_row['profile_style']) ;
			
			// If Array already have this Style , Skip It  
			if( isset($profiles[ $my_style ]) )continue ;
			
			// Make Up Path and Link using in dm_photo_rule.php
			$PATH = rule_photo_path( $profile_row['profile_date'], 'shortest' ).'m/' ;//Boolean , if use absolute path ?
			$PATH = $PATH . rule_photo_name( $profile_row['profile_id'] , $profile_row['profile_date'], 
				$profile_row['profile_style'] );
			
			//Boolean , if use absolute path ?	
			$LINK = rule_detail_url($profile_row['profile_id'],$profile_row['profile_date'],
				$profile_row['profile_style'],false) ; 
			
			 //Boolean , if use absolute path ?
			$URL = rule_style_url( $profile_row['profile_style'],false) ;
			
			// Push result to Array
			$one_profile = array( 'path'=> $PATH , 'link'=> $LINK , 'url'=> $URL );
			$profiles[ $my_style ] = $one_profile ;
		}
		//ksort($profiles);
		return $profiles;
	}
	// check if the rand() SQL need to repeat again
	function all_exists($profiles){
		$arr_all_styles = array('A','B','C','D','E','F','G','H');
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
	//-------------By Date ----------------------------------------------------------
	function by_date($request_day = null){
		//$first_day_of_week = $request_day ? $request_day : $this->date_get_lastestday();
		// Start Data base fetching function
		$profiles = $this->date_get_random_profile( 5 , $request_day);
		
		//Get ABPATH
		$result=array('daylist'=>$this->get_daylist(),'photopath'=>rule_photo_abpath(),'profiles'=>$profiles);
		
		//print_r($result);
		return $result;
	}
	function get_daylist(){
		$db = db_connect();
		// Get All day data
		$query = " SELECT profile_date FROM dm_street_profile ".
				" GROUP BY profile_date ORDER BY profile_date DESC";
		//Excute Query
		$result = $db->sql_query( $query );
		
		// Get date every 5 days
		$i=0;
		$date_select = array();
		while( $row = $db->sql_fetchrow() ){
			if( $i%5 == 0){
				array_push( $date_select , $row['profile_date'] );
			}
			$i++;
		}
		return $date_select ;
	}
	function date_get_lastestday(){
		$db = db_connect();
		// Get the latest day of All photos
		$query = "SELECT profile_date FROM dm_street_profile ORDER BY profile_date DESC LIMIT 1" ;
		$result = $db->sql_query($query);
		$row = $db->sql_fetchrow($result);
		$lastday = $row['profile_date'];
		
		// Calculate the Monday of This Week
    		$dateTime = new DateTime($lastday.'Asia/Taipei');
    		$day_of_week = $lastday - $dateTime->format('w') + 1 ;
    		
    		return $day_of_week ;
	}
	// argument1 First day of week , argument2 total days
	function date_get_random_profile( $total = 5 ,$request_day=null ){
		// All result data
		$arr_profiles = array();
		$db = db_connect();
		
		// Fetch data
		$query =  
		" SELECT profile_id, profile_style, profile_date ,profile_name,profile_age,profile_tall ,profile_location,profile_say".
		" FROM dm_street_profile".
		" GROUP BY profile_date ". ($request_day ?' HAVING profile_date <='.$request_day : '' ) .// have selected date
		" ORDER BY  profile_date DESC , rand()  LIMIT ".$total ;
		// Rand() is useless in ths SQL
		
		//Excute Query
		$result = $db->sql_query( $query );
		
		// Fetch Results
		while( $row = $db->sql_fetchrow( $result ) ){
			$profile = array();
			
			// Have Data this Day
			$profile['exist'] = true;
			$profile['image']= rule_photo_path($row['profile_date'],'shortest').'m/'.
				rule_photo_name($row['profile_id'],$row['profile_date'],$row['profile_style']);
			$profile['link'] = rule_detail_url($row['profile_id'],$row['profile_date'],
				$row['profile_style'],true);
			
			// Personal data
			$profile['name'] = $row['profile_name'];
			$profile['age'] = $row['profile_age'];
			$profile['tall'] = $row['profile_tall'];
			$profile['say'] = $row['profile_say'];
			$profile['location'] = $row['profile_location'];
			$profile['date'] = $row['profile_date'];
			
			// Handle for Total Count
			// Set Query for number count
			$query_count =  
			" SELECT count(*) AS total".
			" FROM dm_street_profile".
			" WHERE profile_date = ".$row['profile_date'] ;	
			$row_count = $db->sql_fetchrow( $db->sql_query($query_count) );
			$profile['total']=$row_count['total'];
			
			//Push and Save data
			array_push( $arr_profiles , $profile ); 
		} // SQL fetch End
		return $arr_profiles;
	}
	// argument1 First day of week , argument2 total days
	function date_get_random_profile_day($fst_dow ,$total = 5){
		$arr_profiles = array();
		$db = db_connect();
		
		// Fetch data N times
		for(;$total;$total--,$fst_dow++){
			// The Profile Data
			$profile = array('date'=>$fst_dow);
			
			// Set Query by Date
			$query =  
			" SELECT profile_id, profile_style, profile_date ,profile_name,profile_age,profile_tall ,profile_location,profile_say".
			" FROM dm_street_profile".
			" WHERE profile_date = ".$fst_dow. " ORDER BY rand() LIMIT 1" ;
			
			// Set Query for number count
			$query_count =  
			" SELECT count(*) AS total".
			" FROM dm_street_profile".
			" WHERE profile_date = ".$fst_dow ;			
			
			// ----------Handle for Profile data indertting to array-----------
			// Condition , If have any photoshot data in this date
			// No data this day !
			if(!$row=$db->sql_fetchrow($db->sql_query($query)) ){
				$profile['exist'] = false;
				array_push( $arr_profiles, $profile);
				continue ;
			}
			// Have Data this Day
			$profile['exist'] = true;
			$profile['image']= rule_photo_path($row['profile_date'],'shortest') .'m/'.
				rule_photo_name($row['profile_id'],$row['profile_date'],$row['profile_style']);
			$profile['link'] = rule_detail_url($row['profile_id'],$row['profile_date'],
				$row['profile_style'],true);
			
			// Personal data
			$profile['name'] = $row['profile_name'];
			$profile['age'] = $row['profile_age'];
			$profile['tall'] = $row['profile_tall'];
			$profile['say'] = $row['profile_say'];
			$profile['location'] = $row['profile_location'];
						
			// -----------Handle for Total Count
			$row_count = $db->sql_fetchrow( $db->sql_query($query_count) );
			$profile['total']=$row_count['total'];
			
			// Push the result !
			array_push( $arr_profiles, $profile);
		}
		//print_r($arr_profiles);
		return $arr_profiles;
	}
}

if($_GET['t']){
	$qv = &new QuickView();
	$qv->by_date();
}
?>