<?php
/**
* 以下變量需根據您的服務器說明檔修改
*/
$dbhost = 'localhost';			// 數據庫服務器
$dbuser = 'root';			// 數據庫用戶名
$dbpw = 'studio';				// 數據庫密碼
$dbname = 'demo';			// 數據庫名
$database = 'mysql';			// 數據庫類型
$PW = 'pw_';					// 表區分符
$pconnect = '0';		// 是否持久連接

/*
MYSQL編碼設置
如果您的論壇出現亂碼現象，需要設置此項來修復
請不要隨意更改此項，否則將可能導致論壇出現亂碼現象
*/
$charset='big5';

/**
* 論壇創始人,擁有論壇所有權限
*/
$manager='demo';			//管理員用戶名
$manager_pwd='441221a8ca022483d6364d2bb7f98e01';	//管理員密碼

/**
* 鏡像站點設置
*/
$db_hostweb='1';		//是否為主站點

/*
* 附件url地址，以http:// 開頭的絕對地址  為空使用默認
*/
$attach_url=array();



/**
* 插件配置
*/
$db_hackdb=array(

		'bank'=>array('銀行','bank','0'),
		'colony'=>array('朋友圈','colony','0'),
		'advert'=>array('廣告管理','advert','0'),
		'new'=>array('首頁調用管理','new','0'),
		'medal'=>array('勛章中心','medal','0'),
		'toolcenter'=>array('道具中心','toolcenter','0'),
		'blog'=>array('博客','blog','0'),
		'invite'=>array('邀請注冊','invite','0'),
		'passport'=>array('通行證','passport','0'),
		'team'=>array('團隊管理工資設置','team','0'),
		
		);
?>