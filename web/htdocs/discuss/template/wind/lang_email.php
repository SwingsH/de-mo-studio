<?php

$lang = array (

'email_check_subject'			=>"激活您在 {$db_bbsname} 會員帳號的必要步驟!",
'email_check_content'			=>"{$rg_name},您好！\n\n{$db_bbsname}歡迎您的到來！\n首先您得激活您的用戶名(點擊下行網址激活,如果用戶名是中文請點擊下行網址激活)\n{$db_bbsurl}/register.php?vip=activating&r_uid={$winduid}&pwd={$timestamp}\n您的注冊名為:{$rg_name}\n您的密碼為:{$regpwd}\n請盡快刪除此郵件，以免別人偷看到您的密碼\n\n如果忘了密碼，可以到社區寫信請管理員重新設定\n請查看社區各版的發貼規則，以免帖子被刪除\n社區地址︰{$db_bbsurl}\n\n本社區采用 PHPWind 架設,歡迎訪問: http://www.phpwind.com",
'email_additional'				=>"From:{$fromemail}\r\nReply-To:{$fromemail}\r\nX-Mailer: PHPWind郵件快遞",
'email_welcome_subject'			=>"{$rg_name},您好,感謝您注冊{$db_bbsname}",
'email_welcome_content'			=>"{$rg_name},您好！\n\n{$db_bbsname}歡迎您的到來！\n您的注冊名為:{$rg_name}\n您的密碼為:{$regpwd}\n請盡快刪除此郵件，以免別人偷看到您的密碼\n\n如果忘了密碼，可以到社區寫信請管理員重新設定\n請查看社區各版的發貼規則，以免帖子被刪除\n社區地址︰{$db_bbsurl}\n\n本社區采用 PHPWind 架設,歡迎訪問: http://www.phpwind.com",
'email_sendpwd_subject'			=>"{$db_bbsname} 密碼重發",
'email_sendpwd_content'			=>"請到下面的網址修改密碼︰ \n {$db_bbsurl}/sendpwd.php?action=getback&pwuser={$pwuser}&submit={$submit}\n修改後請牢記您的密碼\n歡迎來到 {$db_bbsname}我們的網址是:{$db_bbsurl}\n",
'email_reply_subject'			=>"{$receiver}您在{$db_bbsname}的帖子有回復",
'email_reply_content'			=>"Hi, {$receiver} ,\n    我是{$db_bbsname}郵件大使，\n    您在{$db_bbsname}發表的文章: {$old_title}\n    現在有人回復.快來關注一下吧\n    {$db_bbsurl}/read.php?fid={$fid}&tid={$tid}\n    下次再有人參與主題時,我將不來打擾了\n\n___________________________________\n歡迎訪問 {$db_wwwname}\n本社區采用PHPWind 架設,歡迎訪問: http://www.phpwind.com",

);
?>