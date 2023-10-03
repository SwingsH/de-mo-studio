var timePopup=60;
var ns=(document.layers);
var ie=(document.all);
var w3=(document.getElementById && !ie);
var adCount=0;
var hdCount=0;
var iTime;
function initPopup(){
	if(!ns && !ie && !w3){
		return;
	}
	if(ie){
		adDiv=eval('document.all.windlocation.style');
	}else if(ns){
		adDiv=eval('document.layers["windlocation"]');
	}else if(w3){
		adDiv=eval('document.getElementById("windlocation").style');
	}
	if (ie||w3){
		adDiv.visibility="visible";
	}else{
		adDiv.visibility ="show";
	}
	showPopup();
}
function showPopup(){
	if (ie){
		documentWidth  =document.body.offsetWidth;
		documentHeight =document.body.offsetHeight+document.body.scrollTop-90;
	} else if (ns){
		documentWidth  =window.innerWidth;
		documentHeight =window.innerHeight+document.body.scrollTop-90;
	} else if (w3){
		documentWidth  =self.innerWidth;
		documentHeight =self.innerHeight+document.body.scrollTop-90;
	}
	adDiv.left=documentWidth-220;

	if(adCount < 10){
		adCount++;
		adDiv.top = documentHeight+80-adCount*8;
		iTime = setTimeout("showPopup()",100);
	}else if(adCount < timePopup-10){
		adCount++;
		adDiv.top = documentHeight;
		iTime = setTimeout("showPopup()",100);
	}else if(adCount < timePopup){
		adCount++;
		hdCount++;
		adDiv.left=documentWidth-220;
		adDiv.top = documentHeight+hdCount*8;
		iTime = setTimeout("showPopup()",100);
	}else{
		closePopup();
	}
}
function closePopup(){
	if (ie||w3){
		adDiv.display="none";
	}else{
		adDiv.visibility ="hide";
	}
}
function clearpop(){
	clearTimeout(iTime);
}
function hide(){
	closePopup();
	document.cookie="msghide=1; path=/";
}
onload=initPopup;