function CheckAll(form){
	for (var i=0;i<form.elements.length;i++){
		var e = form.elements[i];
		e.checked == true ? e.checked = false : e.checked = true;
	}
}

function atccheck()
{
	if(document.FORM.atc_title.value==''){
		alert('標題為空');
		document.FORM.atc_title.focus();
		return false;
	} else if(document.FORM.fid.value==''){
		alert('沒有選擇文章所屬分類');
		document.FORM.fid.focus();
		return false;
	}
	_submit();
}

function checkhackset(chars)
{
	if(!confirm("確定要卸載此插件嗎? 如果您卸載了此插件,程序將自動刪除插件相關文件，請確認!"))
		return false;
	location.href=chars;
}

function level_jump(admin_file)
{
	var URL=document.mod.selectfid.options[document.mod.selectfid.selectedIndex].value;
	location.href=admin_file+"?adminjob=level&action=editgroup&gid="+URL;selectfid='_self';
}

function checkgroupset(chars)
{
	if(!confirm("確定刪除嗎? 如果您刪除了此用戶組,請到論壇緩存數據管理更新用戶頭餃緩沖!"))
		return false;
	location.href=chars;
}

function report_jump(admin_file){
	var URL=document.form1.type.options[document.form1.type.selectedIndex].value;
	location.href=admin_file+"?adminjob=report&type="+URL;
}