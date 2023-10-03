<?php
$logtype=array(
	'bk_save'   => '存款',
	'bk_draw'   => '取款',
	'bk_vire'   => '轉帳',
	'bk_credit' => '轉換',

	'topped'    => '置頂',
	'digest'    => '精華',
	'highlight'	=> '加亮',
	'push'		=> '提前',
	'locked'	=> '鎖定',
	'delrp'		=> '刪回復',
	'deltpc'	=> '刪主題',
	'delete'	=> '刪除',
	'move'		=> '移動',
	'copy'		=> '復制',
	'edit'		=> '編輯',
	'shield'    => '屏蔽',
	'unite'     => '合並',
	'remind'    => '提示',

	'credit'	=> '評分',
	'deluser'	=> '用戶',

	'cy_donate'	=> '捐獻',
	'cy_join'	=> '加群',
	'cy_vire'	=> '轉帳',
);

$lang = array (
	'bk_save_descrip_1'		=>	"[b]{$log[username1]}[/b]使用活期存款功能，存入金額︰{$log[field1]}{$db_moneyname}",
	'bk_save_descrip_2'		=>	"[b]{$log[username1]}[/b]使用定期存款功能，存入金額︰{$log[field1]}{$db_moneyname}",
	'bk_draw_descrip_1'		=>	"[b]{$log[username1]}[/b]使用活期取款功能，取出金額︰{$log[field1]}{$db_moneyname}",
	'bk_draw_descrip_2'		=>	"[b]{$log[username1]}[/b]使用定期取款功能，取出金額︰{$log[field1]}{$db_moneyname}",
	'bk_vire_descrip'		=>	"[b]{$log[username1]}[/b]使用轉帳功能，轉帳給[b]{$log[username2]}[/b]金額︰{$log[field1]}{$db_moneyname}",
	'bk_credit_descrip'		=>	"[b]{$log[username1]}[/b]使用積分轉換功能，將{$log[sellname]}轉換為{$log[buyname]},總共花費 {$log[sellname]}:{$log[field1]}，獲得 {$log[buyname]}:{$log[field2]}",

	'topped_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章設為置頂{$log[topped]}\n原因︰{$log[reason]}",
	'untopped_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰解除文章置頂\n原因︰{$log[reason]}",
	'digest_descrip'		=> "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章設為精華{$log[digest]}\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'undigest_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰取消文章精華\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'highlight_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章標題加亮\n原因︰{$log[reason]}",
	'unhighlight_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章標題取消加亮\n原因︰{$log[reason]}",
	'push_descrip'			=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章提前\n原因︰{$log[reason]}",
	'lock_descrip'			=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章鎖定\n原因︰{$log[reason]}",
	'unlock_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章解除鎖定\n原因︰{$log[reason]}",
	'delrp_descrip'			=> "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰刪除回復\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'deltpc_descrip'		=> "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰刪除主題\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'del_descrip'		=>  "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章刪除\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'move_descrip'			=>  "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章移動到新版塊([url=$db_bbsurl/thread.php?fid={$log[tofid]}][b]$log[toforum][/b][/url])\n原因︰{$log[reason]}",
	'copy_descrip'			=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰將文章復制到新版塊([url=$db_bbsurl/thread.php?fid={$log[tofid]}][b]$log[toforum][/b][/url])\n原因︰{$log[reason]}",
	'edit_descrip'			=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰編輯文章",

	'credit_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰文章被評分\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'creditdel_descrip'		=>	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰文章評分被取消\n原因︰{$log[reason]}\n影響︰{$log[affect]}",
	'deluser_descrip'		=>	"用戶 [b]{$log[username1]}[/b] 被刪除\n操作︰批量刪除用戶",

	'join_descrip'		=> "[b]{$log[username1]}[/b] 加入群[b]{$log[cname]}[/b]，花費交易幣︰{$log[field1]}。",
	'donate_descrip'	=> "[b]{$log[username1]}[/b] 使用捐獻給所在群($log[cname])捐獻交易幣︰{$log[field1]}。",
	'cy_vire_descrip'	=> "[b]{$log[username2]}[/b] 使用群交易幣管理功能，給用戶[b]{$log[username1]}[/b]轉帳 {$log[field1]}交易幣，系統收取手續費︰{$log[tax]}。",
	'shield_descrip'		=> "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰屏蔽主題\n原因︰{$log[reason]}",
	'unite_descrip'     =>
	"文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰主題合並\n原因︰{$log[reason]}",
	'remind_descrip'		=> "文章︰[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n操作︰管理提示\n原因︰{$log[reason]}",
);
?>