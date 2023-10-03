<?php
/***************************************************************************
*	ID			: dm.class.template_generator.php
*	Licence		: (C) DE-MO Studio in Taiwan 
*	Author		: Swings Huang	2007.11.07
*	Author2		: -----------	----------
*	Information		: 
*		TemplateGenerator , demo專用模板快速產生器 , 以區塊為單位 ,
*		快速的產生某個功能區塊的 html , 並帶入該區塊功能 , 
*		如: 快速產生最新消息區,且能點越最新消息
*
*		Method - template_xxx , return HTML Code 
*		Method - object_xxx , return Template Object
***************************************************************************/

require_once( 'dm_config.php');
require_once( INCLUDE_PATH . 'dm_savant2.php' );
require_once( INCLUDE_PATH . 'dm_db.php');
require_once( INCLUDE_PATH . 'dm_photo_rule.php');
require_once( INCLUDE_PATH . 'dm.function.default.php');
require_once( INCLUDE_PATH . 'dm.function.big5.php');	// handle big5
require_once( INCLUDE_PATH . 'dm_counter.php');	// counter

// non-Exist Excuteble Function
class TemplateGenerator{

	function __construct(){
		
	}
	
	public function object_homepage(){
		
		$tpl_content = $this->create_template( 'index_homepage_frame.html' ) ;
		$tpl_content->assign('page_rightbar' , $this->template_rightbar( 'home' ) );
		
		$tpl = $this->create_template( 'index_default_main.html' );
		$tpl->assign('page_upper' , $this->template_upper());
		$tpl->assign('page_menu' , $this->template_leftmenu());
		$tpl->assign('page_main_content' , $tpl_content->fetch() );
		
		$tpl->display();
	}
	
	public function template_default_main(){
		$tpl = &$this->create_template( 'index_default_main.html' );
		$tpl->assign('page_upper' , $this->template_upper());
		$tpl->assign('page_menu' , $this->template_leftmenu());
		
		return $tpl->display();
	}

	
	// 依情況產生頁面右側之選單
	public function &template_rightbar( $page_name){
		switch( $page_name ){
		case 'home' :
			// Quick News
			$tpl_news= $this->create_template( 'block_quick_news.html' );
			// Vote Section
			$tpl_vote= $this->create_template( 'block_tagbook_vote_magazine.html' );
			
			return ( $tpl_news->fetch() . $tpl_vote->fetch() ) ;
			break ;
		case "page3" :
			//...
			break ;
		default : // null , for the top index page
		}
		
	}
	// 依情況產生頁面左側之選單
	public function &template_leftmenu( $page_name = null ){
		switch( $page_name ){
		case "page2" :
			//...
		break ;
		case "page3" :
			//...
		break ;
		default : // null , for the top index page
			$tpl_menu_0= $this->create_template( 'block_membersys_normal.html' );
			$tpl_menu_1= $this->create_template( 'index_default_leftmenu.html' );
			$tpl_menu_2= $this->create_template( 'block_quick_ranklist.html' );
			return $tpl_menu_0->fetch() . $tpl_menu_1->fetch() . $tpl_menu_2->fetch() ;
		}
		
	}
	// 依情況產生頁面上側之banner + link
	public function &template_upper( ){
		$tpl = $this->create_template( 'index_default_upper.html' );
		return $tpl->fetch();
	}
	
	// Fast load template
	public function &create_template( $tpl_name ){
		$tpl = &new Savant2();
		$tpl->addPath( 'template' , TEMPLATE_PATH );	//set path
		$tpl->setTemplate( $tpl_name );
		return $tpl ;
	}
	
	// Combine and print 2 template
	public function &combine_fetch( &$tpl_a , &$tpl_b ){
		return ( $tpl_a->fetch() ) . ( $tpl_b->fetch() );
	}
}

// Exist Excuteble Function
class FunctionBlock{
	// TemplateGenerator
	private $TPLgenerator ;

	function __construct(){
		$this->TPLgenerator = &new TemplateGenerator();
	}
	
	public function skin( $type = 'default' ){
		switch( $type ){
		case 'home':
			return $this->block_page_home();
		break ;
		case 'homepage':
			return $this->block_page_homepage();
		break ;
		default :
			//..	
		}
	}
	
	//區塊: 首頁頁面外框
	public function block_page_home(){
		## 1.Ready Fetch Data ##
		
		## 2.Ready Print Template ##
		$TG = $this->TPLgenerator ;
		
		// Template Object
		$tpl = $TG->create_template( 'index_default_main.html' );
		
		// UpperMenu
		$tpl->assign('page_upper' ,$TG->template_upper());

		// Page Bottom : Bottom
		$tpl_bot = &$TG->create_template( 'index_default_bottomline.html' );
		$tpl->assign('page_bottom' , $tpl_bot->fetch() );
		
		// Left Menu
		$tpl_menu_0= &$this->block_membersystem(); //$TG->create_template( 'block_membersys_normal.html' );
		$tpl_menu_1= &$TG->create_template( 'index_default_leftmenu.html' );
		//$tpl_menu_2= &$this->block_ranklist();
		$tpl_menu = ( $tpl_menu_0->fetch() ) . ($tpl_menu_1->fetch()) ; //. ($tpl_menu_2->fetch()
		$tpl->assign('page_menu' , $tpl_menu );
		
		// Page Content : Right Bar
		$tpl_content = $TG->create_template( 'index_homepage_frame.html' ) ;
		//$tpl_rightbar = $TG->template_rightbar( 'home' ) ;

		//$tpl_content->assign('page_rightbar' , $tpl_rightbar );
		
		$tpl->assign('page_main_content' , $tpl_content->fetch() );
		

		
		## 3.Return ##
		return $tpl ;
	}
	
	//區塊: 首頁頁面外框
	public function block_page_homepage(){
		## 1.Ready Fetch Data ##
		
		## 2.Ready Print Template ##
		$TG = $this->TPLgenerator ;
		
		// Template Object
		$tpl = $TG->create_template( 'index_default_main.html' );
		
		// UpperMenu
		$tpl->assign('page_upper' ,$TG->template_upper());

		// Page Bottom : Bottom
		$tpl_bot = &$TG->create_template( 'index_default_bottomline.html' );
		$tpl->assign('page_bottom' , $tpl_bot->fetch() );
		
		// Left Menu
		$tpl_menu_0= &$this->block_membersystem(); //$TG->create_template( 'block_membersys_normal.html' );
		$tpl_menu_1= &$TG->create_template( 'index_default_leftmenu.html' );
		$tpl_menu_2= &$this->block_ranklist();
		$tpl_menu = ( $tpl_menu_0->fetch() ) . ($tpl_menu_1->fetch() ) . ($tpl_menu_2->fetch()) ;
		$tpl->assign('page_menu' , $tpl_menu );
		
		// Page Content : Right Bar
		$tpl_content = $TG->create_template( 'index_homepage_frame.html' ) ;
		//$tpl_rightbar = $TG->template_rightbar( 'home' ) ;

		//$tpl_content->assign('page_rightbar' , $tpl_rightbar );
		
		$tpl->assign('page_main_content' , $tpl_content->fetch() );
		

		
		## 3.Return ##
		return $tpl ;
	}
	
	//區塊:人氣排行榜
	public function block_ranklist( $fetch_num = 10 ){

		## 1.Ready Fetch Data ##	
		$query = " SELECT profile_id , profile_name, profile_vote , profile_style , profile_date ".
			" FROM dm_street_profile ORDER BY profile_vote DESC LIMIT 0 , " .$fetch_num ;
		//echo $query ;
		// Create SQL connect object
		$db = db_connect();
		
		// Excute Query
		if( ! ($result = $db->sql_query($query)) ){
			die('Information Not Exist ! ERROR');
		}
		
		// Start Handle data
		$profiles = array();
		while( $row = $db->sql_fetchrow($result)  ){
			$pro = array();
			
			$url = rule_detail_url( $row['profile_id'] , $row['profile_date'] , $row['profile_style'] );
			
			// Assign one profile's total data
			$pro['url'] =  $url  ;
			$pro['name'] = $row['profile_name'] ;
			$pro['vote'] = $row['profile_vote'] ;
			
			//Push in 
			array_push( $profiles , $pro );
		}
		
		## 2.Ready Print Template ##
		$tpl = $this->TPLgenerator->create_template( 'block_quick_ranklist.html' );
		$tpl->assign( 'profiles' , $profiles );
		
		## 3.Return ##
		return $tpl ;
	}

	//區塊:最新消息
	public function &block_newslist( $fetch_num = 5 ){
		define( 'NEWS_PHP' , 'news.php' );
		
		## 1.Ready Fetch Data ##	
		$query = "SELECT * FROM dm_bulletin_post WHERE post_valid = 1 ".
				" ORDER BY post_date DESC LIMIT " .$fetch_num ;
		
		// Create SQL connect object
		$db = db_connect();
		
		// Excute Query
		if( ! ( $result = $db->sql_query($query)) ){
			die('News Not Exist ! ERROR');
		}
		
		// Start Handle data
		$type_list = db_bulletin_type() ;
		$arr_articles = array();
		while( $row = $db->sql_fetchrow($result) ){
			$article = array();
			$article['typename'] = $type_list[ $row['post_type'] ];
			$article['subtitle'] = big5_substr( $row['post_title'] , 0 , 16 );
			// generate id url
			$article['url'] = NEWS_PHP .'?id=' . $row['post_id']  ;
			// generate type url
			$article['typeurl'] = NEWS_PHP .'?type='.$row['post_type'] ;
			
			array_push( $arr_articles , $article );
		}
		
		## 2.Ready Print Template ##
		$tpl = $this->TPLgenerator->create_template( 'block_quick_news.html' );
		$tpl->assign( 'articles' , $arr_articles );
		
		## 3.Return ##
		return $tpl ;
	}
	
	//區塊:會員QV區
	public function &block_membersystem( ){
		
		## 1.Ready Fetch Data ##	
		$online_total = counter() ;
		
		## 2.Ready Print Template ##
		$tpl = $this->TPLgenerator->create_template( 'block_membersys_normal.html' );
		$tpl->assign( 'online_total' , $online_total );
		
		## 3.Return ##
		return $tpl ;
	}
	// 依情況產生頁面右側之選單
	public function block_rightbar( $page_name){
		switch( $page_name ){
		case 'home' :
			// Quick News
			$tpl_news= $this->block_newslist( 5 );
			// Vote Section
			$tpl_vote= $this->create_template( 'block_tagbook_vote_magazine.html' );
			
			return ( $tpl_news->fetch() . $tpl_vote->fetch() ) ;
			break ;
		case "page3" :
			//...
			break ;
		default : // null , for the top index page
		}
		
	}
	
	// Fast load template
	public function &create_template( $tpl_name ){
		$tpl = &new Savant2();
		$tpl->addPath( 'template' , TEMPLATE_PATH );	//set path
		$tpl->setTemplate( $tpl_name );
		return $tpl ;
	}
}

?>