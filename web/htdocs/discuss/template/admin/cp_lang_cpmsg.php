<?php

$lang = array (

'check_error'				=>'認證碼錯誤',
'undefine_action'			=>'您沒有權限進行此項操作或此功能未完成',
'login_out'					=>"成 功 退 出 管 理<br><br><a href=index.php target=_blank>進 入 首 頁</a>",
'operate_error'				=>"沒有選擇操作對象",
'operate_success'			=>"完成相應操作",
'operate_fail'				=>"操作失敗，請檢查數據完整性",
'upgrade_error'				=>'無此提升方式',
'forumid_error'				=>'版塊ID錯誤,請重試！',
'noenough_condition'		=>'沒有提供足夠的條件',
'manager_right'				=>'只有創始人才能管理和編輯管理員帳號',
'admin_right'				=>'只有管理員才能管理和編輯總版主或版主的帳號',
'forum_right'				=>'您無權對此版塊的帖子進行操作',
'password_confirm'			=>'兩次輸入密碼不一致，請重新輸入',
'username_exists'			=>"該用戶名已經被注冊了,請返回重新填寫.",
'illegal_username'			=>"用戶名太長或包含不可接受字符",
'illegal_password'			=>"密碼包含不可接受字符",
'illegal_email'				=>"email格式錯誤",
'illegal_fid'				=>'非法版塊ID',
'forum_havesub'				=>"該版塊含有子版塊，請先轉移所有子版塊，再進行此操作",
'forum_descrip'				=>'版塊描述字節數不得大于 255',
'recycle_del'				=>"不能刪除回收站，取消回收站功能請到核心設置里取消此功能。",
'user_not_exists'			=>"用戶{$errorname}不存在",
'log_min'					=>"管理日志少于100不允許刪除!!",
'log_del'					=>"已刪除多余的管理日志",
'have_banned'				=>"用戶{$username}已經被禁言,要解除禁言請到會員禁言處設置",
'ban_error'					=>"禁言失敗，{$username}不為會員組，只能禁言會員組",
'ban_limit'					=>"請輸入禁言時間",
'not_banned'				=>"用戶{$username}沒有被禁言",
'credit_error'				=>'無效積分ID',
'login_error'				=>"密碼錯誤,您還可以嘗試{$L_left}次",
'login_fail'				=>"已經連續 $F_count 次進行無效登陸,您將在 20 分鐘內無法正常登陸後台<br>還剩余 $L_T 秒",
'sql_config'				=>"論壇管理員信息錯誤不存在，請重新上傳 sql_config.php文件",
'installfile_exists'		=>"install.php 文件仍然在您的服務器上，請馬上利用 FTP 來將其刪除！！ 當您刪除之後，刷新本頁面重新進入管理中心。",

'hack_error'				=>'未安裝此插件或此插件無後台設置!',

'viewban_free'				=>"完成解除禁言",

'updatecache_step'			=>"正在更新{$start}到{$next}項",

'unite_type'				=>"合並操作只能在版塊之間進行(不包括分類和回收站)",
'unite_same'				=>"源論壇和目標論壇不能相同",

'template_noforum'			=>"目前還沒有使用靜態模版功能的版塊，請先設置需要使用靜態模版功能的版塊",
'template_error'			=>"該版塊沒有啟用靜態模版功能，請先啟用",

'setuser_forumadmin'		=>"設置或取消會員的版主權限，請到<font color='red'>論壇版塊管理</font>處設置",
'setuser_ban'				=>"封禁用戶和解除禁言請到會員禁言處設置",
'setuser_empty'				=>"用戶名,密碼或email為空",
'setuser_img'				=>"頭像網址必須以 'http' 開頭.",

'setting_http'				=>"使用跨台圖片鏈必須以http開頭",
'config_777'				=>"<font color=red>無法修改論壇核心,請將 data/bbscache/config.php 文件屬性設為可寫模式(777)</font>",
'setting_777'				=>'<font color=red>無法更改圖片或附件目錄名,請設置其屬性為可寫模式(777)</font>',
'setting_direrror'			=>"<font color=red>圖片或附件目錄{$errordir}不存在</font>",
'setting_recycle_type'		=>"不能將分類設置為回收站",
'setting_recycle_error'		=>"設置的回收站版塊ID不存在，請先建立一個版塊，再把回收站ID設為新建版塊的ID",
'setting_gd_error'          =>'圖片水印功能開啟失敗: PHP編譯時需要同時支持gd jpeg freetype',

'style_add_success'			=>"添加風格完成,請速到images目錄下建立{$setting[0]}並放上相應的圖片",
'style_exists'				=>"此名稱已存在，請另選名稱",
'style_empty'				=>"名稱不能為空",
'style_not_exists'			=>"此風格不存在",
'style_del_error'			=>"不能刪除默認風格,請先更換默認風格",
'style_777'					=>"請將此文件(template/$tplpath/header.htm)屬性設置為 777 可寫模式",

'setforum_empty'			=>"版塊名稱為空，請填寫",
'setforum_cms'				=>"CMS分類的上級分類或子分類只能是CMS分類",
'setforum_fupsame'			=>'不能將所屬上級分類設為自己.',

'sendmsg_step'				=>"正在發送,一共要發送 $count 個用戶，目前已經發送了 $havesend 個用戶",
'sendmsg_success'			=>"發送完成:一共發送了{$count}個用戶",
'sendmsg_empty'				=>"主題和內容不能為空！！",

'postcache_emmpty'			=>"動作或表情內容為空，請完整填寫",

'level_del'					=>"不能刪除默認組",
'level_credit_error'		=>"評分設置錯誤,請返回重新設置!",

'hackcenter_empty'			=>"插件信息不完整，請重新填寫！",
'hackcenter_sign_exists'	=>"插件標識符{$hacksign}已經存在，請另外選擇標識符",
'hackcentre_upload'         =>"找不到插件文件,請先上傳文件!",
'hackcentre_file_writable'  =>"安裝失敗,請設置插件data目錄777屬性!",

'hackcenter_del'			=>'卸載失敗，插件不存在或已經被卸載',
'hackcenter_del_fail'       =>"插件卸載完成刪除以下文件夾失敗，請手動刪除<br> hack 目錄下的 {$id} 目錄",
'hackcenter_del_success'	=>"插件卸載完成刪除以下文件失敗，請手動刪除<br>{$faildelfile}",

'bakup_in'					=>"正在導入第{$i}卷備份文件，程序將自動導入余下備份文件...",
'bakup_out'					=>"已全部備份,備份文件保存在data目錄下，備份文件為<br>$bakfile",
'bakup_step'				=>"正在備份數據庫表 $t_name: 共 $rows 條記錄，已經備份至 $c_n  條記錄<br><br>已生成 $f_num 個備份文件，程序將自動備份余下部分",

'attachstats_del'			=>"共刪除{$count}條記錄，{$delnum}個附件<br>已刪除:<br>$delname",
'attach_renew'				=>"附件修復完成,共{$count}處附件被修復",

'annouce_right'				=>'您沒有權限編輯該公告',
'annouce_empty'				=>"標題和內容為空，請完整填寫",
'annouce_all'				=>"您沒有發表'論壇公告'的權限",
'annouce_category'			=>"您沒有發表'分類公告'的權限",
'annouce_forum'				=>"您沒有發表'版塊公告'的權限",

'bankset_rate_error'		=>'轉換率設置錯誤，應為大零的整數',
'bankset_rate_bug'          =>'<font color="red">積分I到積分積分II</font> 的轉換比例應該小于或等于 <font color="red">積分I到積分積分II</font> 的轉換比例',
'bankset_exists'			=>"{$c_types[$jifen1]}與{$c_types[$jifen2]}之間的轉化已經存在",
'bankset_save'				=>"同種積分之間不能轉換",

'forum_name'				=>'版塊名稱字節數不得大于 50',
'session_error'				=>'登陸後台失敗, 請先登陸服務器設置 data/bbscache 目錄屬性為可寫(777模式)',

'htm_error'					=>"分類︰“{$f_name}” 沒有啟用靜態模版功能，請先啟用",

'atc_error'					=>"主題或內容為空",

'no_cmscate'				=>"目前還沒有設置文章分類,請先到 \"<a href=\"admin.php?adminjob=c_forum\"><font color=\"red\">文章分類管理</font></a>\" 中設置文章分類",

'ipsearch_username'			=>'請輸入要搜索的用戶名.',
'ipsearch_userip'			=>'請輸入要搜索的IP',

'attach_step'				=>"已經搜索了 $num 個文件, 程序在自動搜索更多的結果,請耐心等待...",
'attach_success'			=>'已經完成搜索,正在進入搜索結果列表.',
'attach_delfile'			=>"附件刪除成功.",	

'forum_not_exists'			=>"版塊不存在。",
'forum_hidden'				=>'將版塊設置為隱藏版塊，需要同時設置允許‘瀏覽版塊’的用戶組',

'numerics_checkfailed'		=>'您提交的數據中包含非法數據,請返回重新操作.',
'record_aminonly'			=>'只有管理員才能刪除日志記錄',
'member_only'				=>'批量添加用戶組功能只允許對普通用戶進行操作。',
'chiefadmin_right'			=>'只有論壇創始人和管理員能添加總版主。',
'word_error'				=>'您提交的內容中含有‘&lt;iframe’‘&lt;script’‘&lt;meta’等系統禁用的HTML標簽，請聯系論壇創始人解決。',

'msg_managerright'			=>'您沒有權限查看或刪除創始人的短消息！',
'msg_adminright'			=>'您沒有權限查看或刪除管理員的短消息！',

'colonyset_empty'=>'分類名稱不能為空',
'colonyset_same'=>'該分類名已經存在，請另外選擇一個分類名。',
'colonyset_addsuccess'=>'分類添加成功。',
'colonyset_delname'=>"請輸入要刪除的{$cn_name}名稱。",
'colonyset_noclass'=>"您要刪除的{$cn_name}不存在。",
'colonyset_delsuccess'=>"{$cn_name}刪除成功。",
'currrate_error'=>"<font color=\"red\">{$db_currencyname}到論壇積分</font> 的轉換比例要小于或等于 <font color=\"red\">論壇積分到{$db_currencyname}</font> 的轉換比例",
'cecode_error'=>"訪問域名出錯，請使用合法的後台管理域名訪問該頁面，如果疑問請聯系論壇創始人<br><br>論壇創始人帳號︰{$manager}",

'unituser_newname_error' => "目標用戶不存在，請檢查您輸入是目標用戶是否正確！",
'unituser_username_error' => "原用戶ID ‘{$value}’ 不存在，請檢查您輸入是原用戶ID是否正確！",
'unituser_username_empty' => "原用戶ID不能為空！",
'unituser_newname_empty' => "目標用戶ID不能為空！",
'unituser_samename'=>'原用戶ID不能和目標用戶ID相同',
'delattach_step'=>"正在刪除論壇冗余附件，已經刪除 $deltotal 個附件，程序將自動完成整個過程，請耐心等待...",
'ip_ban'=>'系統限制了允許進入後台的IP，您的IP無權訪問該頁面。',

'module_id_error'=>'模塊ID錯誤，該模塊不存在！',
'module_adderror'=>'調用變量名和模塊標題不能為空',
'advert_code_error'=>'廣告代碼不能為空',
'advert_txt_error'=>'文字內容和文字鏈接不能為空',
'advert_img_error'=>'圖片地址和圖片鏈接不能為空',
'advert_flash_error'=>'flash 鏈接不能為空',
'attachrenew_forbidden'=>'您的網站使用了遠程附件功能，附件修復功能失效。',

'fieldid_error'=>'您要編輯欄目ID錯誤。',
'options_error'=>'請填寫選項內容',

'no_module_fid'=>'沒有選擇分類',
'same_varname'=>'該模塊標識符已經存在，請使用其它模塊標識符。',
'please_settime'=>"請到計劃任務里設置相應的時間，才能正常使用該功能!",
'uptime_has'=>'該用戶已經設置了系統組有效期限!',
'help_empty'=>"標題和內容不能為空，請完整填寫!",
'gid_same'=>'限期頭餃和到期變成頭餃不能相同!',
'right_set'=>'該用戶權限已經設置!',
'descrip_long'=>'版塊介紹超過限定字符，請刪掉一些!',
'groups_empty'=>'該用戶沒有可用的用戶組可以設置!',
'illegal_request'=>'非法請求，請返回重試!',
'undefined_action'=>'非法操作，請返回重試!',
);
?>