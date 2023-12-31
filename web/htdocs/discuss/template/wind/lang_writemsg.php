<?php
$msg_add = "\n\n[b]文章︰[/b][url=$db_bbsurl/read.php?tid=$msg[tid]]$msg[subject][/url]\n[b]發表日期︰[/b]$msg[postdate]\n[b]所在版塊︰[/b][url=$db_bbsurl/thread.php?fid=$msg[fid]]$msg[forum][/url]\n[b]操作時間︰[/b]{$msg[admindate]}\n[b]操作理由︰[/b]$msg[reason]\n\n論壇管理操作通知短消息，對本次管理操作有任何異議，請與我取得聯系。";

$lang = array (
	'olpay_title'=>'交易幣充值支付成功.',
	'olpay_content'=>"交易幣充值支付成功，您需要登錄支付寶使用“[color=red]確認收貨[/color]”功能完成本次交易。\n確認收貨後系統會自動對您的交易幣帳戶進行充值。",
	'olpay_content_2'=>"交易幣充值成功，本次充值金額︰{$number}RMB，總共獲得交易幣個數︰{$currency}。\n謝謝使用！",
	'virement_title'=>'銀行匯款通知!!',
	'virement_content'=>"用戶{$windid}通過銀行給你轉帳{$to_money}元錢，系統自動把以前的利息加到你的存款中，你的利息將從現在重新開始計算",

	'metal_add'=>'授予勛章通知',
	'metal_add_content'=>"您被授予勛章\n\n勛章名稱︰{$_MEDALDB[$medal][name]}\n操作:{$windid}\n理由︰{$reason}",
	'metal_cancel'=>'收回勛章通知',
	'metal_cancel_content'=>"您的勛章被收回\n\n勛章名稱︰{$_MEDALDB[$medal][name]}\n操作:{$windid}\n理由︰{$reason}",
	'metal_cancel_text'=>"您的勛章被收回\n\n勛章名稱︰$medalname\n操作:SYSTEM\n理由︰過期",
	'vire_title'=>'交易幣轉帳通知',
	'vire_content'=>"用戶 [b]{$windid}[/b] 使用交易幣轉帳功能，給您轉帳 {$currency} 交易幣，請注意查收。",
	'cyvire_title'=>"{$cn_name}交易幣轉帳通知",
	'cyvire_content'=>"{$cn_name}([url=$db_bbsurl/hack.php?H_name=colony&cyid=$cyid&job=view&id=$cyid]$cydb[cname][/url])管理員使用交易幣管理功能，給你轉帳 {$currency} 交易幣，請注意查收。",
	'donate_title'=>"{$cn_name}捐獻通知消息",
	'donate_content'=>"用戶{$windid}通過捐獻功能，給{$cn_name}({$cydb[cname]})捐獻交易幣︰{$sendmoney}。",
	'join_title'=>"加入{$cn_name}通知消息",
	'join_content'=>"您已經成功加入{$cn_name}($cydb[cname]),[url=$db_bbsurl/hack.php?H_name=colony&cyid=$cyid&job=view&id=$cyid]馬上開始體驗[/url]",

	'top_title'		=> '您的文章被置頂.',
	'untop_title'	=> '您的文章被解除置頂.',
	'top_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]置頂[/b] 操作{$msg_add}",
	'untop_content'	=> "您的文章被 [b]{$msg[6]}[/b] 執行 [b]解除置頂[/b] 操作{$msg_add}",
	'digest_title'	=> '您的文章被設為精華帖',
	'digest_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]精華[/b] 操作\n對您的影響︰{$msg[affect]}{$msg_add}",
	'undigest_title'	=> '您的文章被取消精華',
	'undigest_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]取消精華[/b] 操作\n對您的影響︰{$msg[affect]}{$msg_add}",
	'lock_title'	=> '您的文章被鎖定',
	'lock_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]鎖定[/b] 操作{$msg_add}",
	'unlock_title'	=> '您的文章被解除鎖定',
	'unlock_content'=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]解除鎖定[/b] 操作{$msg_add}",
	'push_title'	=> '您的文章被提前',
	'push_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]提前[/b] 操作{$msg_add}",
	'unhighlight_title'	=> '您的文章標題被取消加亮顯示',
	'unhighlight_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]標題取消加亮[/b] 操作{$msg_add}",
	'highlight_title'	=> '您的文章標題被加亮顯示',
	'highlight_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]標題加亮[/b] 操作{$msg_add}",
	'del_title'	=> "您的文章被刪除",
	'del_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]刪除[/b] 操作\n對您的影響︰{$msg[affect]}{$msg_add}",
	'move_title'	=> "您的文章被移動",
	'move_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]移動[/b] 操作\n\n[b]目的版塊︰[/b][url=$db_bbsurl/thread.php?fid={$msg[tofid]}]{$msg[toforum]}[/url]{$msg_add}",
	'copy_title'	=> "您的文章被復制到新版塊",
	'copy_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]復制[/b] 操作\n\n[b]目的版塊︰[/b][url=$db_bbsurl/thread.php?fid={$msg[tofid]}]{$msg[toforum]}[/url]{$msg_add}",
	'ping_title'	=> "您的文章被評分",
	'ping_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]評分[/b] 操作\n\n對您的影響︰{$msg[affect]}{$msg_add}",
	'delping_title' => "您的文章被取消評分",
	'delping_content'=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]取消評分[/b] 操作\n\n對您的影響︰{$msg[affect]}{$msg_add}",
	'deltpc_title'	=> "您的文章被刪除",
	'deltpc_content'	=> "您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]刪除[/b] 操作\n\n對您的影響︰{$msg[affect]}{$msg_add}",
	'delrp_title'	=> "您的回復被刪除",
	'delrp_content'	=> "您發表的回復被 [b]{$msg[6]}[/b] 執行 [b]刪除[/b] 操作\n\n對您的影響︰{$msg[affect]}{$msg_add}",
	'reward_title'=>"您的回復被設為最佳答案!",
	'reward_content'=>"您的回復被設為最佳答案!\n\n對您的影響︰{$msg[affect]}{$msg_add}",
	'endreward_title_1'=>"您的懸賞被取消!",
	'endreward_title_2'=>"您的懸賞被強制結案!",
	'endreward_content_1'=>"由于沒有合適的答案，您的懸賞被管理員 [b]{$msg[6]}[/b] 執行 [b]取消[/b] 操作!\n\n系統返回您:{$msg[affect]}{$msg_add}",
	'endreward_content_2'=>"由于您長時間未對懸賞帖進行結案,且已經有合適的答案，所以被[b]{$msg[6]}[/b] 執行 [b]強制結案[/b] 操作\n\n系統不返回所有積分{$msg_add}",
	'rewardmsg_title'=>"懸賞帖(編號:$msg[tid])請求處理!",	'rewardmsg_content'=>"$msg[0]\t斑主:\n\t\t您好!\n\t\t由于該次懸賞帖沒有產生合適答案，現請求您結案,希望您仔細查證後，作出公平處理!{$msg_add}",
	'rewardmsg_notice_title'=>"懸賞帖到期通知!",	'rewardmsg_notice_content'=>"您的懸賞帖已經到期，系統提醒您盡快作出處理,否則斑主有權強行結案!\n\n[b]文章︰[/b][url=$db_bbsurl/read.php?tid=\$tid]\$msg[subject][/url]\n[b]發表日期︰[/b]\$msg[postdate]\n[b]所在版塊︰[/b][url=$db_bbsurl/thread.php?fid=\$msg[fid]]\$msg[name][/url]\n\n論壇管理操作通知短消息，對本次管理操作有任何異議，請與我取得聯系。",
	'send_credit'=>"管理團隊工資發放!",
	'send_credit_content'=>"尊敬的 ltitle 們\n\t\t感謝你們對 $db_bbsname 的支持!現特發 addpoint $creditname 作為獎勵.\n\n操作日期 $admindate",
	'shield_title_1'=>"您的文章被屏蔽",
	'shield_content_1'=>"您發表的文章被 [b]{$msg[6]}[/b] [b]屏蔽[/b]{$msg_add}",
	'shield_title_0'=>"您的文章被取消屏蔽",
	'shield_content_0'=>"由于操作失誤,您發表的文章被 [b]{$msg[6]}[/b] [b]取消屏蔽[/b]{$msg_add},請見諒!",
	'report_title'=>"帖子報告處理",
	'report_content_1'=>"該帖很優秀,建議加為精華帖!{$msg_add}",
	'report_content_0'=>"該帖包含不良信息,請及時處理!{$msg_add}",
	'unite_title'=>'您的文章被合並',
	'unite_content'=>"您發表的文章被 [b]{$msg[6]}[/b] 執行 [b]合並[/b] 操作{$msg_add}",
);
?>