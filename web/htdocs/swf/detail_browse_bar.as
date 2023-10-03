/***********************************
*		detail_browser_bar.as  v2
*		Date	: 	2007.07.29
*		Date	: 	2007.11.09
*		Author	:	Swings Huang
* 		Licence:	(C) Swings @ DE-MO.com.tw
************************************/
// describe the default/minimize width , and height
var width_def : Number = 285 ; // just reference //參考用,參數無用
var height_def : Number = 456 ; // just reference //參考用,參數無用
var width_min : Number = 45 ; // the mini pic size
var height_min : Number = 72 ; // the mini pic size
var itvl_width :Number = 6.4 ; // the mini pic interval width
var itvl_height :Number = 1; // the mini pic interval height
// under vars will minimize by scale adjustImageScale
var itvl_border_wh :Number = 15; 
var bb_alpha_def = 10 ;
var bb_alpha_over = 0 ;

function preloadPreviewImages(target_mc:MovieClip,container_mc:MovieClip,images_path:Array):Array{
	var iNums = images_path.length ;
	var arr_images:Array = new Array();
	var t_mc :MovieClip ;
	
	// check if the last pic path is null
	iNums = iNums - (images_path[iNums-1].length==0 ? 1 : 0 ); 
	
	for(var i = 0;i<iNums;i++){
		// parent,id,image path name
		t_mc = createPreviewImages(container_mc,i+1 , images_path[i]) ;
		arr_images.push(t_mc);
	}
	return arr_images ;
}

function createPreviewImages(target_mc:MovieClip,id:Number,image:String):MovieClip{
	//newClip contains image mc
	var newClip:MovieClip = target_mc.createEmptyMovieClip("mc_image_"+id,target_mc.getNextHighestDepth());
	var newClipImage:MovieClip = newClip.createEmptyMovieClip("mc_image",newClip.getNextHighestDepth());
	var newLoader:MovieClipLoader = new MovieClipLoader();
	var listener = new Object();

	newClip.image_path = image ;
	//Loader's Listener
	listener.onLoadInit = function (mc:MovieClip){
		setImageEvent(mc._parent);	//the parent , newClip, contains image mc		 
		// adjust the scale to conform , the change of scale must handle after all content fin
		adjustImageScale(mc._parent , width_min);
	};
	newLoader.addListener(listener);
	
	// Adjust Interval of X , Y 
	newClip._x = (id-1)* (width_min + itvl_width)  ;
	newClip._y -= itvl_height ;
	
	newLoader.loadClip(image,newClipImage);
	return newClip ;
}

//To modify the width and hight
function adjustImageScale(mc:MovieClip , my_width:Number){
	// scale depend on width
	var rate = my_width/mc._width ;
	mc._xscale = 100*rate ;
	mc._yscale = 100*rate ;
}

//============= Event handle and Event Prepare ===========
function setImageEvent(mc:MovieClip){
	setImageEvent.drawBorderFrame(mc); // photo border
	var mc_mask = setImageEvent.drawEffectFrame(mc);
	mc_mask._alpha = bb_alpha_def ;
	mc.mc_effect = mc_mask ; // save mc ref in mc_eff obj
	mc.onRollOver = function(){
		this.mc_effect._alpha = bb_alpha_over ;
	}
	mc.onRollOut = function(){
		this.mc_effect._alpha = bb_alpha_def ;
	}
	mc.onRelease = function(){
		//mainFuncLink.loadImage(this.image_path);
		loadImage(this.image_path);
		//imageContainer_mc._width =  width_def ;
	}
}
setImageEvent.drawEffectFrame = function (mc:MovieClip):MovieClip{
	var mc_eff : MovieClip ;
	var myX = mc._width -itvl_border_wh*2 , myY = mc._height-itvl_border_wh*2 ; 
	//必須先儲存長寬資訊,否則mc依據mc._width會邊畫邊變形
	// ex:mc._width has been changed by mc.drawBorderFrame
	// draw a new effect_mc under newClip:the image_main_mc
	
	mc_eff = mc.createEmptyMovieClip("MC_effect" , mc.getNextHighestDepth());
	mc_eff.beginFill(0x000000,100);
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
	mc_border.lineStyle( -1,0x333333,60);
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