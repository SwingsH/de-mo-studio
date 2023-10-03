//	---------------------------
//	String.replace
//	---
//	Author: info@sephiroth.it
//	http://www.sephiroth.it
//	2002-02-20 01:53:57
//	Flash 5
//	----------------------------

// ----------------------- 
// Replace single or 
// multiple chars in a 
// String. 
// The original string is 
// not affected. 
// 
// Based on a idea of 
// Davide Beltrame (Broly) 
// mail: davb86@libero.it 
// ----------------------- 
String.prototype.replace = function() 
{
	var arg_search, arg_replace, position; 
	var endText, preText, newText; 
	arg_search = arguments[0];
	arg_replace = arguments[1];
	if(arg_search.length==1) return this.split(arg_search).join(arg_replace);
		position = this.indexOf(arg_search); 
	if(position == -1) return this; 
		endText = this; 
	do 
	{ 
		position = endText.indexOf(arg_search); 
		preText = endText.substring(0, position) 
		endText = endText.substring(position + arg_search.length) 
		newText += preText + arg_replace; 
	} while(endText.indexOf(arg_search) != -1) 
	newText += endText; 
	return newText; 
} 
/*
// --------------------- 
// USAGE: 
// --------------------- 
originalString = "This is the original fucking text. What the hell are you typing?" 
replacedText = originalString.replace('fuck','***'); 
trace("-----------------------------"); 
trace("original was: " + originalString); 
trace("replaced is: " + replacedText);
*/