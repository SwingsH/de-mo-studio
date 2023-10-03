<?php
!function_exists('readover') && exit('Forbidden');

##主题分类
$t_typedb=array();
$t_per=0;$t_exits=0;
$t_db=$foruminfo['t_type'];
if($t_db){
	$t_typedb=explode("\t",$t_db);
	$t_typedb = array_unique ($t_typedb);
	$t_per=$t_typedb[0];unset($t_typedb[0]);
	foreach($t_typedb as $value){
		if($value) $t_exits=1;
	}
}
$db_forcetype = $t_exits && $t_per=='2' && !$admincheck ? 1 : 0; // 是否需要强制主题分类

if($foruminfo['allowpost'] && !allowcheck($foruminfo['allowpost'],$groupid,$winddb['groups'],$fid,$winddb['post']) && !$admincheck){
	Showmsg('postnew_forum_right');
}
if(!$foruminfo['allowpost'] && !$admincheck && $gp_allownewvote==0 && $action=='vote'){
	Showmsg('postnew_group_vote');
}
if($active){
	!$forumset['allowactive'] && showmsg('postnew_forum_active');
	!$gp_allowactive && Showmsg('postnew_group_active');
	$sel_0='checked';
}
if(!$foruminfo['allowpost'] && !$admincheck && $gp_allowpost==0){
	Showmsg('postnew_group_right');
}
if (!$_POST['step']){
	
	/*******
	* 悬赏 *
	*******/
	if($foruminfo['allowreward'] && !$sale && !$active && $action=='new' && $_G['allowreward']){
		$creditselect='<option value="rvrc">'.$db_rvrcname.'</option>';
		$creditselect.='<option value="money">'.$db_moneyname.'</option>';
		$creditselect.='<option value="credit">'.$db_creditname.'</option>';
		require_once(D_P.'data/bbscache/creditdb.php');
		foreach($_CREDITDB as $key=>$val){
			$creditselect.="<option value=\"$key\">$val[0]</option>";
		}
	}
	/*******
	* 悬赏 *
	*******/
	require_once(R_P.'require/header.php');
	$guidename=forumindex($foruminfo['fup']);
	$msg_guide=headguide($guidename);	
	if($winddb['payemail']){
		list(,$payemail) = explode("\t",$winddb['payemail']);
		$winddb['email']=$payemail;
	}
	require_once PrintEot('post');footer();
}elseif($_POST['step']==2){
	##主题分类
	//强制分类
	if(!$p_type || empty($t_typedb[$p_type]) || ($t_per==0 && !$admincheck)){
		$w_type=0;
	}else{
		$w_type=$p_type;
	}
	$db_forcetype && $w_type=='0' && Showmsg('force_tid_select');
	
	list($atc_title,$atc_content)=check_data($action);
	$rewardinfo='';  //悬赏
	require_once(R_P.'require/postupload.php');
	$pollid=$activeid=0;

	if($action=="vote"){
		$votearray = array();
		$vt_select = Char_cv($vt_select);
		$vt_select = explode("\n",$vt_select);
		foreach($vt_select as $voteoption){
			$voteoption = trim($voteoption);
			if($voteoption){
				$votearray['options'][] = array($voteoption,0,array());
			}
		}
		if(count($vt_select) > $db_selcount){
			Showmsg('vote_num_limit');
		}
		if($mostvotes && is_numeric($mostvotes)){
			$mostvotes>count($vt_select)?$mostvotes=count($vt_select):'';
		} else{
			$mostvotes=count($vt_select);
		}
		$votearray['multiple'] = array($multiplevote,$mostvotes);
		$voteopts = addslashes(serialize($votearray));
		$db->update("INSERT INTO pw_polls(voteopts,modifiable,previewable,timelimit) VALUES ('$voteopts','$modifiable','$previewable','$timelimit')");
		$pollid=$db->insert_id();
	}
	if($sale && $forumset['allowsale']!=2 && $seller && $subject && $price){
		$seller       = Char_cv($seller);
		$subject      = Char_cv($subject);
		$contact      = Char_cv($contact);
		$demo         = Char_cv($demo);
		$price        = (int)$price;
		$ordinary_fee = (int)$ordinary_fee;
		$express_fee  = (int)$express_fee;
		if(!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$seller)){
			Showmsg('seller_error');
		}
		$atc_content  = "[payto]
(seller)$seller(/seller)
(subject)$subject(/subject)
(body)$atc_content(/body)
(price)$price(/price)
(ordinary_fee)$ordinary_fee(/ordinary_fee)
(express_fee)$express_fee(/express_fee)
(contact)$contact(/contact)
(demo)$demo(/demo)
(method)$method(/method)
[/payto]";

	}elseif($active && $forumset['allowactive'] && $gp_allowactive){
		(!$active_subject || !$active_starttime || !$active_deadline) && Showmsg('active_data_empty');
		$active_starttime= PwStrtoTime($active_starttime);
		$active_endtime  = PwStrtoTime($active_endtime);
		$active_deadline = PwStrtoTime($active_deadline);
		$active_subject  = Char_cv($active_subject);
		$active_location = Char_cv($active_location);
		$active_deadline < $timestamp && Showmsg('deadline_limit');
		$active_deadline > $active_starttime && Showmsg('starttime_limit');
		$active_endtime && $active_starttime>$active_endtime && Showmsg('endtime_limit');
		(!is_numeric($active_num) || $active_num<0) && $active_num=0;
		(!is_numeric($active_costs) || $active_costs<0) && $active_costs=0;
		$db->update("INSERT INTO pw_activity(subject,admin,starttime,endtime,location,num,sexneed,costs,deadline) VALUES ('$active_subject','$winduid','$active_starttime','$active_endtime','$active_location','$active_num','$active_sex','$active_costs','$active_deadline')");
		$activeid=$db->insert_id();		
	}elseif($foruminfo['allowreward'] && $reward=='1' && $action=='new' && $_G['allowreward']){
		require_once(R_P.'require/postreward.php');
	}

	if ($_POST['atc_convert']=="1"){
		$_POST['atc_autourl'] && $atc_content=autourl($atc_content);
		$atc_content = html_check($atc_content);

		/*
		* [post]、[hide、[sell=位置不能换
		*/
		if(!$foruminfo['allowhide'] || !$gp_allowhidden){
			$atc_content=str_replace("[post]","[\tpost]",$atc_content);
		} elseif($atc_hide=='1'){
			$atc_content="[post]".$atc_content."[/post]";
		}
		if(!$foruminfo['allowencode'] || !$gp_allowencode){
			$atc_content=str_replace("[hide=","[\thide=",$atc_content);
		} elseif($atc_requirervrc=='1'){
			$atc_content="[hide=".(int)$atc_rvrc."]".$atc_content."[/hide]";
		}
		if(!$foruminfo['allowsell'] || !$gp_allowsell){
			$atc_content=str_replace("[sell=","[\tsell=",$atc_content);
		} elseif($atc_requiresell=='1'){
			$atc_content="[sell=".(int)$atc_money."]".$atc_content."[/sell]";
		}
		if(!$SYSTEM['typeadmin']){
			$digest=0;
		}
		/**
		* 主要因为convert函数需要$tpc_author变量
		*/
		$tpc_author=$windid;
		$lxcontent=convert($atc_content,$db_windpost);
		$ifconvert=$lxcontent==$atc_content ? 1:2;
	}else{
		$ifconvert=1;
	}
	$db_tcheck && $winddb['postcheck'] == tcheck($atc_content) && Showmsg('content_same'); //内容验证

	if (($foruminfo['f_check'] == 1 || $foruminfo['f_check'] == 3) && $_G['atccheck'] && !$admincheck){
		$ifcheck = 0;
	} else {
		$ifcheck = 1;
	}
	$anonymous = ($forumset['anonymous'] && $_G['anonymous'] && $act_anonymous) ? 1 : 0;
	$lastposter= $anonymous ? $db_anonymousname : $windid;
	$atc_iconid=(int)$atc_iconid;
	$db->update("INSERT INTO pw_threads (fid,icon,author,authorid,subject,ifcheck,type,postdate,lastpost,lastposter,hits,replies,topped,digest,pollid,activeid,ifupload,ifreward,rewardinfo,ifsale,anonymous) VALUES ('$fid','$atc_iconid','".addslashes($windid)."','$winddb[uid]','$atc_title','$ifcheck','$w_type','$timestamp','$timestamp','".addslashes($lastposter)."','1','0','0','".(int)$digest."','$pollid','$activeid','$ifupload','$reward','$rewardinfo','$sale','$anonymous')");
	$tid = $db->insert_id();
	$db->update("INSERT INTO pw_tmsgs (tid,aid,userip,ifsign,buy,ipfrom,ifconvert,content) VALUES('$tid','$attachs','$onlineip','$atc_usesign','','$ipfrom','$ifconvert','$atc_content')");
	$digest && $db->update("UPDATE pw_memberdata SET digests=digests+1 WHERE uid='$winduid'");
	if($aids){
		$db->update("UPDATE pw_attachs SET tid='$tid' WHERE aid IN($aids)");
	}
	if($activeid){
		$db->update("UPDATE pw_activity SET tid='$tid' WHERE id='$activeid'");
	}
	if($foruminfo['cms']){
		include_once(R_P.'require/c_search.php');
		insert_key($tid,$keyword);
	}
	$top_post=1;
	$t_date=$timestamp;//主题发表时间 bbspostguide 中用到
	bbspostguide();

	unset($j_p);
	if ($ifcheck==1){
		if($foruminfo['allowhtm'] && !$foruminfo['cms']){
			include_once(R_P.'require/template.php');
		}
		lastinfo($fid,$foruminfo['allowhtm'],'new',$foruminfo['cms'].'B');
	}
	if ($modify){
		ObHeader("post.php?action=modify&fid=$fid&tid=$tid&pid=tpc&article=0");
	} else {
		if(empty($j_p) || $foruminfo['cms']) $j_p="read.php?tid=$tid";
		refreshto($j_p,'enter_thread');
	}
}
?>