/***********************************
*		detail_controller.as v1.1 
*		2007.08.02
* 		(C) Swings @ DE-MO.com.tw
************************************/
// to much global resource !!
var ctl_page_num:Number = 6 ; // 6 pics per page
var ctl_attach_id :String= "mc_controller" ;
var ctl_x:Number =10;
var ctl_y :Number= 493;
var ctl_mcs :Array ;
var ctl_mc_main :MovieClip;
var ctl_mc_next :MovieClip;
var ctl_mc_previous :MovieClip;
var ctl_mc_autonext : MovieClip;
var ctl_mc_autoprevious : MovieClip ;
var ctl_page_first :Number;
var ctl_page_last :Number;
var ctl_mc_browser : MovieClip ;
var ctl_arr_infomask : Array = new Array() ;
var ctl_arr_alphamask : Array = new Array() ;
//var ctl_bol_havenext : Boolean ;
//var ctl_bol_haveprevious : Boolean ;

// target mc , array of all mini pics , mc of browser (containt all mini pics)
function setController(target_mc:MovieClip , mini_mcs : Array ,mc_browser : MovieClip){
	ctl_mc_main = target_mc.attachMovie(ctl_attach_id , "mc_controller" ,
					target_mc.getNextHighestDepth(),{_x:ctl_x , _y:ctl_y} );
	//initial variables
	//ctl_mc_next = ctl_mc_main.mc_next ;
	//ctl_mc_previous = ctl_mc_main.mc_previous ;
	ctl_mc_autonext = ctl_mc_main.mc_autonext ;
	ctl_mc_autoprevious = ctl_mc_main.mc_autoprevious ;
	ctl_mcs = mini_mcs ;
	ctl_page_first = 0 ;
	ctl_page_last = ctl_page_num-1 ;
	ctl_mc_browser = mc_browser ;
	//ctl_mcs[ctl_page_first]._y -= 20 ;
	//ctl_mcs[ctl_page_last]._y -= 20 ;
	checkIfHavingPages();
}

function checkIfHavingPages(){
	if( ctl_page_last >= ctl_mcs.length-1 ){
		// have no next page		
		disableNext();
	}
	else{
		enableNext();
	}
	if(ctl_page_first <= 0){
		// have no next page		
		disablePrevious();
	}
	else{
		enablePrevious();
	}
}
function enableNext(){
	//ctl_mc_next._alpha = 85 ;
	//ctl_mc_next.onRelease = nextOnRelease ;
	ctl_mc_autonext._alpha = 85 ;
	// Set Auto button as un-Auto Bottun's function
	ctl_mc_autonext.onRollOver = nextOnRelease ;
	//ctl_mc_next.onRollOut = nextOnRollOut ;
	//ctl_mc_next.onRollOver = nextOnRollOver ;
	//over and out function not finish yet
}
function enablePrevious(){
	//ctl_mc_previous._alpha = 85 ;
	//ctl_mc_previous.onRelease = previousOnRelease ;
	ctl_mc_autoprevious._alpha = 85 ;
	// Set Auto button as un-Auto Bottun's function
	ctl_mc_autoprevious.onRollOver = previousOnRelease ;
	//ctl_mc_previous.onRollOut = previousOnRollOut ;
	//ctl_mc_previous.onRollOver = previousOnRollOver ;
	//over and out function not finish yet
}
function disableNext(){
	//ctl_mc_next._alpha = 20 ;
	//delete ctl_mc_next.onRollOver  ;
	//delete ctl_mc_next.onRelease  ;
	// Auto Button
	ctl_mc_autonext._alpha = 20 ;
	delete ctl_mc_autonext.onRollOver;
}
function disablePrevious(){
	//ctl_mc_previous._alpha = 20 ;
	//delete ctl_mc_previous.onRollOver ;
	//delete ctl_mc_previous.onRelease ;
	// Auto Button
	ctl_mc_autoprevious._alpha = 20 ;
	delete ctl_mc_autoprevious.onRollOver ;
}
//========== Event Functions -> RollOver Mask Function ==========
function createMoveInfoMask(start_i:Number,end_i:Number){
	var father = ctl_mcs[start_i]._parent ;
	
	var ctl_mc_infomask = father.createEmptyMovieClip("mc_ctl_infomask",
												father.getNextHighestDepth() );
	var mc:MovieClip ;
	// ctl_mc_infomask 's coordinate is 0,0 the same with father
	for( var i=start_i; i<=end_i ; i++){
		mc = ctl_mc_infomask.attachMovie("mc_infomask_L","mc_infomask_"+i,ctl_mc_infomask.getNextHighestDepth() );
		mc._x = ctl_mcs[i]._x+(ctl_mcs[i]._width - mc._width)/2;
		mc._y = ctl_mcs[i]._y+(ctl_mcs[i]._height - mc._height)/2;
		mc._alpha = 70 ;
		ctl_arr_infomask.push(mc);
		
		// set alpha in browser.as
		ctl_mcs[i].MC_effect._alpha = 60 ;
		ctl_arr_alphamask.push(ctl_mcs[i].MC_effect);
	}
}
//========== Event Functions ==========
function nextOnRelease(){
	//----------- when the page moved out of range-------------------------
	var new_page_first :Number ;
	var new_page_last :Number ;

	if( (ctl_page_last + 1+ctl_page_num) > ctl_mcs.length ){
		new_page_first = ctl_page_first + (ctl_mcs.length % ctl_page_num) ;
		//trace("超出new_page_first"+new_page_first);
	}
	// when the page doesn't moved  out of range
	else{
		new_page_first = ctl_page_first + ctl_page_num ;
		//trace("沒超出new_page_first"+new_page_first);
	}

	//-------------------------------------------------------------------
	
	// decide  ctl_mc_browser move to what position
	// calculate the distance of old first page x and new first page x
	ctl_itvl_endx = ctl_mc_browser._x - 
				( ctl_mcs[new_page_first]._x - ctl_mcs[ctl_page_first]._x );

	// change page info
	ctl_page_first = new_page_first ;
	ctl_page_last = new_page_first + ctl_page_num-1;

	// disable to prevent user muti-click the button
	disableNext();
	disablePrevious();
	
	//ini interval variables
	 ctl_itvl_distance = 13;
	 ctl_itvl_dec = 0.4 ;

	// set the mode is move right 
	ctl_itvl_mode = true;
	
	ctl_itvl_id = setInterval(controlSlide,8);
}

function previousOnRelease(){
	//----------- when the page moved out of range-------------------------
	var new_page_first :Number ;
	var new_page_last :Number ;

	if( (ctl_page_first - ctl_page_num) <= 0 ){
		new_page_first = 0 ;
	}
	else{// when the page doesn't moved  out of range
		new_page_first = ctl_page_first - ctl_page_num ;
	}
	//-------------------------------------------------------------------
	
	// decide  ctl_mc_browser move to what position
	// calculate the distance of old first page x and new first page x
	ctl_itvl_endx = ctl_mc_browser._x + 
				( ctl_mcs[ctl_page_first]._x - ctl_mcs[new_page_first]._x );

	// change page info
	ctl_page_first = new_page_first ;
	ctl_page_last = new_page_first + ctl_page_num-1;

	// disable to prevent user muti-click the button
	disableNext();
	disablePrevious();
	
	//ini interval variables
	 ctl_itvl_distance = -13;
	 ctl_itvl_dec = -0.4 ;

	// set the mode is move left
	ctl_itvl_mode = false;
	
	ctl_itvl_id = setInterval(controlSlide,8);
}

function nextOnRollOver(){
	//----------- when the page moved out of range-------------------------
	var new_page_first :Number ;
	var new_page_last :Number ;

	if( (ctl_page_last+ 1 + ctl_page_num) > ctl_mcs.length ){
		new_page_first = ctl_page_first + (ctl_mcs.length % ctl_page_num) ;
	}
	// when the page doesn't moved  out of range
	else{
		new_page_first = ctl_page_first + ctl_page_num ;
	}
	//-------------------------------------------------------------------
	createMoveInfoMask(ctl_page_first,new_page_first-1);
}
function previousOnRollOver(){
	//----------- when the page moved out of range-------------------------
	var new_page_first :Number ;
	var new_page_last :Number ;

	if( (ctl_page_first - ctl_page_num) < 0 ){
		new_page_first = 0 ;
	}
	else{// when the page doesn't moved  out of range
		new_page_first = ctl_page_first - ctl_page_num ;
	}
	//-------------------------------------------------------------------
	createMoveInfoMask(new_page_first-1,ctl_page_first);
}

function nextOnRollOut(){
	var mc ;
	for(var i=0 ; ctl_arr_infomask.length !=0 ;i++){
		mc = ctl_arr_infomask.pop();
		mc.removeMovieClip();
		mc = ctl_arr_alphamask.pop();
		mc._alpha = bb_alpha_def ; // var in browser_bas.as
	}
}



function previousOnRollOut(){
	var mc ;
	for(var i=0 ; ctl_arr_infomask.length !=0 ;i++){
		mc = ctl_arr_infomask.pop();
		mc.removeMovieClip();
		mc = ctl_arr_alphamask.pop();
		mc._alpha = bb_alpha_def ; // var in browser_bas.as
	}
}
//========== Interval Statements ==========
var ctl_itvl_id :Number ;
var ctl_itvl_distance : Number  ;
var ctl_itvl_dec : Number  ;
var ctl_itvl_endx : Number ;
var ctl_itvl_mode : Boolean ;
function controlSlide(){
	//1.
	// ctl_itvl_mode is true,means it's move right mode , false in  move left mode
	// move distance will change every time , and it has the limited minimize value
	var min = ctl_itvl_mode ? 4:-4 ;
	var check_limited : Boolean =  ctl_itvl_mode ? // if condition statement depend on mode
	( ctl_itvl_distance >= min ) : ( ctl_itvl_distance <= min );
	if( check_limited ) ctl_itvl_distance -= ctl_itvl_dec ;
	else ctl_itvl_distance = min ;
	
	// 2.
	// ctl_itvl_mode is true,means it's move right mode , false in  move left mode
	var check_stop :Boolean = ctl_itvl_mode ? // if condition statement depend on mode
		(ctl_itvl_endx >= ctl_mc_browser._x) : (ctl_itvl_endx <= ctl_mc_browser._x) ;
		// the move right stop condition : move left stop  condition 
	if(check_stop){
		ctl_itvl_distance = 0 ;
		ctl_mc_browser._x = ctl_itvl_endx ;
		clearInterval(ctl_itvl_id);
		// check If Having Pages for showing button
		checkIfHavingPages();
	}
	
	//3.action !
	ctl_mc_browser._x -= ctl_itvl_distance ;
}
