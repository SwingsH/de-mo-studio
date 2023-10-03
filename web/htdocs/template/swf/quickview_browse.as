/***********************************
*		2007.08.12
*		quickview_browser.as v1.1  (modify  from detail_browse_bar.as  v1.0)
* 		(C) Swings @ DE-MO.com.tw
************************************/
// describe the default/minimize width , and height

var width_min : Number = 80 ; // the mini pic size
var height_min : Number = 128 ; // the mini pic size
var itvl_width :Number = 3.9 ; // the mini pic interval width
var itvl_height :Number = 1; // the mini pic interval height
// under vars will minimize by scale adjustImageScale
var itvl_border_wh :Number = 0; 
var qb_alpha_def = 0 ;
var qb_alpha_over = 30 ;
var qb_image_link : Array ;
// Set If Use the Instance MC or self create MC
var bol_use_instancemc : Boolean =true ;
// Interval for Word Space
var itvl_word_spaceX = 161 ;   // Interval for Word Space
var itvl_word_spaceY = 151 ;  // Interval for Word Space

//var qb_style_list = new Array("日系風", "美式休閒風", "  名媛風  " , "  OL風  " ,  "  裏原宿  " , "    嘻哈    " , "休閒型男" ,  "   雅痞風   " ) ;

// preloadPreviewImages work as  main function
function preloadPreviewImages(target_mc:MovieClip,container_mc:MovieClip, images_path:Array , image_link :Array ):Array{
	var iNums = images_path.length ;
	var arr_images:Array = new Array();
	var t_mc :MovieClip ;
	 qb_image_link  = image_link  ;
	 
	// check if the last pic path is null
	iNums = iNums - (images_path[iNums-1].length==0 ? 1 : 0 ); 
	
	for(var i = 0;i<iNums;i++){
		// parent,id,image path name
		t_mc = createPreviewImages(container_mc,i+1 , images_path[i]) ;
		arr_images.push(t_mc);
	}
	// temp for OL風格
	delete arr_images[3].onRelease ;
	delete arr_images[3].onRollOver ;
	delete arr_images[3].onRollOut ;
	return arr_images ;
}

// Create one  Preview Movie Clip
function createPreviewImages(target_mc:MovieClip,id:Number,image:String):MovieClip{
	//newClip contains image mc
	var newClip:MovieClip =  getImageContainer( target_mc , id);
	var newClipImage:MovieClip = newClip.createEmptyMovieClip("mc_image",newClip.getNextHighestDepth());
	var newLoader:MovieClipLoader = new MovieClipLoader();
	var listener = new Object();

	newClip.image_path = image ;
	//Loader's Listener
	listener.onLoadInit = function (mc:MovieClip){
		//Setup ID Information
		mc._parent.id = id ;

		setImageEvent(mc._parent);	//the parent , newClip, contains image mc		 
		// adjust the scale to conform , the change of scale must handle after all content fin
		
		adjustImageScale(mc._parent , width_min);
		
	};
	newLoader.addListener(listener);
	
	// Adjust Interval of X , Y 
	newClip._x = ( (id-1) % 4 )* ( itvl_width + itvl_word_spaceX)  ;
	newClip._y = newClip._y  - itvl_height  + Math.floor( (id-1 )/4 )*itvl_word_spaceY   ;
	
	// Start Load
	newLoader.loadClip(image,newClipImage);
	return newClip ;
}

function attachImageFocusMask( mc : MovieClip) : MovieClip{
	// Set the Second Mask Effect
	var mc_mask : MovieClip = mc.attachMovie("mc_focus","mc_focus",mc.getNextHighestDepth() );
	// The W H must the same with mc's ;
	mc_mask._width = mc._width ;
	mc_mask._height = mc._height ; 
	return mc_mask ;
}

// Get The Image Container
function  getImageContainer( father_mc: MovieClip , id : Number ):MovieClip{
	return bol_use_instancemc ? 
	 father_mc.createEmptyMovieClip("mc_image_"+id , father_mc.getNextHighestDepth()) : 
	 father_mc.createEmptyMovieClip("mc_image_"+id , father_mc.getNextHighestDepth()) ;
}

//To modify the width and hight
function adjustImageScale(mc:MovieClip , std_width:Number){
	// scale depend on width
	var rate = std_width/ (mc._width ) ;
	mc._height *= rate ;
	mc._width *= rate ;
}
//============= Text MovieClip ======================
// Create Text Clip under mc:arr_imgs , quickview_browser.as v1.0 專用
function createTextClip(  arr_imgs:Array , arr_link : Array){
	
	var father = arr_imgs[0]._parent  ;
	trace( father);
	var mc : MovieClip ;
	var mc_mask : MovieClip ;
	var txt : TextField ;
	var itvl_y = 1 ;
	// if Use Dynamic txt , Under 1 Lines
	//var txt_w = 65  , txt_y = 20 ;
	for( var i = 0 ; i < arr_imgs.length ; i++){
		// if Use Dynamic txt , Under 1 Lines
		//mc = father.createEmptyMovieClip("mc_style_" + i , father.getNextHighestDepth() );
		mc = father.attachMovie( "mc_styletxt_"+(i+1) , "mc_styletxt_"+(i+1) , father.getNextHighestDepth());
		
		createTextClipIcon( mc );
		
		//mask
		mc_mask = mc.attachMovie( "mc_cover_mask" , "mc_cover_mask" , father.getNextHighestDepth());
		setProperty(mc_mask , _y , -3);
		setProperty(mc_mask , _x , 0);
		setProperty(mc_mask , _alpha , 50 );
		setProperty(mc_mask , _visible , false );
		
		// Let mc adjust to mc_image
		setProperty(mc ,  _x , arr_imgs[i]._x  + width_min+ 3 ) ;
		setProperty(mc ,  _y , arr_imgs[i]._y + 5 ) ;
		// if Use Dynamic txt , Under 3 Lines
		//txt = mc.createTextField("txt_style" , mc.getNextHighestDepth() , ( width_min - txt_w)/2 ,  height_min + itvl_y ,  txt_w ,  txt_y );
		//setTextClipFormat( txt , qb_style_list[i] );
		setTextClipEvent( mc , arr_link[i] );
	}
}

function createTextClipIcon(my_mc:MovieClip){
	var my_icon = my_mc.attachMovie( "mc_icon" ,  "mc_icon" , my_mc.getNextHighestDepth());
	my_icon._visible = false ;
	
	//my_icon._x =  my_icon._x  - (my_icon._width) +2 ;
	//my_icon._visible = false ;
	//setProperty( my_icon , _visible , false ) ;
	//trace(my_icon);
}

function  setTextClipEvent( mc :MovieClip , link : String ){
	mc.onRollOver = function(){
		//trace(this.mc_icon);
		setProperty(mc.mc_cover_mask , _visible , true );
		mc.mc_cover_mask.gotoAndPlay("Play");
		this.mc_icon._visible = true ;
	}
	mc.onRollOut = function(){
		setProperty(mc.mc_cover_mask , _visible , false );
		mc.mc_cover_mask.gotoAndStop("Stop");
		this.mc_icon._visible = false ;		
	}
	mc.onRelease = function(){
		if( !_root["window"]){
			getURL(link , "_blank" );
		}
		else{
			getURL(link , "_self" );
		}
	}
}
// if Use Dynamic txt , Under 1 Function
function  setTextClipFormat( tf : TextField , word : String ){
	var fmt :TextFormat = new TextFormat();
	fmt.italic = true ;
	fmt.bold = true ;

	tf.setTextFormat( fmt );
	tf.autoSize = "center";
	tf.selectable = false ;
	tf.text = word ;
}

//============= Event handle and Event Prepare ===========
//  specific to  quickview_browser.as v1.0 
function setImageEvent(mc:MovieClip){
	// Set the Second Mask "Focus" Effect
	var mc_focus_mask = attachImageFocusMask(  mc );
	
	setImageEvent.drawBorderFrame(mc); // photo border
	var mc_mask = setImageEvent.drawEffectFrame(mc);
	mc_mask._alpha = qb_alpha_def ;
	mc.mc_effect = mc_mask ; // save mc ref in mc_eff obj
		
	mc.onRollOver = function(){
		this.mc_effect._alpha = qb_alpha_over ;
		mc_focus_mask .gotoAndPlay("Over");
	}
	mc.onRollOut = function(){
		this.mc_effect._alpha = qb_alpha_def ;
		mc_focus_mask .gotoAndStop("Out");
	}
	mc.onRelease = function(){
		//mainFuncLink.loadImage(this.image_path);
		loadImage(this.image_path);
		//imageContainer_mc._width =  width_def ;
		setImageEvent.goLink( qb_image_link[this.id -1 ] );
	}
}
setImageEvent.goLink = function(myURL : String){
	//trace(myURL);
		if( !_root["window"]){
			getURL(myURL , "_blank" );
		}
		else{
			getURL(myURL, "_self" );
		}
}
setImageEvent.drawEffectFrame = function (mc:MovieClip):MovieClip{
	var mc_eff : MovieClip ;
	var myX = mc._width -itvl_border_wh*2 , myY = mc._height-itvl_border_wh*2 ; 
	//trace(myX);
	
	//必須先儲存長寬資訊,否則mc依據mc._width會邊畫邊變形
	// ex:mc._width has been changed by mc.drawBorderFrame
	// draw a new effect_mc under newClip:the image_main_mc
	
	mc_eff = mc.createEmptyMovieClip("MC_effect" , mc.getNextHighestDepth());
	mc_eff.beginFill(0xFFFFFF, 60);
	mc_eff.moveTo(0 ,0);
	mc_eff.lineTo(myX,0);
	mc_eff.lineTo(myX,myY);
	mc_eff.lineTo(0, myY);
	mc_eff.lineTo(0 ,0);
	mc_eff.endFill();
	return mc_eff ;
}
setImageEvent.drawBorderFrame = function (mc:MovieClip){
	var mc_border : MovieClip ;
	var myX = mc._width + itvl_border_wh , myY = mc._height + itvl_border_wh;
	//必須先儲存長寬資訊,否則mc依據mc._width會邊畫邊變形
	// draw a new effect_mc under newClip:the image_main_mc
	mc_border = mc.createEmptyMovieClip("MC_border" , -1000);//mc.getNextHighestDepth()
	mc_border.lineStyle( 5 ,0x000000,80);
	mc_border.beginFill( 0xFFFFFF,100);
	mc_border.moveTo(-itvl_border_wh,-itvl_border_wh);
	mc_border.lineTo(myX,-itvl_border_wh);
	mc_border.lineTo(myX,myY);
	mc_border.lineTo(-itvl_border_wh, myY);
	mc_border.lineTo(-itvl_border_wh,-itvl_border_wh);
	mc_border.endFill();
}
setImageEvent.doFlickerEffect = function(mc_effect:MovieClip){
	
}
//============= Link to Original Function ===========
var mainFuncLink : Object = new Object();
mainFuncLink.loadImage = loadImage ;