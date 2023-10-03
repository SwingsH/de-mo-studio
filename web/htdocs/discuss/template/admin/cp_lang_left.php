<?php
$_yes='是';
$_no='否';
$lang=array(
	'論壇核心設置'=>array(
		'settings'=>array(
			"<a target=main href='$admin_file?adminjob=settings&type=all'>所有設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=bbsset'>基本參數設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=basicset'>論壇資料設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=coreset'>核心功能設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=setgd'>認證碼設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=pathset'>動態目錄設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=regset'>會員注冊控制</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=windcode'>發帖代碼設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=attachset'>發帖與附件設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=atcset'>帖子獎懲選項</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=indexset'>首頁細節設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=viewset'>各頁面細節設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=watermark'>圖片水印設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=buysign'>簽名購買設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=ajax'>AJAX 設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=wap'>WAP 設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=js'>JS 調用設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=creditset'>積分名稱設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=mail'>發送郵件設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=safe'>論壇安全控制</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=ftp'>ftp設置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=other'>其它設置</a><br>",
		),
	),
	'網站統籌管理'=>array(
		'sethtm'=>"<a target=main href='$admin_file?adminjob=sethtm'>靜態目錄部署</a><br>",
		'updatecache'=>"<a target=main href='$admin_file?adminjob=updatecache'>緩存數據管理</a><br>",
		'postcache'=>"<a target=main href='$admin_file?adminjob=postcache'>動作表情管理</a><br>",
		'credit'=>"<a target=main href='$admin_file?adminjob=credit&action=newcredit'>添加</a>|<a target=main href='$admin_file?adminjob=credit'>管理自定義積分</a><br>",
		'customcredit'=>"<a target=main href='$admin_file?adminjob=customcredit'>自定義積分管理</a><br>",
	),
	'論壇版塊管理'=>array(
		'setforum'=>"<a target=main href='$admin_file?adminjob=setforum'><font color=blue>版塊管理</font></a><br>",
		'uniteforum'=>"<a target=main href='$admin_file?adminjob=uniteforum'>版塊合並</a><br>",
		'creathtm'=>"<a target=main href='$admin_file?adminjob=creathtm'>生成htm頁面(<font color='blue'>論壇</font>)</a><br>",
	),
	'會員管理'=>array(
		'setuser'=>"<a target=main href='$admin_file?adminjob=setuser'><font color=blue>會員管理</font></a><br>",
		'ipsearch'=>"<a target=main href='$admin_file?adminjob=ipsearch'>會員 IP 檢索</a><br>",
		'unituser'=>"<a target=main href='$admin_file?adminjob=unituser'>合並會員</a><br>",
		'userstats'=>"<a target=main href='$admin_file?adminjob=userstats'>用戶組成員統計</a><br>",
		'upgrade'=>"<a target=main href='$admin_file?adminjob=upgrade'>會員組提升方案</a><br>",
		'editgroup'=>"<a target=main href='$admin_file?adminjob=editgroup'>批量添加用戶組</a><br>",
		'level'=>"<a target=main href='$admin_file?adminjob=level'>用戶組管理</a><br>",
		'uptime'=>"<a target=main href='$admin_file?adminjob=uptime'>管理組有效期設置</a><br>",
		'singleright'=>"<a target=main href='$admin_file?adminjob=singleright'>單個用戶權限</a><br>",
		'customfield'=>"<a target=main href='$admin_file?adminjob=customfield&action=add'>添加</a> | <a target=main href='$admin_file?adminjob=customfield'>管理</a> 用戶欄目<br>",
	),
	'批量刪除管理'=>array(
			'article'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=article'>刪除帖子</a><br>",
			'member'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=member'>刪除用戶</a><br>",
			'message'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=message'>刪除短消息</a><br>",
			'recycle'=>"<a target=main href='$admin_file?adminjob=recycle'>回收站管理</a><br>",
	),
	'安全管理'=>array(
		'banuser'=>"<a target=main href='$admin_file?adminjob=banuser'>會員禁言</a><br>",
		'viewban'=>"<a target=main href='$admin_file?adminjob=viewban'>查看封禁會員</a><br>",
		'ipban'=>"<a target=main href='$admin_file?adminjob=ipban'>IP 禁止</a><br>",
		'setbwd'=>"<a target=main href='$admin_file?adminjob=setbwd'>不良詞語過濾</a><br>",
	),
	'審核管理'=>array(
		'tpccheck'=>"<a target=main href='$admin_file?adminjob=tpccheck'>主題審核管理</a><br>",
		'postcheck'=>"<a target=main href='$admin_file?adminjob=postcheck'>回復審核管理</a><br>",
		'report'=>"<a target=main href='$admin_file?adminjob=report'>帖子報告管理</a><br>",
		'checkemail'=>"<a target=main href='$admin_file?adminjob=usercheck&a_type=checkemail'>Email會員審核</a><br>",
		'checkreg'=>"<a target=main href='$admin_file?adminjob=usercheck&a_type=checkreg'>注冊會員審核</a><br>",
	),

	'信息管理'=>array(
		'announcement'=>"<a target=main href='$admin_file?adminjob=announcement&action=add'>發布</a> | <a target=main href='$admin_file?adminjob=announcement'>管理</a> 公告<br>",
		'mailuser'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=mailuser'>Email 群發</a><br>",
		'send_msg'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=send_msg'>短消息群發</a><br>",
		'giveuser'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=giveuser'>節日禮物贈送功能</a><br>",
	),

	'附件管理'=>array(
		'attachment'=>"<a target=main href='$admin_file?adminjob=attachment'>附件管理</a><br>",
		'attachstats'=>"<a target=main href='$admin_file?adminjob=attachstats'>附件統計</a><br>",
		'attachrenew'=>"<a target=main href='$admin_file?adminjob=attachrenew'>附件修復</a><br>",
	),
	'管理日志'=>array(
		'adminlog'=>"<a target=main href='$admin_file?adminjob=record&a_type=adminlog'>後台管理安全日志</a> <br>",
		'forumlog'=>"<a target=main href='$admin_file?adminjob=forumlog'>前台管理安全日志</a><br>",
	),
	'輔助管理'=>array(
		'setads'=>"<a target=main href='$admin_file?adminjob=setads'>論壇宣傳設置</a><br>",
		'ipstates'=>"<a target=main href='$admin_file?adminjob=ipstates'>IP統計設置</a><br>",
		'share'=>"<a target=main href='$admin_file?adminjob=share'>友情鏈接管理</a>|<a target=main href='$admin_file?adminjob=share&action=add'>添加</a><br>",
		'viewtody'=>"<a target=main href='job.php?action=viewtody'>查看今日到訪會員</a><br>",
		'chmod'=>"<a target=main href='$admin_file?adminjob=chmod'>文件屬性檢查</a><br>",
		'help'=>"<a target=main href='$admin_file?adminjob=help'>自定義幫助文檔</a><br>",
	),
	'數據庫管理'=>array(
		'bakout'=>"<a target=main href='$admin_file?adminjob=bakup&a_type=bakout'>數據備份</a><br>",
		'bakin'=>"<a target=main href='$admin_file?adminjob=bakup&a_type=bakin'>數據恢復</a><br>",
		'repair'=>"<a target=main href='$admin_file?adminjob=repair'>數據庫修復</a><br>",
	),
	'風格管理'=>array(
		'setstyles'=>"<a target=main href='$admin_file?adminjob=setstyles'>風格模版設置</a><br>",
	),
	'計劃任務'=>array(
		'plantodo'=>"<a target=main href='$admin_file?adminjob=plantodo'>計劃任務管理</a><br>",
		'addplan'=>"<a target=main href='$admin_file?adminjob=addplan'>添加新的計劃任務</a><br>",
	),
	'網上支付設置'=>array(
		'userpay'=>"<a target=main href='$admin_file?adminjob=userpay'>網上支付</a><br>",
		'orderlist'=>"<a target=main href='$admin_file?adminjob=orderlist'>訂單管理</a><br>",
	),
	'論壇交易幣'=>array(
		'currencyset'=>"<a target=main href='$admin_file?adminjob=currencyset'>交易幣設置</a><br>",
		'currency'=>"<a target=main href='$admin_file?adminjob=currency'>交易幣管理</a><br>",
		'toollog'=>"<a target=main href='$admin_file?adminjob=toollog'>交易幣日志</a><br>",
	)
);
?>